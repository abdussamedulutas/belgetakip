<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Dosyalar ve Evraklar"?></title>
	<?php include(__DIR__."/../partials/styles.php"); ?>
</head>
<?php
	$breadcrumb = [
		"Anasayfa" => "$data->userPanelLink/sondurum"
	];
?>
<body class="navbar-bottom navbar-top sidebar-xs">
	
	<?php include(__DIR__."/../partials/main.navbar.php"); ?>
	<?php include(__DIR__."/../partials/main.header.php"); ?>
	<div class="page-container">
		<div class="page-content">
            <?php if(ipermission("admin")): ?>
			<?php include(__DIR__."/../partials/sidebar.php");?>
            <?php elseif(ipermission("personel|kullanici")): ?>
			<?php include(__DIR__."/../partials/personel-sidebar.php");?>
            <?php endif;?>
			<div class="content-wrapper">
				<div class="row">
					<div class="col-md-12">
                        <div class="panel panel-flat" id="pinpanel">
                            <div class="panel-body">
                                <div class="col-xs-6">
                                    <h2 style="margin-top:0">Dosyalar</h2>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <?php if(ipermission("admin|personel")): ?><button class="btn btn-success" onclick="create(this)">Yeni Ekle</button><?php endif;?>
                                </div>
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-bordered table-striped table-hover datatablepin files paginate" id="filepanel">
                                        <thead>
                                            <tr style="white-space: nowrap">
                                                <th width="1%">İşlem</th>
                                                <th width="1%">Dos. No.</th>
                                                <th></th>
                                                <th>İlg. Pers.</th>
                                                <th>Acente</th>
                                                <th>Hasar T.</th>
                                                <th>Dosya Gel. T.</th>
                                                <th>Müv. İsmi</th>
                                                <th>Taraf Şti</th>
                                                <th>Evraklar</th>
                                                <th>Sigorta Şti</th>
                                                <th>Ekleme T.</th>
                                                <th>Değiştirme T.</th>
                                                <th>Son Geliş. T</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
    <script>
    var tumacenteler = false;
    var tumpersoneller = false;
    var tumformislemleri = false;
    var tumavukatlar = false;
    var data = null;
    function getField(obj,id,f)
    {
        for(var column of obj){
            if(column.type == "date")
            {
                if(column.field == id)
                {
                    if(moment(column.text).isValid()){
                        return moment(column.text).format("DD/MM/YYYY")
                    }else{
                        return !f ? "<span class='text-muted'>Girilmedi</span>" : "";
                    }
                }
            }else{
                if(column.field == id)
                {
                    if(column.text != null && column.text.length == 0){
                        return !f ? "<span class='text-muted'>Girilmedi</span>" : "";
                    }else{
                        return column.text
                    }
                }
            }
        };
        return !f ? "<span class='text-muted'>Girilmedi</span>" : "";
    };
    async function pinfo(start,count)
    {
        return await new Promise(function(ok){
        setTimeout(function(){
            Server.request({
                action:"getFiles",
                count:count,
                start:start
            },function(json){
                console.log(json.data.Files.length)
                data = json.data;
                var lastAdded = null;
                if(start == 0) $("#filepanel").DataTable().clear().draw();
                var db = $("#filepanel").DataTable().row;
                for(var file of json.data.Files){
                    if(vidv34){
                        var df = file.lastinsetdate;
                        var date1 = moment(df);
                        var date2 = moment().subtract('days', 45);
                        if(moment(date1).isAfter(date2)) continue;
                    }
                    try{
                        lastAdded = db.add([
                            `<a class="btn btn-primary" href="<?=$data->userPanelLink?>/dosya/${file.order}">Detaylar</a>`,
                            `${file.order}`,
                            `<span class="display-block mb-5 badge badge-success">${getField(file.form.FormData,'0B6072368ADB397A71B6A742D984EB8A','display-block mb-5 badge badge-success',true)}</span> `+
                            `<span class="display-block mb-5 badge badge-primary">${getField(file.form.FormData,'223ED9AED75B31321B0E4C7B14D4741A','display-block mb-5 badge badge-primary',true)}</span> `+
                            `<span class="display-block badge badge-info">${getField(file.form.FormData,'F2D0E64DE5F3425BAD0811BFD26F8D81','display-block badge badge-info',true)}</span> `,
                            json.data.Personel[file.personel].name + " " + json.data.Personel[file.personel].surname,
                            json.data.Acente[file.acente].name,
                            getField(file.form.FormData,'A97169A98F9E367527EF3F39EC8DBC65'),
                            getField(file.form.FormData,'EBA9BFBF7BD43EFAE89813F1DAC07BCD'),
                            `<b>${getField(file.form.FormData,'9AD70292DDAC62F604F79C57E78896D9')}</b>`,
                            json.data.Avukat[file.avukat].name + " " + json.data.Avukat[file.avukat].surname,
                            `${file.evraklar.Eksik} evrak eksik<br>${file.evraklar.Tam} evrak girilmiş`,
                            getField(file.form.FormData,'21D25DCF24373BAEB847F52815BBD746'),
                            `${moment(file.createdate).locale("tr").format("LLL")}`,
                            `${moment(file.modifydate).locale("tr").format("LLL")}`,
                            `${moment(file.lastinsetdate).locale("tr").format("LLL")}`
                        ]);
                    }catch(i){}
                };
                if(lastAdded) lastAdded.draw();
                else{
                    p=null
                };
                ok(lastAdded ? true : false);
                reinitialize();
            });
        },100);
        })
    }
    $(document).ready(function(){
        (async () => {
            var p = block("#pinpanel");
            var t = true;
            var k = 0;
            while(true)
            {
                t &= await pinfo(k*50,50);
                p&&p()
                if(!t) return;
                k++;
            }
        })()
    });
    var vidv34 = false;
    $(function(){
        wait2(function(){
            var text = `<div class="checkbox checkbox-switch" style="margin:3px 10px;float:left;">
                    <input type="checkbox" onchange="vidv34=this.checked;pinfo();$(\`[for='vm0b']\`).animate({width:'toggle'})" data-on-text="Açık" data-off-text="Kapalı" class="switch" data-size="mini" id="vm0b">
                <label for="vm0b" style="white-space:nowrap;display:none">
                    ${moment().locale("tr").subtract('days', 45).format("LL")} tarihinden beri kayıtlar
                </label>
            </div>
            <button class="btn btn-success text-left ml-10" onclick="toExcel('#filepanel','Dosyalar')">Excel'e Aktar</button>`;
            $("#filepanel_wrapper .datatable-header").append(text);
            $(".switch").bootstrapSwitch();
        });
    });
    var tumacenteler = false,tumpersoneller = false,tumavukatlar = false, fields = false;
    async function allVeri()
    {
        return await new Promise(ok =>{
            function send(){
                if(tumacenteler && tumpersoneller && tumavukatlar){
                    ok({
                        tumacenteler:tumacenteler,
                        tumpersoneller:tumpersoneller,
                        tumavukatlar:tumavukatlar
                    })
                }
            }
            !tumacenteler && Server.request({
                action:"tumacenteler"
            },function(json){
                tumacenteler = json.data
                send();
            })
            !tumpersoneller && Server.request({
                action:"tumpersoneller"
            },function(json){
                tumpersoneller = json.data;
                send();
            });
            !tumavukatlar && Server.request({
                action:"tumavukatlar"
            },function(json){
                tumavukatlar = json.data;
                send();
            });
            function input(type,id,values)
            {
                switch(type)
                {
                    case "select": return `<select class="select2 field_data" name="${id}"><option>Seçin</option>`+values.map(function(value){return `<option value="${value.id}">${value.name}</option>`}).join('')+`</select>`;
                    case "text": return `<input class="form-control field_data" name="${id}" placeholder='Bir şeyler yazın'>`;
                    case "date": return `<input type="date" class="form-control field_data" name="${id}" placeholder='Bir şeyler yazın'>`;
                }
            };
            Server.request({
                action:"getFields"
            },function(json){
                fields = true;
                var last;
                $("#newformdata").DataTable().clear()
                for(var k of json.data){
                    last = $("#newformdata").DataTable().row.add([
                        `${k.name}`,
                        input(k.type,k.id,k.variables)
                    ])
                };
                last.draw();
                reinitialize();
            })
            send();
        });
    };
    function create(th)
    {
        var t = blockbtn(th);
        allVeri().then(function(obj){
            t();
            $("#acente").html(
            obj.tumacenteler.map(function(acente){
                return `<option value="${acente.id}">${acente.name}</option>`
            }));
            $("#acente").trigger("change");


            $("#personel").html(obj.tumpersoneller.map(function(pers){
                return `<option value="${pers.id}">${pers.name} ${pers.surname}</option>`
            }));
            $("#personel").trigger("change");


            $("#avukat").html(obj.tumavukatlar.map(function(vkt){
                return `<option value="${vkt.id}">${vkt.name} ${vkt.surname}</option>`
            }));
            $("#avukat").trigger("change");

            $("#add-file").modal("show");
        })
    }
    </script>
	<div id="add-file" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Yeni Dosya Aç</h5>
                </div>
                <form class="modal-body" id="createform">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <label>İlgili Acente</label>
                                <select class="select2 no-search" id="acente" name="acente">
                                    <option value="RO">Acente Seç</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label>Acente Personeli</label>
                                <select class="select2 no-search" id="personel" name="personel">
                                    <option value="RO">Personel Seç</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label>İlgili Avukat</label>
                                <select class="select2 no-search" id="avukat" name="avukat">
                                    <option value="RO">Avukat Seç</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-striped table-hover datatablepin no-paginate no-searching no-order" id="newformdata">
                                    <thead>
                                        <tr>
                                            <th>İsim</th>
                                            <th width="50%">Değer</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12">
                                    <label>Açıklama:</label>
                                    <textarea class="form-control" id="fname" name="name" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary actionbtn" onclick="Server.createFile(this)">Gönder</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            Server.createFile = function(btn)
            {
                var p = blockbtn(btn);
                var t = new FormData($("#createform")[0]);
                t.append("action","saveFile");
                Server.request(t,function(json){
                    wait2(function(){
                        p()
                        window.location = json.data.newURL;
                    });
                })
            };
        });
    </script>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switch.min.js"></script>
    <style>
    
    </style>
</body>
</html>
