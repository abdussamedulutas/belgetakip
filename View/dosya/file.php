<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Dosyalar"?></title>
	<?php include(__DIR__."/../partials/styles.php"); ?>
</head>
<?php
    global $url;
	$breadcrumb = [
		"Anasayfa" => "$data->userPanelLink/panel",
		"Dosyalar" => "$data->userPanelLink/dosyalar"
	];
?>
<body class="navbar-bottom navbar-top">
	
	<?php include(__DIR__."/../partials/main.navbar.php"); ?>
	<?php include(__DIR__."/../partials/main.header.php"); ?>
	<div class="page-container">
		<div class="page-content">
			<div class="content-wrapper">
				<div class="row">
                    <div class="col-md-5">
						<div class="panel panel-danger ">
							<div class="panel-heading">
								<h6 class="panel-title ">Form<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li><a data-action="collapse"></a></li>
										<li><a data-action="close"></a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body">
								<table class="table table-bordered folding mb-15">
									<tbody>
                                        <?php foreach($data->form["FormData"] as $field): ?>
                                        <tr>
											<td>
											    <?=$field->name?>
											</td>
											<td width="50%">
											    <?=$field->text?>
                                            </td>
										</tr>
                                        <?php endforeach; ?>
									</tbody>
								</table>
								<table class="table table-bordered folding">
									<tbody>
										<tr>
											<td>
												Dosya Kimliği
											</td>
											<td width="50%">
                                                <?=bin2hex($data->form["Form"]->file_id)?>
											</td>
										</tr>
										<tr>
											<td>
												Personel
											</td>
											<td>
                                                <?=bin2hex($data->form["Form"]->user)?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-md-7">
                        <div class="panel panel-flat" id="pinpanel">
                            <div class="panel-body">
                                <div class="tabbable tab-content-bordered">
                                    <ul class="nav nav-lg nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
                                        <li class="active">
                                            <a href="#tab-1" data-toggle="tab">Gelişmeler</a>
                                        </li>
                                        <li>
                                            <a href="#tab-2" data-toggle="tab">Eksik Evraklar</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane has-padding active" id="tab-1">
                                                <div class="tabbable tab-content-bordered">
                                                    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                                                        <li class="active">
                                                            <a href="#tab1" data-toggle="tab">Hasar</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab2" data-toggle="tab">Adli Tıp</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab3" data-toggle="tab">Avukat</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab4" data-toggle="tab">İş kazası</a>
                                                        </li>
                                                    </ul>

                                                    <div class="tab-content">
                                                        <div class="tab-pane has-padding active" id="tab1">
                                                            <table class="table table-bordered table-striped table-hover datatablepin" id="pinpanel">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tarih</th>
                                                                        <th>Personel</th>
                                                                        <th>Yazı</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>

                                                        <div class="tab-pane has-padding" id="tab2">
                                                            <table class="table table-bordered table-striped table-hover datatablepin" id="pinpanel">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tarih</th>
                                                                        <th>Personel</th>
                                                                        <th>Yazı</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>

                                                        <div class="tab-pane has-padding" id="tab3">
                                                            <table class="table table-bordered table-striped table-hover datatablepin" id="pinpanel">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tarih</th>
                                                                        <th>Personel</th>
                                                                        <th>Yazı</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>

                                                        <div class="tab-pane has-padding" id="tab4">
                                                            <table class="table table-bordered table-striped table-hover datatablepin" id="pinpanel">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Tarih</th>
                                                                        <th>Personel</th>
                                                                        <th>Yazı</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody></tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="tab-pane has-padding" id="tab-2">
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
			</div>
		</div>
	</div>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
