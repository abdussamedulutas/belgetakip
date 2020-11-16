<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Forma Oluştur"?></title>
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
							<h6 class="panel-title">Form Tipleri<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="collapse"></a></li>
									<li><a data-action="reload"></a></li>
									<li><a data-action="close"></a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body">
							<div class="col-md-9">
								<select class="select2" id="formtype">
									<?php foreach($data->types as $type): ?>
									<option value="<?=$type->id?>"><?=$type->name?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col-md-3">
								<button class="btn btn-success" id="btn_create">Yeni Ekle</button>
								<button class="btn btn-primary" id="btn_change">Değiştir</button>
								<button class="btn btn-danger" id="btn_delete">Sil</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$("#btn_create").click(function(){
			bootbox.prompt("Yeni Form Türü İsmi", function(result) {
				if(result){
					Server.createFormType(result,function(){
						window.location.reload();
					});
				}
			});
		})
		$("#btn_change").click(function(){
			bootbox.prompt("İsim", function(result) {
				var id = $("#formtype").val();
				if(result){
					Server.updateFormType(id,result,function(){
						window.location.reload();
					});
				}
			});
		});
		$("#btn_delete").click(function(){
			var id = $("#formtype").val();
			swal({
				title: "Dikkat",
				text: "Form türü silme işlemi gerçekleştirmek istediğinize emin misiniz?",
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
					Server.deleteFormType(id,function(){
						window.location.reload();
					});
				}
			});
		});
	</script>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
