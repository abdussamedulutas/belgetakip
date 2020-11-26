<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Form Düzenle"?></title>
	<?php include(__DIR__."/../partials/styles.php"); ?>
</head>
<?php
	$breadcrumb = [
		"Anasayfa" => "$data->userPanelLink/sondurum"
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
					<div class="panel panel-flat">
						<div class="panel-body" id="pane">
                            <form class="col-md-6 col-md-push-3 table-responsive" id="form">
                                <input type="hidden" name="id" value="<?=$data->formid?>">
                                <table class="table table-bordered table-striped table-hover datatablepin no-paginate no-searching no-order" id="formpanel">
                                    <thead>
                                        <tr>
                                            <th>İsim</th>
                                            <th width="50%">Değer</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </form>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-success" onclick="editForm()">Kaydet</button>
                                <button class="btn btn-danger" onclick="Sil()">Kaldır</button>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script>
    var values = {};
    function editForm()
    {
        var progress = Notify.progress("Form Ekle","Bilgiler iletiliyor");
        var data = new FormData($("#form")[0]);
        data.append("action","EditForm");
        data.append("typeid","<?=$data->id?>");
        data.append("language",navigator.language);
        Server._ajax(window.location.pathname,data,function(ans) {
            if(ans.status == "success")
            {
                progress.remove();
                Notify.successText("Form Ekle","Başarıyla düzenlendi",progress,3000);
            }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
        },function(){
            Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
        });
    };
    function Sil()
    {
        Notify.confirm({
            title:"Dikkat!",
            text:`Formu silmek istediğinize emin misiniz?`,
            confirmText:"Evet, Sil",
            cancelText:"İptal",
            confirm:function(){
                Server.request({
                    action:"deleteForm",
                    id:"<?=$data->formid?>"
                },function(json){
                    window.location = "<?="$data->userPanelLink/dosyalar"?>";
                })
            }
        });
    }
    $(function(){
        var id = new URL(window.location).searchParams.get("id");
        var _values = <?=json_encode($data->values);?>;
        _values.map(function(val){
            values[val.field] = val;
        });
        Server.request({
            action:"getFields",
            id:`<?=$data->id?>`
        },function(json){
            var last;
            $("#formpanel").DataTable().clear()
            for(var k of json.data){
                last = $("#formpanel").DataTable().row.add([
                    `${k.name}`,
                    input(k.type,k.id,k.variables)
                ])
            };
            last.draw();
            reinitialize();
        })
        function input(type,id,valuec)
        {
            var selectedValue = values[id];
            switch(type)
            {
                case "select": return `<select class="select2 field_data" name="${id}"><option>Seçin</option>`+valuec.map(function(value){return `<option value="${value.id}" ${value.id==selectedValue.textid?"selected":""}>${value.name}</option>`}).join('')+`</select>`;
                case "text": return `<input class="form-control field_data" name="${id}" value='${selectedValue.text}'>`;
                case "date": return `<input type="date" class="form-control field_data" name="${id}" value="${selectedValue.text}">`;
            }
        };
    });
    </script>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
