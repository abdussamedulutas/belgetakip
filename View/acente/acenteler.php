<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Acente Düzenle"?></title>
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
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Acenteler<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="collapse"></a></li>
									<li><a data-action="reload"></a></li>
									<li><a data-action="close"></a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body">
                            <div class="col-md-6"></div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary" onclick="AddAcente()">Yeni Acente Ekle</button>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped table-hover datatablepin" id="pinpanel">
                                    <thead>
                                        <tr>
                                            <th>İsim</th>
                                            <th width="1%"></th>
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
        function pinfo()
		{
			var p = block("#pinpanel");
			setTimeout(function(){
				Server.request({
					action:"getAcenteList"
				},function(json){
					var lastAdded = null;
					$("#pinpanel").DataTable().clear().draw();
					var db = $("#pinpanel").DataTable().row;
                    for(var row of json.data){
                        lastAdded = db.add([
                            `${row.name}`,
                            `<span style="white-space:nowrap"><button class="btn btn-default" onclick="updateAcente('${row.name}','${row.id}')">Düzenle</button>&nbsp;`+
                            `<button class="btn btn-danger" onclick="removeAcente('${row.name}','${row.id}')">Kaldır</button></span>`
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
		};
        $(function(){
            pinfo();
        });
		function AddAcente()
		{
			bootbox.prompt(`Yeni acente ismi?`, function(result) {
				if(result){
					Server.request({
						action:"createAcente",
						name:result
					},function(json){
						window.location.reload()
					})
				}
			});
		};
		function updateAcente(name,id)
		{
			bootbox.prompt(`<b>${name}</b> acentesinin yeni ismi?`, function(result) {
				if(result){
					Server.request({
						action:"changeAcenteName",
                        id:id,
						name:result
					},function(json){
						window.location.reload()
					})
				}
			});
		};
		function removeAcente(name,id)
		{
			Notify.confirm({
				title:"Dikkat!",
				text:`${name} isimli acenteyi silmek istediğinize emin misiniz?`,
				confirmText:"Evet, Sil",
				cancelText:"İptal",
				confirm:function(){
					Server.request({
						action:"deleteAcente",
						id:id
					},function(json){
						window.location.reload()
					})
				}
			});
		};
    </script>
    <div id="add-personel" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Personel Hesabı Ekle</h5>
                </div>
                <form onsubmit="Server.createPersonel(this);return false;">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>İsmi</label>
                                    <input type="text" name="name" class="form-control">
                                </div>

                                <div class="col-sm-6">
                                    <label>Soyismi</label>
                                    <input type="text" name="surname" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>E-Mail Adresi</label>
                                    <input type="text" name="email" class="form-control">
                                </div>

                                <div class="col-sm-6">
                                    <label>Profil Resmi</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Şifre</label>
                                    <input type="password" name="password1" class="form-control">
                                </div>
                                <div class="col-sm-6">
                                    <label>Şifre tekrar</label>
                                    <input type="password" name="password2" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Doğum Tarihi</label>
                                    <input type="text" name="birthday" class="form-control pickadate" placeholder="Doğum Tarihi">
                                </div>
                                <div class="col-sm-6">
                                    <label>Acente</label>
                                    <input type="text" name="acente_id" readonly class="form-control" value="<?=$data->acente->id?>">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary actionbtn" actionbtn>Gönder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="edit-personel" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Personel Hesabı Düzenle</h5>
                </div>
                <form onsubmit="Server.editPersonel(this);return false;">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-12 text-center">
                                    <img class="img" style="max-width:100px;max-height:100px" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>İsmi</label>
                                    <input type="text" name="name" class="form-control">
                                </div>

                                <div class="col-sm-6">
                                    <label>Soyismi</label>
                                    <input type="text" name="surname" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label>E-Mail Adresi</label>
                                    <input type="text" name="email" class="form-control">
                                </div>

                                <div class="col-sm-6">
                                    <label>Profil Resmi (varsa Değiştirilecek)</label>
                                    <input type="file" name="image" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Kapat</button>
                        <button type="submit" class="btn btn-primary actionbtn" actionbtn>Gönder</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>