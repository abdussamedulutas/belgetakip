<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Form Ekle"?></title>
	<?php include(__DIR__."/../partials/styles.php"); ?>
</head>
<?php
	$breadcrumb = [
		"Anasayfa" => "$data->userPanelLink/panel"
	];
?>
<body class="navbar-bottom navbar-top">
	
	<?php include(__DIR__."/../partials/main.navbar.php"); ?>
	<?php include(__DIR__."/../partials/main.header.php"); ?>
	<div class="page-container">
		<div class="page-content">
			<?php include(__DIR__."/../partials/sidebar.php");?>
			<div class="content-wrapper">
				<div class="row">
					<div class="panel panel-flat" id="pinpanel">
						<div class="panel-body">
							<div class="col-xs-6">
								<h2 style="margin-top:0">Form Ekle</h2>
							</div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <select class="select2" id="file"></select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <select class="select2" id="formtype"></select>
                                </div>
                            </div>
							<div class="col-md-12">
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script>
    var tumacenteler = false;
    var tumformislemleri = false;
    var tumformlar = false;
    var autoCommit = false;
    var data = null;
    $(function(){
        Server.request({
            action:"getFiles"
        },function(json){
            data = json.data;
            var t = {};
            Object.values(data.Files).map(function(v){
                t[v.id]=v
            });
            data.Files = t;
            $("#file").html(Object.values(data.Files).map(function(value){
                return `<option value="${value.id}">${value.name}</option>`
            }).join('')).trigger("change");
        })
        $("#file").change(function(){
            var id = this.value;
            var forms = [];
            var file = data.Files[id].name;
            data.Files[id].reqforms.split(',').map(function(ids){
                var gerekliIsim = data.RequiredForms[ids].name
                var gerekliFormlar = data.RequiredForms[ids].required.split(',')

                gerekliFormlar.map(function(formid){
                    var form = data.Processor[ids][formid];
                    return;
                    if(!form.status)
                    {
                        forms.push( `<option value="${form.id}">${file} dosyası içerisinde ${gerekliIsim} için gerekli ${form.name} formu eksik</option>`)
                    }
                })

            });
            $("#file").html(json.data.Files.map(function(value){
                return `<option value="${value.id}">${value.name}</option>`
            }).join('')).trigger("change");
        })
    });
    </script>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
