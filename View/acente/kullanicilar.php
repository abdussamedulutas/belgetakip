<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Kullanıcı Düzenle"?></title>
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
							<h6 class="panel-title">Kullanıcılar<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="collapse"></a></li>
									<li><a data-action="reload"></a></li>
									<li><a data-action="close"></a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body">
                            <div class="col-md-6">
                                
                            </div>
                            <div class="col-md-6 text-right">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#add-personel">Yeni Kullanıcı Ekle</button>
                            </div>
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped table-hover datatablepin">
                                    <thead>
                                        <tr>
                                            <th width="1%">Resim</th>
                                            <th>İsim</th>
                                            <th>Soyisim</th>
                                            <th>E-Posta Adresi</th>
                                            <th width="1%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data->kullanicilar as $kullanici): ?>
                                        <tr>
                                            <td><img src="<?=isset($kullanici->image)?"uploads/".$kullanici->image:"images/placeholder.jpg"?>" alt="" class="img img-responsize" style="max-width: 100px;max-height:100px;"></td>
                                            <td><?=$kullanici->name?></td>
                                            <td><?=$kullanici->surname?></td>
                                            <td><?=$kullanici->email?></td>
                                            <td style="white-space:nowrap">
                                                <button class="btn btn-default" onclick="Duzenle(this,'<?=$kullanici->id?>');">Düzenle</button>
                                                <button class="btn btn-danger" onclick="Sil(this,'<?=$kullanici->id?>');">Kaldır</button>
                                            </td>
                                        </tr>
                                        <?php endforeach;    ?>
                                    </tbody>
                                </table>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <script>
        function Duzenle(btn,id)
        {
            Server.getKullaniciInfo(id,btn,function(data){
                for(var name in data) if(name != "image"){
                    $("#edit-personel").find("[name='"+name+"']").length != 0 && $("#edit-personel").find("[name='"+name+"']").val(data[name]);
                };
                if(data.image){
                    $("#edit-personel").find("img").attr("src","uploads/"+data.image)
                };
                $("#edit-personel").modal("show");
            });
        }
        function Sil(btn,id)
        {
            swal({
                title: "Dikkat",
                text: "Kullanıcı silme işlemi gerçekleştirmek istediğinize emin misiniz?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#EF5350",
                confirmButtonText: "Evet, Sil",
                cancelButtonText: "Geri",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function(isConfirm){
                if (isConfirm) {
                    Server.deleteKullanici(id,function(){
                        swal.close();
                        $(btn).closest("tr").remove();
                        Notify.successText("Kullanıcı Hesabı","Kullanıcı Silme işlemi başarılı");
                    },function(){
                        swal.close();
                        Notify.errorText("Kullanıcı Hesabı","Kullanıcı Silme işlemi başarısız");
                    });
                }
            });
        }
    </script>
    <div id="add-personel" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Kullanıcı Hesabı Ekle</h5>
                </div>
                <form onsubmit="Server.createKullanici(this);return false;">
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
                    <h5 class="modal-title">Kullanıcı Hesabı Düzenle</h5>
                </div>
                <form onsubmit="Server.editKullanici(this);return false;">
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