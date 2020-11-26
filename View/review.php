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
	function tid($id)
	{?>
		<td><a href="/review#id_<?=bin2hex($id)?>"><?=bin2hex($id)?></a></td>
	<?php
	}
	function rid($id)
	{?>
		<td><a id="id_<?=bin2hex($id)?>" id=""><?=bin2hex($id)?></a></td>
	<?php
	}
	function text($text)
	{?>
		<td><?=$text?></td>
	<?php
	}
?>
<body class="navbar-bottom navbar-top">
	
	<?php include("partials/main.navbar.php"); ?>
	<?php include("partials/main.header.php"); ?>
	<div class="page-container">
		<div class="page-content">
			<div class="content-wrapper">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-flat">
							<div class="panel-body table-responsive">
								<h2>Acenteler</h2>
								<table class="table table-bordered table-striped table-hover inited" id="formpanel">
									<thead>
										<tr>
											<?php foreach($data->acente as $row): ?>
												<?php foreach($row as $name => $value): ?>
												<th><?=$name?></th>
												<?php endforeach;break; ?>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data->acente as $row): ?>
										<tr>
											<?=rid($row->id)?>
											<?=text($row->name)?>
											<?=text($row->image)?>
											<?=text($row->createdate)?>
											<?=text($row->modifydate)?>
											<?=text($row->deletedate)?>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="panel-body table-responsive">
								<h2>Dosyalar</h2>
								<table class="table table-bordered table-striped table-hover inited" id="formpanel">
									<thead>
										<tr>
											<?php foreach($data->file as $row): ?>
												<?php foreach($row as $name => $value): ?>
												<th><?=$name?></th>
												<?php endforeach;break; ?>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data->file as $row): ?>
										<tr>
											<?=rid($row->id)?>
											<?=text($row->name)?>
											<?=text($row->required_forms)?>
											<?=tid($row->acente_id)?>
											<?=tid($row->personel_id)?>
											<?=text($row->lastinsetdate)?>
											<?=text($row->createdate)?>
											<?=text($row->modifydate)?>
											<?=text($row->deletedate)?>
											<?=text($row->order)?>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="panel-body table-responsive">
								<h2>Formlar</h2>
								<table class="table table-bordered table-striped table-hover inited" id="formpanel">
									<thead>
										<tr>
											<?php foreach($data->forms as $row): ?>
												<?php foreach($row as $name => $value): ?>
												<th><?=$name?></th>
												<?php endforeach;break; ?>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data->forms as $row): ?>
										<tr>
											<?=rid($row->id)?>
											<?=tid($row->type_id)?>
											<?=tid($row->file_id)?>
											<?=tid($row->require_id)?>
											<?=tid($row->user)?>
											<?=text($row->createdate)?>
											<?=text($row->modifydate)?>
											<?=text($row->deletedate)?>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="panel-body table-responsive">
								<h2>Form Alanları</h2>
								<table class="table table-bordered table-striped table-hover inited" id="formpanel">
									<thead>
										<tr>
											<?php foreach($data->form_fields as $row): ?>
												<?php foreach($row as $name => $value): ?>
												<th><?=$name?></th>
												<?php endforeach;break; ?>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data->form_fields as $row): ?>
										<tr>
											<?=rid($row->id)?>
											<?=text($row->name)?>
											<?=text($row->order)?>
											<?=text($row->type)?>
											<?=text($row->createdate)?>
											<?=text($row->modifydate)?>
											<?=text($row->deletedate)?>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="panel-body table-responsive">
								<h2>Form Evrak Dosyaları</h2>
								<table class="table table-bordered table-striped table-hover inited" id="formpanel">
									<thead>
										<tr>
											<?php foreach($data->form_files as $row): ?>
												<?php foreach($row as $name => $value): ?>
												<th><?=$name?></th>
												<?php endforeach;break; ?>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data->form_files as $row): ?>
										<tr>
											<?=rid($row->id)?>
											<?=tid($row->user)?>
											<?=tid($row->requireid)?>
											<?=tid($row->fileid)?>
											<?=text($row->filepath)?>
											<?=text($row->createdate)?>
											<?=text($row->modifydate)?>
											<?=text($row->deletedate)?>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="panel-body table-responsive">
								<h2>Gelişmeler</h2>
								<table class="table table-bordered table-striped table-hover inited" id="formpanel">
									<thead>
										<tr>
											<?php foreach($data->form_notes as $row): ?>
												<?php foreach($row as $name => $value): ?>
												<th><?=$name?></th>
												<?php endforeach;break; ?>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data->form_notes as $row): ?>
										<tr>
											<?=rid($row->id)?>
											<?=tid($row->file_id)?>
											<?=tid($row->user)?>
											<?=text($row->text)?>
											<?=text($row->type)?>
											<?=text($row->createdate)?>
											<?=text($row->modifydate)?>
											<?=text($row->deletedate)?>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="panel-body table-responsive">
								<h2>Form için gerekenler</h2>
								<table class="table table-bordered table-striped table-hover inited" id="formpanel">
									<thead>
										<tr>
											<?php foreach($data->form_require as $row): ?>
												<?php foreach($row as $name => $value): ?>
												<th><?=$name?></th>
												<?php endforeach;break; ?>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data->form_require as $row): ?>
										<tr>
											<?=rid($row->id)?>
											<?=text($row->name)?>
											<?=text($row->createdate)?>
											<?=text($row->modifydate)?>
											<?=text($row->deletedate)?>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="panel-body table-responsive">
								<h2>Form alanları değişkenlerı</h2>
								<table class="table table-bordered table-striped table-hover inited" id="formpanel">
									<thead>
										<tr>
											<?php foreach($data->form_variables as $row): ?>
												<?php foreach($row as $name => $value): ?>
												<th><?=$name?></th>
												<?php endforeach;break; ?>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data->form_variables as $row): ?>
										<tr>
											<?=rid($row->id)?>
											<?=tid($row->field_id)?>
											<?=text($row->name)?>
											<?=text($row->order)?>
											<?=text($row->createdate)?>
											<?=text($row->modifydate)?>
											<?=text($row->deletedate)?>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="panel-body table-responsive">
								<h2>Kullanıcı Katmanları</h2>
								<table class="table table-bordered table-striped table-hover inited" id="formpanel">
									<thead>
										<tr>
											<?php foreach($data->user as $row): ?>
												<?php foreach($row as $name => $value): ?>
												<th><?=$name?></th>
												<?php endforeach;break; ?>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data->user as $row): ?>
										<tr>
											<?=rid($row->id)?>
											<?=text($row->name)?>
											<?=text($row->surname)?>
											<?=text($row->password)?>
											<?=text($row->role)?>
											<?=tid($row->acente_id)?>
											<?=text($row->birthday)?>
											<?=text($row->image)?>
											<?=text($row->email)?>
											<?=text($row->extra)?>
											<?=text($row->createdate)?>
											<?=text($row->modifydate)?>
											<?=text($row->deletedate)?>
										</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
							<div class="panel-body table-responsive">
								<h2>Form Değerleri</h2>
								<table class="table table-bordered table-striped table-hover inited" id="formpanel">
									<thead>
										<tr>
											<?php foreach($data->degerler as $row): ?>
												<?php foreach($row as $name => $value): ?>
												<th><?=$name?></th>
												<?php endforeach;break; ?>
											<?php endforeach; ?>
										</tr>
									</thead>
									<tbody>
										<?php foreach($data->user as $degerler): ?>
										<tr>
											<?=rid($row->id)?>
											<?=tid($row->formid)?>
											<?=text($row->field)?>
											<?=text($row->text)?>
										</tr>
										<?php endforeach; ?>
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
		$(function(){

		});
	</script>
	<?php include("partials/footer.php"); ?>
	<?php include("partials/scripts.php"); ?>
</body>
</html>
