<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | İşlemler için Gerekli Formlar"?></title>
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
					<div class="panel panel-flat" id="pinpanel">
						<div class="panel-body">
							<div class="col-xs-6">
								<h2 style="margin-top:0">Gereken Formlar</h2>
							</div>
							<div class="col-xs-6 text-right">
								<button class="btn btn-success" onclick="AddRequired()">Yeni Ekle</button>
							</div>
							<div class="col-md-12">
								<table class="table table-bordered table-striped table-hover datatablepin" id="formpanel">
									<thead>
										<tr>
											<th>Gerekli Neden</th>
											<th>Gerekli formlar</th>
											<th width="1%">İşlemler</th>
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
					action:"requiredformpanel"
				},function(json){
					var lastAdded = null;
					$("#formpanel").DataTable().clear().draw();
					var db = $("#formpanel").DataTable().row;
					if(json.data.requiredForms instanceof Array)
					{
						for(var row of json.data.requiredForms){
							lastAdded = db.add([
								`<input type="text" style="min-width:150px" class="form-control field_name" name="field_name[]" onblur="changeReqFormName(this)" value="${row.name}">`+
								`<input type="hidden" class="field_id" value="${row.id}">`,
								`<select class="select2 field_data" name="field_data[]" multiple>`+json.data.allForms.map(function(value){return `<option value="${value.id}"${row.required.includes(value.id)?" selected":""}>${value.name}</option>`}).join('')+`</select>`,
								`<select class="select2 no-search" onchange="window[this.value]&&window[this.value](this);return false">
									<option value="RO">İşlem Seç</option>
									<option value="updateReqForm">Güncelle</option>
									<option value="removeReqForm">Kaldır</option>
								</select>`
							]);
						};
						if(lastAdded) lastAdded.draw();
						else{
							p();
							p=null
						};
						reinitialize();
					};
					setTimeout(function(){
						p&&p();
					},100);
				});
			},100);
		}
		$(document).ready(function(){
			pinfo();
		});
		function AddRequired(ths)
		{
			bootbox.prompt(`Yeni form grubu oluştur için isim?`, function(result) {
				if(result){
					Server.request({
						action:"createreqform",
						name:result
					},function(json){
						pinfo();
					})
				}
			});
		};
		function updateReqForm(ths)
		{
			var tr = $(ths).closest("tr");
			var id = tr.find(".field_id").val();
			var field = tr.find(".field_name").val();
			var value = tr.find(".field_data").val() && tr.find(".field_data").val().join(',') || "";
			Server.request({
				action:"updatereqformlist",
				list:value,
				id:id
			},function(json){
				pinfo();
			})
		};
		function removeReqForm(ths)
		{
			var tr = $(ths).closest("tr");
			var name = tr.find(".field_name").val();
			var id = tr.find(".field_id").val();
			wait2(function(){
				$(ths).val('RO').trigger('change');
			});
			Notify.confirm({
				title:"Dikkat!",
				text:`${name} form grubunu çıkarmak istediğinize emin misiniz?`,
				confirmText:"Evet, Sil",
				cancelText:"İptal",
				confirm:function(){
					Server.request({
						action:"deletereqform",
						id:id
					},function(json){
						pinfo();
					})
				}
			});
		};
		function changeReqFormName(ths)
		{
			var oldText = ths.defaultValue;
			var changedText = ths.value;
			if(oldText == changedText) return;
			var tr = $(ths).closest("tr");
			var id = tr.find(".field_id").val();
			Notify.confirm({
				title:"Dikkat!",
				text:`${oldText} form alanı ${changedText} ismi ile değiştirdiniz kalıcı olmak için kaydetmek ister misiniz?`,
				confirmText:"Değişikliği Gönder",
				cancelText:"İptal",
				confirm:function(){
					Server.request({
						action:"updatereqformname",
						id:id,
						name:changedText
					},function(json){
						pinfo();
					})
				}
			});
		};
	</script>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
