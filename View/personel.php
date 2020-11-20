<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>
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
			<?php include("partials/personel-sidebar.php");?>
			<div class="content-wrapper">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-flat">
							<div class="panel-heading">
							<h6 class="panel-title text-semibold">Son Durum</h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li><a data-action="collapse"></a></li>
										<li><a data-action="reload"></a></li>
										<li><a data-action="close"></a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body" id="pane">
								<table class="table table-bordered table-striped table-hover datatablepin" id="formpanel">
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
				</div>
			</div>
		</div>
	</div>
	<script>
		$(function(){

		});
	</script>
	<?php include("partials/footer.php"); ?>
	<?php include("partials/scripts.php"); ?>
</body>
</html>
