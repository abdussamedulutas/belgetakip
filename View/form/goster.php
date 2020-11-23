<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Form Görüntüle"?></title>
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
		<?php if($_SESSION["role"]=="admin"): ?>
			<?php include(__DIR__."/../partials/sidebar.php");?>
            <?php elseif($_SESSION["role"]=="personel"): ?>
			<?php include(__DIR__."/../partials/personel-sidebar.php");?>
            <?php endif;?>
			<script type="text/javascript" src="assets/js/plugins/editors/wysihtml5/wysihtml5.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/editors/wysihtml5/toolbar.js"></script>
	<script type="text/javascript" src="assets/js/plugins/editors/wysihtml5/parsers.js"></script>
	<script type="text/javascript" src="assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js"></script>
			<div class="content-wrapper">
				<div class="row">
					<div class="col-md-6 col-md-push-3">
						<div class="panel panel-danger ">
							<div class="panel-heading">
								<h6 class="panel-title "><?=$data->form["FormSettings"]->name?><a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
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
											<td width="50%">
												<?=$field->name?>
											</td>
											<td>
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
												Form Kimliği
											</td>
											<td width="50%">
											<?=strtoupper($data->formid)?>
											</td>
										</tr>
										<tr>
											<td>
												Personel
											</td>
											<td>
												<?=$data->personel->name; ?><br>
												<span class="text-muted"><?=strtoupper($data->personel->id)?></span>
											</td>
										</tr>
										<tr>
											<td>
												Dosya Kimliği
											</td>
											<td>
												<?=strtoupper(bin2hex($data->form["Form"]->file_id)) ?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				<?php if(
					($data->note != false && $_SESSION["role"]=="admin") ||
					$_SESSION["role"]=="personel"
				):?>
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title "><b>[<?=$data->personel[0]->name?>]</b> <?=$data->form["FormSettings"]->name?> formu üzerine Not<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li><a data-action="collapse"></a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body">
								<div class="col-md-12 mb-15">
									<?php if($_SESSION["role"]=="personel" && $data->note != false): ?>
										<?=$data->note->text?>
									<?php else: ?>
										<textarea id="text" name="text" class="wysihtml5 wysihtml5-min form-control"><?=$data->note == false?"Not...":$data->note->text?></textarea>
									<?php endif;?>
								</div>
								<?php if(
									($data->note == false && $_SESSION["role"]=="personel") || $_SESSION["role"]=="admin"
								):?>
								<div class="col-md-6">
									<?php if($_SESSION["role"]=="personel"): ?>
										<p class="text-danger">Not: Bu forma not ekleme haricinde not değiştirme, bir başkasını ekleme veya kaldırma gibi yetkiniz bulunmuyor</p>
									<?php endif;?>
								</div>
								<div class="col-md-6 text-right">
									<?php if($_SESSION["role"]=="admin" && $data->note != false): ?>
										<button class="btn btn-danger" onclick="form_delete()">Sil</button>
										<button class="btn btn-success" onclick="form_edit()">Düzenle</button>
									<?php elseif($_SESSION["role"]=="personel" && $data->note == false): ?>
										<button class="btn btn-success" onclick="form_save()">Kaydet</button>
									<?php endif;?>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<script>
				$(function(){
					$('#text').wysihtml5({
						parserRules:  wysihtml5ParserRules,
						stylesheets: ["assets/css/components.css"]
					});
				});
				function form_save()
				{
					Notify.confirm({
						title:"Dikkat!",
						text:`Bu form için yaptığınız notu kaydetmek ister misiniz?`,
						confirmText:"Değişikliği Gönder",
						cancelText:"İptal",
						confirm:function(){
							Server.request({
								action:"addNote",
								formid:"<?=$data->formid?>",
								text:$("#text").val()
							},function(json){
								window.location.reload();
							})
						}
					});
				};
				function form_delete()
				{
					Notify.confirm({
						title:"Dikkat!",
						text:`Silmek istediğinize emin misiniz?`,
						confirmText:"Değişikliği Gönder",
						cancelText:"İptal",
						confirm:function(){
							Server.request({
								action:"removeNote",
								id:"<?=$data->note != false?$data->note->id:"null"?>"
							},function(json){
								window.location.reload();
							})
						}
					});
				};
				function form_edit()
				{
					Notify.confirm({
						title:"Dikkat!",
						text:`Bu form için yaptığınız notu kaydetmek ister misiniz?`,
						confirmText:"Değişikliği Gönder",
						cancelText:"İptal",
						confirm:function(){
							Server.request({
								action:"editNote",
								id:"<?=$data->note != false?$data->note->id:"null"?>",
								text:$("#text").val()
							},function(json){
								window.location.reload();
							})
						}
					});
				};
				</script>
			</div>
		</div>
	</div>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
