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
		"Anasayfa" => "$data->userPanelLink/sondurum"
	];
?>
<body class="navbar-bottom navbar-top sidebar-xs">
	
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
										Sistem içerisine yüklenmiş evrak dosyaları ve kullanıcı profil foroğrafları haricinde
										acente, formlar, dosyala bilgileri , sistem kullanıcılarını (yönetici bilgileri, personel bilgileri, kullanıcı bilgileri) bilgileri, 
										zorunlu evraklar, dosyalara takiben üzerinde tutulmuş notlar/gelişme, sistem ayarları ve diğer sistem bilgileride yedekleme içeriklerine dahildir.<br>
										<br><br>
										Yedekten geri alma işlemi web sitesi arayüzünden yapılamamaktadır, geri alma işlemini <a href="https://toymedya.com">Toy Medya</a> telefon hattı veya
										<a href="mail:toymedya@gmail.com">toymedya@gmail.com</a> üzerinden mail talebinizi ileterek yapabilirsiniz.
										Sistem tasarımı gereği arayüz üzerinden <b>kalıcı olarak veri silemezsiniz</b>, kaldırmak istediğiniz evraklar, dosyalar, gelişmeler, personel verileri gibi veriler yanlızca arayüzden gizlenir. <br>
										Bunun bir avantajı olarak sistem üzerinden yapılan veri üzerinde <b>değişimeler</b> (isim değişiklikleri, email değişikliği, Evrak adı değişikliği vs)
										dışında her hangi bir veriyi silme / kaldırma türevi işlemler yedekleme ile geri alma işlemine gerek kalmadan yapılabilmektedir.
										Verilerin bütünlüğünü korumak ve geri alma işlemi sırasında girilen verilerin kaybolmaması amacıyla işlem sırasında sistem kendisini 30 saniye - 10 dakika kadar
										kapatacaktır, işlem bittiğinde tekrar otomatik olarak aktif hizmet durumuna geçecektir
									</p>
									<p>
										Bu tablo yanlızca bilgilendirme amaçlıdır
									</p>
								</div>
								<div class="col-md-6 table-responsive">
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
