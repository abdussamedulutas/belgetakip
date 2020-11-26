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
                                    <?php if($_SESSION["role"]=="admin"): ?><button class="btn btn-success" onclick="create()">Yeni Ekle</button><?php endif;?>
                                </div>
                                <div class="col-md-12 table-responsive">
                                    <table class="table table-bordered table-striped table-hover datatablepin" id="filepanel">
                                        <thead>
                                            <tr>
                                                <th width="1%">Dosya Numarası</th>
                                                <th></th>
                                                <th>İlgili Personel</th>
                                                <th>Acente</th>
                                                <th>Hasar Tarihi</th>
                                                <th>Dosya Geliş T.</th>
                                                <th>Müvekkil</th>
                                                <th>Taraf Şti</th>
                                                <th>Evraklar</th>
                                                <th width="1%">İşlem</th>
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
    function getField(obj,name)
    {
        for(var column of obj){
            if(column.name == name)
            {
                return column.text
            }
        };
        return "";
    };
    function pinfo()
    {
        var p = block("#pinpanel");
        setTimeout(function(){
            Server.request({
                action:"getFiles"
            },function(json){
                p();
                data = json.data;
                var lastAdded = null;
                $("#filepanel").DataTable().clear().draw();
                var db = $("#filepanel").DataTable().row;
                for(var file of json.data.Files){
                    lastAdded = db.add([
                        `Dosya no:${file.order}`,
                        `<span class="display-block mb-5 badge badge-success">${getField(file.form.FormData,'Mağdurun konumu')}</span>`+
                        `<span class="display-block mb-5 badge badge-primary">${getField(file.form.FormData,'Tazminat Türü')}</span>`+
                        `<span class="display-block badge badge-info">${getField(file.form.FormData,'Tanzim Türü')}</span>`,
                        json.data.Personel[file.personel].name + " " + json.data.Personel[file.personel].surname,
                        json.data.Acente[file.acente].name,
                        getField(file.form.FormData,'Hasar Tarihi'),
                        getField(file.form.FormData,'Dosya Geliş Tarihi'),
                        getField(file.form.FormData,'Müvekkil'),
                        getField(file.form.FormData,'Taraf Şirketi'),
                        `${file.evraklar.Eksik} evrak eksik<br>${file.evraklar.Tam} evrak girilmiş`,
                        `<a class="btn btn-primary" href="<?=$data->userPanelLink?>/dosya/${file.order}">Detaylar</a>`
                    ]);
                };
                if(lastAdded) lastAdded.draw();
                else{
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
            action:"tumpersoneller"
        },function(json){
            tumpersoneller = json.data;
        })
    });
    function create()
    {
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
                <form class="modal-body" id="createform">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Dosya İsmi</label>
                                <input type="text" id="fname" name="name" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>İlgili Acente</label>
                                <select class="select2 no-search" id="acente" name="acente">
                                    <option value="RO">Acente Seç</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Acente Personeli</label>
                                <select class="select2 no-search" id="personel" name="personel">
                                    <option value="RO">Personel Seç</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
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
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary actionbtn" onclick="Server.createFile()">Gönder</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(function(){
            Server.request({
                action:"getFields"
            },function(json){
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
            function input(type,id,values)
            {
                switch(type)
                {
                    case "select": return `<select class="select2 field_data" name="${id}"><option>Seçin</option>`+values.map(function(value){return `<option value="${value.id}">${value.name}</option>`}).join('')+`</select>`;
                    case "text": return `<input class="form-control field_data" name="${id}" placeholder='Bir şeyler yazın'>`;
                    case "date": return `<input type="date" class="form-control field_data" name="${id}" placeholder='Bir şeyler yazın'>`;
                }
            };
            Server.createFile = function()
            {
                var t = new FormData($("#createform")[0]);
                t.append("action","saveFile");
                Server.request(t,function(json){
                    window.location = json.data.newURL;
                })
            };
        });
    </script>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
