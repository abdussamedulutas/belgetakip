<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Panel"?></title>
	<?php include("partials/styles.php"); ?>
</head>
<?php
	$breadcrumb = [
		"Anasayfa" => "$data->userPanelLink/panel"
	];
?>
<body class="navbar-bottom navbar-top">
	
	<?php include("partials/main.navbar.php"); ?>
	<?php include("partials/main.header.php"); ?>
	<div class="page-container">
		<div class="page-content">
			<?php include("partials/sidebar.php");?>
			<div class="content-wrapper">
				<div class="row">
					<div class="panel panel-flat ">
						<div class="panel-heading">
							<h6 class="panel-title">
							Veri Yedekleri
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="collapse"></a></li>
									<li><a data-action="close"></a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-6">
									<p class="text-justify">
										Veri yedeklemeleri <a href="https://toymedya.com">Toy Medya</a> tarafından yapılmaktadır.
										Sistem içerisine yüklenmiş evrak dosyaları ve kullanıcı profil foroğrafları yedeklenmemektedir bunun haricinde
										acente, formlar, dosyalar, sistem kullanıcılarını (yönetici bilgileri, personel bilgileri, kullanıcı bilgileri) bilgileri, 
										zorunluk evraklar, dosyalara takiben üzerinde tutulmuş notlar/gelişme, sistem ayarları ve diğer sistem bilgileride yedekleme içeriklerine dahildir.<br>
										Ayrıca sistem üzerinden yapılan değiştirmeler dışında her hangi bir veriyi silme gibi işlemler yedeklemelerin haricin geri getirilebilmektedir.
										<br><br>
										Yedekten geri alma işlemi web sitesi arayüzünden yapılamamaktadır, geri alma talebinizi <a href="https://toymedya.com">Toy Medya</a> telefon hattı veya
										<a href="mail:toymedya@gmail.com">toymedya@gmail.com</a> üzerinden mail göndererek gerçekleştirebilirsiniz
										<br>
									</p>
									<p>
										Bu tablo yanlızca bilgilendirme amaçlıdır
									</p>
								</div>
								<div class="col-md-6">
									<table class="table table-bordered table-striped table-hover datatablepin no-searching inited" id="formpanel">
										<thead>
											<tr>
												<th>Yedek Tarihi (Yıl - Ay - Gün)</th>
												<th>Yedeklenen Veri</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($data->config->recoveries as $rec): ?>
												<tr>
													<td>
														<?=$rec?>
													</td>
													<td>
														Tam Yedekleme
													</td>
												</tr>
											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php include("partials/footer.php"); ?>
	<?php include("partials/scripts.php"); ?>
</body>
</html>
