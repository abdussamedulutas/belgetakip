<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Giriş Yap"?></title>
	<?php include(__DIR__."/partials/styles.php"); ?>
</head>

<body class="navbar-bottom login-container">
	<?php include(__DIR__."/partials/login.navbar.php"); ?>
	<div class="page-container">
		<div class="page-content">
			<div class="content-wrapper">
				<form onsubmit="Server.Login(this);return false;">
					<div class="panel panel-body login-form">
						<div class="text-center">
							<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
							<h5 class="content-group">Hesabınıza giriş yapın <small class="display-block">Bilgilerinizi doldurun</small></h5>
						</div>
						<div class="form-group has-feedback has-feedback-left">
							<input type="text" class="form-control" name="email" placeholder="Kullanıcı Adı">
							<div class="form-control-feedback">
								<i class="icon-user text-muted"></i>
							</div>
						</div>
						<div class="form-group has-feedback has-feedback-left">
							<input type="password" class="form-control" name="password" placeholder="Kullanıcı Şifresi">
							<div class="form-control-feedback">
								<i class="icon-lock2 text-muted"></i>
							</div>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Giriş Yap <i class="icon-circle-right2 position-right"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<?php include(__DIR__."/partials/footer.php"); ?>
	<?php include(__DIR__."/partials/scripts.php"); ?>
</body>
</html>
