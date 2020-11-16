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
					<div class="panel panel-flat" id="pinpanel">
						<div class="panel-body">
							<div class="col-xs-6">
								<h2 style="margin-top:0">Form giriş alanları</h2>
							</div>
							<div class="col-xs-6 text-right">
								<button class="btn btn-danger" id="btn_createfield">Alan Ekle</button>
							</div>
							<div class="col-md-12">
								<table class="table table-bordered table-striped table-hover datatablepin" id="formpanel">
									<thead>
										<tr>
											<th>Alan Adı</th>
											<th>Geçerli değerleri</th>
											<th width="1%">İşlemler</th>
										</tr>
									</thead>
									<tbody>
										<!--td>
											<input type="text" style="min-width:150px" class="form-control field_name" name="field_name[]" value="Dosya Durumu">
										</td>
										<td>
											<select class="select2 field_data" name="field_data[]" multiple></select>
										</td>
										<td style="white-space:nowrap">
											<button class="btn btn-primary">Değer Ekle</button>
											<button class="btn btn-primary">Değer Sil</button>
											<button class="btn btn-primary">Nitelik Sil</button>
										</td-->
									</tbody>
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
			Server.request({
				action:"formpanel",
				id:$("#formtype").val()
			},function(json){
				p();
				var lastAdded = null;
				if(json.data instanceof Array)
				{
					for(var row of json.data){
						lastAdded = $("#formpanel").DataTable().row.add([
							`<input type="text" style="min-width:150px" class="form-control field_name" name="field_name[]" value="${row.text}">`,
							`<select class="select2 field_data" name="field_data[]" multiple>`+data.values.map(function(value){
								return `<option value="${value.id}">${value.name}</option>`
							}).join('')+`</select>`,
							``
						]);
					};
				}
			});
		}
		$(document).ready(function(){
			pinfo();
		});
		$("#btn_createfield").click(function(){
			bootbox.prompt("Yeni Giriş Alanı", function(result) {
				if(result){
					var p = block("#pinpanel");
					Server.request({
						action:"createfield",
						id:$("#formtype").val(),
						name:result
					},function(json){
						pinfo();
					})
				}
			});
		})
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
