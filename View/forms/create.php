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
			<?php include("partials/sidebar.php");?>
			<div class="content-wrapper">
				<div class="row">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Latest posts<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="collapse"></a></li>
									<li><a data-action="reload"></a></li>
									<li><a data-action="close"></a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body">
							<table class="table datatablepin table-bordered table-striped table-hove">
								<thead>
									<tr>
										<th>1</th>
										<th>2</th>
										<th>3</th>
									</tr>
								</thead>
								<tbody>
								</tbody>
							</table>
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
