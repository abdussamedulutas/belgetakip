<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Form Ayarları"?></title>
	<?php include(__DIR__."/../partials/styles.php"); ?>
</head>
<?php
	$breadcrumb = [
		"Anasayfa" => "$data->userPanelLink/sondurum"
	];
?>
<body class="navbar-bottom navbar-top sidebar-xs">
	
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
								<h2 style="margin-top:0">Dosya giriş alanları</h2>
							</div>
							<div class="col-xs-6 text-right">
								<button class="btn btn-danger" id="btn_createfield">Alan Ekle</button>
							</div>
							<div class="col-md-12 table-responsive">
								<table class="table table-bordered table-striped table-hover datatablepin no-paginate" id="formpanel">
									<thead>
										<tr>
											<th width="1%">Sıra</th>
											<th>Alan Adı</th>
											<th>Veri Türü</th>
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
			pinfo.order = 0;
			var p = block("#pinpanel");
			setTimeout(function(){
				Server.request({
					action:"formpanel"
				},function(json){
					var lastAdded = null;
					$("#formpanel").DataTable().clear().draw();
					var db = $("#formpanel").DataTable().row;
					if(json.data instanceof Array)
					{
						for(var row of json.data){
							lastAdded = db.add([
								`<input type="text" style="width:50px" class="form-control field_order" name="field_order[]" onblur="changeOrder(this)" value="${row.order}">`,
								`<input type="text" style="min-width:150px" class="form-control field_name" name="field_name[]" onblur="changeField(this)" value="${row.name}">`+
								`<input type="hidden" class="field_id" value="${row.id}">`,
								`<select class="select2 no-search field_type" onchange="changeType(this);return false">
									<option value="select" ${row.type=="select"?"selected":""}>Seçmeli</option>
									<option value="text" ${row.type=="text"?"selected":""}>Yazı</option>
									<option value="date" ${row.type=="date"?"selected":""}>Tarih</option>
								</select>`,
								`<select class="select2 field_data" name="field_data[]" ${row.type!="select"?"disabled":""}>`+row.variables.map(function(value){return `<option value="${value.id}">${value.name}</option>`}).join('')+`</select>`,
								`<select class="select2 no-search" onchange="window[this.value]&&window[this.value](this);return false">
									<option value="RO">İşlem Seç</option>
									<option value="AddVariable">Değer Ekle</option>
									<option value="ChangeVariable">Değer Değiştir</option>
									<option value="RemoveVariable">Değer Sil</option>
									<option value="RemoveField">Nitelik Sil</option>
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
		};
		$(document).ready(function(){
			pinfo();
		});
		//Notify.confirm
		function AddVariable(ths)
		{
			var tr = $(ths).closest("tr");
			var name = tr.find(".field_name").val();
			var id = tr.find(".field_id").val();
			wait2(function(){
				$(ths).val('RO').trigger('change');
			});
			bootbox.prompt(`"${name}" alanı için yeni değer`, function(result) {
				if(result){
					Server.request({
						action:"createvariable",
						id:id,
						name:result
					},function(json){
						pinfo();
					})
				}
			});
		};
		function RemoveVariable(ths)
		{
			var tr = $(ths).closest("tr");
			var field = tr.find(".field_name").val();
			if(tr.find(".field_data").find(":selected").length == 0){
				return wait2(function(){
					$(ths).val('RO').trigger('change');
				});
			};
			var variable = tr.find(".field_data").find(":selected")[0];
			var name = variable.innerText;
			var value = variable.value;
			Notify.confirm({
				title:"Dikkat!",
				text:`"${field}" isimli alanın "${name}" değerini formdan çıkarmak istediğinize emin misiniz?`,
				confirmText:"Evet, Sil",
				cancelText:"İptal",
				confirm:function(){
					Server.request({
						action:"deletevariable",
						id:value
					},function(json){
						pinfo();
					})
				}
			});
		};
		function ChangeVariable(ths)
		{
			var tr = $(ths).closest("tr");
			var field = tr.find(".field_name").val();
			if(tr.find(".field_data").find(":selected").length == 0){
				return wait2(function(){
					$(ths).val('RO').trigger('change');
				});
			};
			var variable = tr.find(".field_data").find(":selected")[0];
			var name = variable.innerText;
			var value = variable.value;
			bootbox.prompt(`"${field} alanının ${name}" değerinin adının yeni ismi?`, function(result) {
				if(result){
					Server.request({
						action:"updatevariable",
						id:value,
						name:result
					},function(json){
						pinfo();
					})
				}
			})
		};
		function RemoveField(ths)
		{
			var tr = $(ths).closest("tr");
			var name = tr.find(".field_name").val();
			var id = tr.find(".field_id").val();
			wait2(function(){
				$(ths).val('RO').trigger('change');
			});
			Notify.confirm({
				title:"Dikkat!",
				text:`${name} isimli alanı formdan çıkarmak istediğinize emin misiniz?`,
				confirmText:"Evet, Sil",
				cancelText:"İptal",
				confirm:function(){
					Server.request({
						action:"deleteField",
						id:id
					},function(json){
						pinfo();
					})
				}
			});
		};
		function changeField(ths)
		{
			var oldText = ths.defaultValue;
			var changedText = ths.value;
			if(oldText == changedText) return;
			var tr = $(ths).closest("tr");
			var id = tr.find(".field_id").val();
			Notify.confirm({
				title:"Dikkat!",
				text:`${oldText} isimli alanı ${changedText} ismi ile değiştirdiniz kalıcı olmak için kaydetmek ister misiniz?`,
				confirmText:"Değişikliği Gönder",
				cancelText:"İptal",
				confirm:function(){
					Server.request({
						action:"updateField",
						id:id,
						name:changedText
					},function(json){
						pinfo();
					})
				}
			});
		};
		function changeOrder(ths)
		{
			var Order = ths.defaultValue;
			var changedOrder = ths.value;
			if(Order == changedOrder) return;
			var tr = $(ths).closest("tr");
			var id = tr.find(".field_id").val();
			var name = tr.find(".field_name").val();
			Server.request({
				action:"updateFieldOrder",
				id:id,
				order:changedOrder,
				name:name
			},function(json){
				pinfo();
				Notify.successText("Form alanı","Form alanı veri önceliği iletildi");
			})
		};
		function changeType(ths)
		{
			var changedText = ths.value;
			var tr = $(ths).closest("tr");
			var id = tr.find(".field_id").val();
			Server.request({
				action:"changeFieldType",
				id:id,
				name:changedText
			},function(json){
				pinfo();
				Notify.successText("Form alanı","Form alanı veri tipi iletildi");
			})
		};
		$("#btn_createfield").click(function(){
			bootbox.prompt("Yeni Giriş Alanı", function(result) {
				if(result){
					var p = block("#pinpanel");
					Server.request({
						action:"createfield",
						name:result
					},function(json){
						pinfo();
					})
				}
			});
		})
	</script>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
