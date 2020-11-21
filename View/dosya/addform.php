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
                                    <select class="select2" id="file" name="fileid"></select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-4">
                                <div class="form-group">
                                    <select class="select2" id="formtype" name="formtype"></select>
                                    <input type="hidden" id="personel">
                                </div>
                            </div>
						</div>
					</div>
					<div class="panel panel-flat">
						<div class="panel-body" id="pane">
                            <form class="col-md-6 col-md-push-3" id="form">
                                <table class="table table-bordered table-striped table-hover datatablepin" id="formpanel">
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
                                <button class="btn btn-success" onclick="yeniForm()">Kaydet</button>
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
    function yeniForm()
    {
        var progress = Notify.progress("Form Ekle","Bilgiler iletiliyor");
        var data = new FormData($("#form")[0]);
        data.append("action","AddForm");
        data.append("language",navigator.language);
        data.append("fileid",$("#file").val().split('|')[0]);
        data.append("typeid",$("#formtype").val().split('|')[0]);
        data.append("requireid",$("#formtype").val().split('|')[1]);
        data.append("userid",$("#personel").val());
        Server._ajax(window.location.pathname,data,function(ans) {
            if(ans.status == "success")
            {
                progress.remove();
                Notify.successText("Form Ekle","Başarıyla eklendi",progress,3000);
                setTimeout(function(){
                    window.location = ans.data.newURL;
                },1000);
            }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
        },function(){
            Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
        });
    };
    var dosya = new URL(window.location).searchParams.get("dosya");
    var form = new URL(window.location).searchParams.get("form");

    $(function(){
        var id = new URL(window.location).searchParams.get("id");

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
                return `<option value="${value.id}|${value.personel}" ${value.id==id||value.id==dosya?"selected":""}>${value.name}</option>`
            }).join('')).trigger("change");

        
        })
        $("#file").change(function(){
            var id = this.value.split('|');
            var forms = [];
            var file = data.Files[id[0]].name;
            data.Files[id[0]].reqforms.split(',').map(function(ids){
                var gerekliIsim = data.RequiredForms[ids].name
                var gerekliFormlar = data.RequiredForms[ids].required.split(',')

                gerekliFormlar.map(function(formid){
                    var form = data.Processor[id[0]][ids][formid];
                    if(!form.status)
                    {
                        forms.push( `<option value="${formid}|${ids}" ${formid==form.id?"selected":""}>[${file}] dosyası içerisinde [${gerekliIsim}] için gerekli [${form.count}] formu eksik</option>`)
                    }else{
                        forms.push( `<option value="${formid}|${ids}" disabled>[${file}] dosyası içerisinde [${gerekliIsim}] için [${form.count}] formu</option>`)
                    }
                })
            });
            $("#personel").val(id[1]);
            $("#formtype").html(forms.join('')).trigger("change");
        })
        $("#formtype").change(function(){
            Server.request({
                action:"getFields",
                id:this.value.split('|')[0]
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
        
    });
    </script>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
