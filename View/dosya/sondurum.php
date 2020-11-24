<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Dosyalar"?></title>
	<?php include(__DIR__."/../partials/styles.php"); ?>
</head>
<?php
    global $url;
	$breadcrumb = [
		"Anasayfa" => "$data->userPanelLink/panel",
		"Dosyalar" => "$data->userPanelLink/dosyalar"
	];
?>
<body class="navbar-bottom navbar-top">
	
	<?php include(__DIR__."/../partials/main.navbar.php"); ?>
	<?php include(__DIR__."/../partials/main.header.php"); ?>
	<div class="page-container">
		<div class="page-content">
		<?php if(ipermission("admin")): ?>
			<?php include(__DIR__."/../partials/sidebar.php");?>
            <?php elseif(ipermission("personel|kullanici")): ?>
			<?php include(__DIR__."/../partials/personel-sidebar.php");?>
            <?php endif;?>
			<div class="content-wrapper">
				<div class="row">
                    <div class="col-md-12">
						<div class="panel panel-danger ">
							<div class="panel-heading">
								<h6 class="panel-title ">Gelişmeler<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li><a data-action="collapse"></a></li>
										<li><a data-action="close"></a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body">
								<table class="table table-bordered folding mb-15" id="eksikler">
                                    <thead>
                                        <tr>
                                            <th width="15%">Dosya Numarası</th>
                                            <th width="15%">İlgili Personel</th>
                                            <th width="15%">Dosya Adı</th>
                                            <th>Eklenen Gelişme</th>
                                            <th width="1%">İşlem</th>
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
	</div>
    <script>
    function getField(obj,name)
    {
        for(var column of obj){
            if(column.name == name)
            {
                return column.text
            }
        };
    }
    function pinfo()
    {
		var editMode = <?=ipermission("admin|personel") ? "true":"false";?>;
        var p = block("#pinpanel");
        setTimeout(function(){
            Server.request({
                action:"getFilesI"
            },function(json){
                p();
                data = json.data;
                var lastAdded = null;
                $("#eksikler").DataTable().clear().draw();
                var db = $("#eksikler").DataTable().row;
                for(var file of json.data){
					lastAdded = db.add([
						`Dosya no:${file.order}`,
						file.personel.name + " " + file.personel.surname,
						file.name,
						file.text,
						`<a class="btn btn-success" href="<?=$data->userPanelLink?>/dosya/${file.order}">Dosyaya Git</a>`
					]);
                };
                if(lastAdded) lastAdded.draw();
                else{
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
	var columnid,fileid;
	function sendFormFile(_columnid,name,_fileid)
	{
		columnid = _columnid;
		fileid = _fileid;
		$("#add-file #evrakname").html(name);
		$("#add-file").modal("show");
	};
	$(function(){
		$(".actionbtn").click(function(){
			Server.request({
				action:"sendEvrak",
				fileid:fileid,
				requireid:columnid,
				file:$("#dosya")[0].files[0]
			},function(json){
				confirm("Evrak başarılı bir şekilde sisteme yüklendi");
				window.location.reload();
			})
		});
	});
    </script>
	<style>
		td:last-child {
			padding: 0px 15px !important;
		}
	</style>
	        <div id="add-file" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Dosyaya Evrak Yükle</h5>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label><span id="evrakname"></span> evrağı için dosya yükle</label>
                                <input type="file" class="form-control" id="dosya" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary actionbtn" actionbtn>Gönder</button>
                </div>
            </div>
        </div>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
