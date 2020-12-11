<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Hesabım"?></title>
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
			<?php include(__DIR__."/../partials/sidebar.php");?>
			<div class="content-wrapper">
				<form onsubmit="Server.editSelfprofile(this);return false" class="row col-md-8 col-md-push-2">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h6 class="panel-title">Hesap Bilgileri</h6>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="close"></a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Kullanıcı Adı</label>
                                        <input type="text" value="<?=$_SESSION["name"]?>" name="name" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label>Kullanıcı soyadı</label>
                                        <input type="text" value="<?=$_SESSION["surname"]?>" name="surname" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>E-Mail Adresleri</label>
                                        <input type="text" value="<?=$_SESSION["user"]?>" name="email" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="display-block">Profil Resmi</label>
                                        <input type="file" name="image" class="file-styled">
                                        <span class="help-block">Kabul Edilen Formatlar: gif, png, jpg</span>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-danger mr-10" onclick="changePassword();return false">Şifre Değiştir <i class="icon-lock2 position-right"></i></button>
                                <button type="submit" class="btn btn-primary actionbtn">Kaydet <i class="icon-arrow-right14 position-right"></i></button>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
    <script>
        function changePassword()
        {
            bootbox.prompt(`Lütfen güncel parolayı giriniz?`, function(oldPassword) {
                if(!oldPassword) return;
                var kg = Notify.progress("Şifre Değiştirme","Güncel şifre kontrol ediliyor");
                Server.request({
                    action:"isPassword",
                    oldPass:oldPassword
                },function(json){
                    if(json.data)
                    {
                        kg.remove();
                        bootbox.prompt(`Yeni Parola`, function(newPassword) {
                            if(!newPassword) return;
                            bootbox.prompt(`Yeni Parolayı tekrar giriniz?`, function(newPasswordVerify) {
                                if(newPassword != newPasswordVerify){
                                    return confirm("Girilen yeni parolalar eşleşmiyor.");
                                };
                                var k = Notify.progress("Şifre Değiştirme","Veri iletiliyor");
                                Server.request({
                                    action:"changePassword",
                                    oldPass:oldPassword,
                                    newPass:newPassword
                                },function(json){
                                    Notify.successText("Şifre Değiştirme","Şifre Değiştirme işlemi başarılı",k,3000)
                                })
                            })
                        })
                    }else{
                        Notify.errorText("Şifre Değiştirme","Güncel Şifreyi yanlış girdiğiniz için işlemi gerçekleştiremiyoruz",kg,3000);
                    }
                })
            })
        }
    </script>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
