/* ------------------------------------------------------------------------------
 *
 *  # Dashboard configuration
 *
 *  Demo dashboard configuration. Contains charts and plugin inits
 *
 *  Version: 1.0
 *  Latest update: Aug 1, 2015
 *
 * ---------------------------------------------------------------------------- */

$(function() {    


    // Switchery toggles
    // ------------------------------

    var switches = Array.prototype.slice.call(document.querySelectorAll('.switch'));
    switches.forEach(function(html) {
        var switchery = new Switchery(html, {color: '#4CAF50'});
    });




    // Daterange picker
    // ------------------------------

    $('.daterange-ranges').daterangepicker(
        {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2016',
            dateLimit: { days: 60 },
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            applyClass: 'btn-small bg-slate-600 btn-block',
            cancelClass: 'btn-small btn-default btn-block',
            format: 'MM/DD/YYYY'
        },
        function(start, end) {
            $('.daterange-ranges span').html(start.format('MMMM D') + ' - ' + end.format('MMMM D'));
        }
    );

    $('.daterange-ranges span').html(moment().subtract(29, 'days').format('MMMM D') + ' - ' + moment().format('MMMM D'));


    // Chart setup
    function salesHeatmap() {


        // Load data
        // ------------------------------

        d3.csv("assets/demo_data/dashboard/app_sales_heatmap.csv", function(error, data) {


            // Bind data
            // ------------------------------

            // Nest data
            var nested_data = d3.nest().key(function(d) { return d.app; }),
                nest = nested_data.entries(data);

            // Format date
            var format = d3.time.format("%Y/%m/%d %H:%M"),
                formatTime = d3.time.format("%H:%M");

            // Pull out values
            data.forEach(function(d, i) { 
                d.date = format.parse(d.date),
                d.value = +d.value
            });



            // Layout setup
            // ------------------------------

            // Define main variables
            var d3Container = d3.select('#sales-heatmap');
                margin = { top: 20, right: 0, bottom: 30, left: 0 },
                width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,
                gridSize = width / new Date(data[data.length - 1].date).getHours(), // dynamically set grid size
                rowGap = 40, // vertical gap between rows
                height = (rowGap + gridSize) * (d3.max(nest, function(d,i) {return i+1})) - margin.top,
                buckets = 5, // number of colors in range
                colors = ["#DCEDC8","#C5E1A5","#9CCC65","#7CB342","#558B2F"];



            // Construct scales
            // ------------------------------

            // Horizontal
            var x = d3.time.scale().range([0, width]);

            // Vertical
            var y = d3.scale.linear().range([height, 0]);

            // Colors
            var colorScale = d3.scale.quantile()
                .domain([0, buckets - 1, d3.max(data, function (d) { return d.value; })])
                .range(colors);



            // Set input domains
            // ------------------------------

            // Horizontal
            x.domain([new Date(data[0].date), d3.time.hour.offset(new Date(data[data.length - 1].date), 1)]);

            // Vertical
            y.domain([0, d3.max(data, function(d) { return d.app; })]);



            // Create chart
            // ------------------------------

            // Container
            var container = d3Container.append('svg');

            // SVG element
            var svg = container
                .attr('width', width + margin.left + margin.right)
                .attr("height", height + margin.bottom)
                .append("g")
                    .attr("transform", "translate(" + margin.left + "," + margin.top + ")");



            //
            // Append chart elements
            //

            // App groups
            // ------------------------------

            // Add groups for each app
            var hourGroup = svg.selectAll('.hour-group')
                .data(nest)
                .enter()
                .append('g')
                    .attr('class', 'hour-group')
                    .attr("transform", function(d, i) { return "translate(0, " + ((gridSize + rowGap) * i) +")"; });

            // Add app name
            hourGroup
                .append("text")
                    .attr('class', 'app-label')
                    .attr('x', 0)
                    .attr('y', -(margin.top/2))
                    .text(function (d, i) { return d.key; });

            // Sales count text
            hourGroup
                .append("text")
                    .attr('class', 'sales-count')
                    .attr('x', width)
                    .attr('y', -(margin.top/2))
                    .style('text-anchor', 'end')
                    .text(function (d, i) { return d3.sum(d.values, function(d) { return d.value; }) + " sales today" });



            // Add map elements
            // ------------------------------

            // Add map squares
            var heatMap = hourGroup.selectAll(".heatmap-hour")
                .data(function(d) {return d.values})
                .enter()
                .append("rect")
                    .attr("x", function(d,i) { return x(d.date); })
                    .attr("y", 0)
                    .attr("class", "heatmap-hour")
                    .attr("width", gridSize)
                    .attr("height", gridSize)
                    .style("fill", '#fff')
                    .style('stroke', '#fff')
                    .style('cursor', 'pointer')
                    .style('shape-rendering', 'crispEdges');

            // Add loading transition    
            heatMap.transition()
                .duration(250)
                .delay(function(d, i) { return i * 20; })
                .style("fill", function(d) { return colorScale(d.value); })

            // Add user interaction
            hourGroup.each(function(d) {
                heatMap
                    .on("mouseover", function (d, i) {
                        d3.select(this).style('opacity', 0.75);
                        d3.select(this.parentNode).select('.sales-count').text(function(d) { return d.values[i].value + " sales at " + formatTime(d.values[i].date); })
                    })
                    .on("mouseout", function (d, i) {
                        d3.select(this).style('opacity', 1);
                        d3.select(this.parentNode).select('.sales-count').text(function (d, i) { return d3.sum(d.values, function(d) { return d.value; }) + " sales today" })
                    })
            })



            // Add legend
            // ------------------------------

            // Get min and max values
            var minValue, maxValue;
            data.forEach(function(d, i) { 
                maxValue = d3.max(data, function (d) { return d.value; });
                minValue = d3.min(data, function (d) { return d.value; });
            });

            // Place legend inside separate group
            var legendGroup = svg.append('g')
                .attr('class', 'legend-group')
                .attr('width', width)
                .attr("transform", "translate(" + ((width/2) - ((buckets * gridSize))/2) + "," + (height + (margin.bottom - margin.top)) + ")");

            // Then group legend elements
            var legend = legendGroup.selectAll(".heatmap-legend")
                .data([0].concat(colorScale.quantiles()), function(d) { return d; })
                .enter()
                .append("g")
                    .attr("class", "heatmap-legend");

            // Add legend items
            legend.append("rect")
                .attr('class', 'heatmap-legend-item')
                .attr("x", function(d, i) { return gridSize * i; })
                .attr("y", -8)
                .attr("width", gridSize)
                .attr("height", 5)
                .style('stroke', '#fff')
                .style('shape-rendering', 'crispEdges')
                .style("fill", function(d, i) { return colors[i]; });

            // Add min value text label
            legendGroup.append("text")
                .attr("class", "min-legend-value")
                .attr("x", -10)
                .attr("y", -2)
                .style('text-anchor', 'end')
                .style('font-size', 11)
                .style('fill', '#999')
                .text(minValue);

            // Add max value text label
            legendGroup.append("text")
                .attr("class", "max-legend-value")
                .attr("x", (buckets * gridSize) + 10)
                .attr("y", -2)
                .style('font-size', 11)
                .style('fill', '#999')
                .text(maxValue);



            // Resize chart
            // ------------------------------

            // Call function on window resize
            $(window).on('resize', resizeHeatmap);

            // Call function on sidebar width change
            $(document).on('click', '.sidebar-control', resizeHeatmap);

            // Resize function
            // 
            // Since D3 doesn't support SVG resize by default,
            // we need to manually specify parts of the graph that need to 
            // be updated on window resize
            function resizeHeatmap() {

                // Layout
                // -------------------------

                // Width
                width = d3Container.node().getBoundingClientRect().width - margin.left - margin.right,

                // Grid size
                gridSize = width / new Date(data[data.length - 1].date).getHours(),

                // Height
                height = (rowGap + gridSize) * (d3.max(nest, function(d,i) {return i+1})) - margin.top,

                // Main svg width
                container.attr("width", width + margin.left + margin.right).attr("height", height + margin.bottom);

                // Width of appended group
                svg.attr("width", width + margin.left + margin.right).attr("height", height + margin.bottom);

                // Horizontal range
                x.range([0, width]);


                // Chart elements
                // -------------------------

                // Groups for each app
                svg.selectAll('.hour-group')
                    .attr("transform", function(d, i) { return "translate(0, " + ((gridSize + rowGap) * i) +")"; });

                // Map squares
                svg.selectAll(".heatmap-hour")
                    .attr("width", gridSize)
                    .attr("height", gridSize)
                    .attr("x", function(d,i) { return x(d.date); });

                // Legend group
                svg.selectAll('.legend-group')
                    .attr("transform", "translate(" + ((width/2) - ((buckets * gridSize))/2) + "," + (height + margin.bottom - margin.top) + ")");

                // Sales count text
                svg.selectAll('.sales-count')
                    .attr("x", width);

                // Legend item
                svg.selectAll('.heatmap-legend-item')
                    .attr("width", gridSize)
                    .attr("x", function(d, i) { return gridSize * i; });

                // Max value text label
                svg.selectAll('.max-legend-value')
                    .attr("x", (buckets * gridSize) + 10);
            }
        });
    }





    // Other codes
    // ------------------------------

    // Grab first letter and insert to the icon
    $(".table tr").each(function (i) {

        // Title
        var $title = $(this).find('.letter-icon-title'),
            letter = $title.eq(0).text().charAt(0).toUpperCase();

        // Icon
        var $icon = $(this).find('.letter-icon');
            $icon.eq(0).text(letter);
    });

});
