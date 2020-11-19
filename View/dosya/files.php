<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Dosyalar"?></title>
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
								<h2 style="margin-top:0">Dosyalar</h2>
							</div>
							<div class="col-xs-6 text-right">
								<button class="btn btn-success" onclick="create()">Yeni Ekle</button>
							</div>
							<div class="col-md-12">
								<table class="table table-bordered table-striped table-hover datatablepin" id="formpanel">
									<thead>
										<tr>
											<th>İşlem Adı</th>
											<th>Acente</th>
											<th>Acente Personeli</th>
											<th>Form Adı</th>
											<th>Durum</th>
											<th>Oluşturma Tarihi</th>
											<th width="1%">İşlemler</th>
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
    <script>
    var tumacenteler = false;
    var tumformislemleri = false;
    var tumformlar = false;
    var autoCommit = false;
    function pinfo()
    {
        var p = block("#pinpanel");
        setTimeout(function(){
            Server.request({
                action:"getFiles"
            },function(json){
                var lastAdded = null;
                $("#formpanel").DataTable().clear().draw();
                var db = $("#formpanel").DataTable().row;
                for(var file of json.data.Files){
                    lastAdded = db.add([
                        `${file.name}`,
                        `${json.data.Acente[file.acente].name}`,
                        `${json.data.Personel[file.personel].name}`,
                        file.reqforms.split(',').map(function(formid){
                            return `<p>${json.data.Forms[formid].name}</p>`
                        }).join(''),
                        `${file.name}`,
                        `${file.name}`,
                        `${file.name}`
                    ]);
                };
                if(lastAdded) lastAdded.draw();
                else{
                    p();
                    p=null
                };
                reinitialize();
                setTimeout(function(){
                    p&&p();
                },100);
            });
        },100);
    }
    $(document).ready(function(){
        pinfo();
    });
    $(function(){
        Server.request({
            action:"tumacenteler"
        },function(json){
            tumacenteler = json.data
        })
        Server.request({
            action:"tumformlar"
        },function(json){
            tumformlar = json.data
        })
       /* Server.request({
            action:"    "
        },function(json){
            tumformlar = json.data
        })*/
        $("#acente").change(function(){
            if(autoCommit) return;
            if(!tumacenteler) return;
            var id = $(this).val();
            var p = block(".modal-body");
            Server.request({
                action:"tumpersoneller",
                id:id
            },function(json){
                $("#personel").html(json.data.map(function(pers){
                    return `<option value="${pers.id}">${pers.name} ${pers.surname}</option>`
                }));
                $("#personel").trigger("change");
                p();
            })
        })
        $(".actionbtn").click(function(){
            var id = $("#acente").val();
            var ids = $("#requiredForms").val();
            if(!id || !ids || (ids && ids.length == 0)) return;
            var p = block(".modal-body");
            Server.request({
                action:"saveFile",
                name:$("#fname").val(),
                acente:$("#acente").val(),
                personel:$("#personel").val(),
                requiredForms:$("#requiredForms").val()
            },function(json){
                tumformlar = json.data
                Notify.successText("Başarılı!","Sistemde yeni bir dosya açıldı");
                p();
            })
        })
    });
    function create()
    {
        var p = block(".modal-body");
        Server.request({
            action:"tumformislemleri"
        },function(json){
            $("#requiredForms").html(json.data.map(function(pers){
                return `<option value="${pers.id}">${pers.name} (${pers.required.length})</option>`
            }));
            $("#requiredForms").trigger("change");
            p();
        })
        autoCommit = true;
        if(!tumacenteler) return;
        $("#acente").html(
        `<option>Acente Seç</option>`+
        tumacenteler.map(function(acente){
            return `<option value="${acente.id}">${acente.name}</option>`
        }));
        $("#acente").trigger("change");
        $("#add-file").modal("show");
        autoCommit = false;
    }
    </script>
	<div id="add-file" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Yeni Dosya Aç</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Dosya İsmi</label>
                                <input type="text" id="fname" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>İlgili Acente</label>
                                <select class="select2 no-search" id="acente">
                                    <option value="RO">Acente Seç</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Acente Personeli</label>
                                <select class="select2 no-search" id="personel">
                                    <option value="RO">Önce Acente Seç</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Gerekli İşlemler</label>
                                <select class="select2 no-search" multiple id="requiredForms"></select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary actionbtn">Gönder</button>
                </div>
            </div>
        </div>
    </div>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
