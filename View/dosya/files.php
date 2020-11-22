<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Dosyalar ve Formlar"?></title>
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
            <?php if($_SESSION["role"]=="admin"): ?>
			<?php include(__DIR__."/../partials/sidebar.php");?>
            <?php elseif($_SESSION["role"]=="personel"): ?>
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
                                    <?php if($_SESSION["role"]=="admin"): ?><button class="btn btn-success" onclick="create()">Yeni Ekle</button><?php endif;?>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped table-hover datatablepin" id="filepanel">
                                        <thead>
                                            <tr>
                                                <th>Dosya Kimliği</th>
                                                <th>İşlem Adı</th>
                                                <th>Acente</th>
                                                <th>Acente Personeli</th>
                                                <th>Form Adı</th>
                                                <th>Durum</th>
                                                <th>İşlem</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-flat" id="form">
                            <div class="panel-body">
                                <div class="col-xs-6">
                                    <h2 style="margin-top:0">Formlar</h2>
                                </div>
                                <div class="col-xs-6 text-right">
                                <?php if($_SESSION["role"]=="admin"): ?><a class="btn btn-success" href="<?="$data->userPanelLink/form/ekle"?>">Yeni Ekle</a><?php endif;?>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-bordered table-striped table-hover datatablepin" id="formpanel">
                                        <thead>
                                            <tr>
                                                <th>Dosya Adı</th>
                                                <th>İşlem Adı</th>
                                                <th>Form Adı</th>
                                                <th>Durum</th>
                                                <th>İşlem</th>
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
    var data = null;
    function pinfo()
    {
        var p = block("#pinpanel");
        setTimeout(function(){
            Server.request({
                action:"getFiles"
            },function(json){
                data = json.data;
                var lastAdded = null;
                $("#filepanel").DataTable().clear().draw();
                var db = $("#filepanel").DataTable().row;
                for(var file of json.data.Files){
                    var thereis = 0;
                    var thereisnt = 0;
                    file.reqforms.split(',').map(function(formid){
                        Object.values(json.data.Processor[file.id][formid]).map(function(form){
                            if(form.status){
                                thereis++;
                            }else{
                                thereisnt++;
                            }
                        })
                    }).join('')
                    lastAdded = db.add([
                        file.id,
                        `${file.name}`,
                        `${json.data.Acente[file.acente].name}`,
                        `${json.data.Personel[file.personel].name}`,
                        `${thereis} form eklendi<br>${thereisnt} form eksik`,
                        thereisnt != 0 ? "Belge Eksik" : "Dosya Hazır",
                        `<button class="btn btn-primary" onclick="getForms('${file.id}')">Formlar</button>`
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
    function getForms(id)
    {
        var p = block("#form");
        setTimeout(function(){
            $("#formpanel").DataTable().clear().draw();
            var db = $("#formpanel").DataTable().row;
            var file = data.Files.filter(function(d){return d.id==id})[0];
            var thereis = 0;
            var lastAdded = false;
            var thereisnt = 0;
            file.reqforms.split(',').map(function(formid){
                var red = data.RequiredForms[formid];
                Object.values(data.Processor[id][formid]).map(function(form){
                    lastAdded = db.add([
                        `${file.name}`,
                        `${red.name}`,
                        `${form.count}`,
                        form.status ? `Form Eklendi` : `Eksik Form`,
                        <?php if($_SESSION["role"]=="admin"): ?>
                        form.status ? `<a class="btn btn-success" href="<?=$data->userPanelLink?>/form/${form.formid}">Görüntüle</a>&nbsp;<a class="btn btn-success" href="<?=$data->userPanelLink?>/form/duzenle/${form.formid}">Düzenle</a>` : `<a class="btn btn-danger" href="<?="$data->userPanelLink/form/ekle"?>?dosya=${file.id}&form=${form.id}">Ekle</a>`
                        <?php elseif($_SESSION["role"]=="personel"): ?>
                        form.status ? `<a class="btn btn-success" href="<?=$data->userPanelLink?>/form/${form.formid}">Görüntüle</a>` : ``
                        <?php endif;?>
                    ]);
                })
            })
            if(lastAdded) lastAdded.draw();
            p();
        },1000)
    }
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
        Server.request({
            action:"tumpersoneller"
        },function(json){
            tumpersoneller = json.data;
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
                
            pinfo()
                tumformlar = json.data
                Notify.successText("Başarılı!","Sistemde yeni bir dosya açıldı");
                p();
                $("#add-file").modal("hide");
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
        tumacenteler.map(function(acente){
            return `<option value="${acente.id}">${acente.name}</option>`
        }));
        $("#acente").trigger("change");


        $("#personel").html(tumpersoneller.map(function(pers){
            return `<option value="${pers.id}">${pers.name} ${pers.surname}</option>`
        }));
        $("#personel").trigger("change");

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
