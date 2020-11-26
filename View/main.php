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
<body class="navbar-bottom navbar-top">
	
	<?php include("partials/main.navbar.php"); ?>
	<?php include("partials/main.header.php"); ?>
	<div class="page-container">
		<div class="page-content">
			<?php include("partials/sidebar.php");?>
			<div class="content-wrapper">
				<div class="row">
					
				</div>
			</div>
		</div>
	</div>
	<?php include("partials/footer.php"); ?>
	<?php include("partials/scripts.php"); ?>
</body>
</html>
