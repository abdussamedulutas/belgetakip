<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Tüm Formlar"?></title>
	<?php include(__DIR__."/../partials/styles.php"); ?>
</head>
<?php
	$breadcrumb = [
		"Anasayfa" => "$data->userPanelLink/sondurum"
	];
?>
<body class="navbar-bottom navbar-top">
	
	<?php include(__DIR__."/../partials/main.navbar.php"); ?>
	<?php include(__DIR__."/../partials/main.header.php"); ?>
	<div class="page-container">
		<div class="page-content">
			<?php if($_SESSION["role"]=="admin"): ?>
			<?php include(__DIR__."/../partials/sidebar.php");?>
            <?php elseif($_SESSION["role"]=="personel"): ?>
			<?php include(__DIR__."/../partials/personel-sidebar.php");?>
            <?php endif;?>	
			<div class="content-wrapper">
				<div class="row">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">
							<?php if($_SESSION["role"]=="admin"): ?>
								Sistemdeki tüm formlar
							<?php elseif($_SESSION["role"]=="personel"): ?>
								Dosya Erişiminiz olan tüm formlar
							<?php endif;?>
								<a class="heading-elements-toggle"><i class="icon-more"></i></a>
							</h6>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="collapse"></a></li>
									<li><a data-action="close"></a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body">
							<div class="col-md-12 table-responsive">
								<table class="table table-bordered table-striped table-hover datatablepin" id="formpanel">
									<thead>
										<tr>
											<th>Dosya Adı</th>
											<th>İşlem Adı</th>
											<th>Form Adı</th>
											<th>Durum</th>
											<th>İşlem</th>
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
					action:"getFiles"
				},function(json){
					var lastAdded = null;
					$("#formpanel").DataTable().clear().draw();
					var db = $("#formpanel").DataTable().row;
					//Dosya
					for(var file of json.data.Files){
						var t = file.reqforms.split(',');
						//için gereken formlar grubunun
						for(var reqform of t)
						{
							var tname = json.data.RequiredForms[reqform].name;
							var t = json.data.RequiredForms[reqform].required.split(',');
							for(var form of t)
							{
							//Bir formu
								var f = json.data.Forms[form][0]
								var k = json.data.Processor[file.id][reqform][f.id];
								if(!json.data.Processor[file.id][reqform][f.id].status){
									lastAdded = db.add([
										file.name,
										tname,
										k.count,
										"Eklendi",
										`<a class="btn btn-success" href="<?=$data->userPanelLink?>/form/ekle?dosya=${file.id}&form=${form.id}">Göster</a>`
									]);
								};
							}
						}
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
		}
		$(document).ready(function(){
			pinfo();
		});
	</script>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
