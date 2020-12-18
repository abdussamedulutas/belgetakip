<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Son Durum"?></title>
	<?php include(__DIR__."/../partials/styles.php"); ?>
</head>
<?php
    global $url;
	$breadcrumb = [
		"Anasayfa" => "$data->userPanelLink/sondurum",
		"Dosyalar" => "$data->userPanelLink/dosyalar"
	];
?>
<body class="navbar-bottom navbar-top sidebar-xs">
	
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
							<div class="panel-body table-responsive">
								<ul class="media-list media-list-linked" id="partofkey">
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script>
    function getField(obj,id)
    {
        for(var column of obj){
            if(column.type == "date")
            {
                if(column.field == id)
                {
                    return moment(column.text).format("DD/MM/YYYY")
                }
            }else{
                if(column.field == id)
                {
                    return column.text
                }
            }
        };
        return "";
    };
    function pinfo()
    {
		var editMode = <?=ipermission("admin|personel") ? "true":"false";?>;
        var p = block("#pinpanel");
        setTimeout(function(){
            Server.request({
                action:"getFiles"
            },function(json){
                p();
                data = json.data;
                var lastAdded = null;
                $("#partofkey").html("");
				var content = [];
				var roles = {
					'admin':'Yönetici',
					'personel':"Personel",
					"avukat":"Avukat"
				}
				var empty = true;
                for(var file of json.data.Files){
					var D = moment(file.createdate).locale("tr");
					var E24saatOnce = moment().subtract(24,"hours").locale("tr");
					if(moment(D).isBefore(E24saatOnce)) continue;
					D = D.fromNow();
					empty = false;
					var müvekkil = getField(file.form.FormData,"9AD70292DDAC62F604F79C57E78896D9");
					content.push(`
					<li class="media">
						<div class="media-link cursor-pointer collapsed" data-toggle="collapse" data-target="#no_${file.note_id}" aria-expanded="false">
							<div class="media-left"><img src="${file.personel.image?"uploads/"+file.personel.image:"assets/images/placeholder.jpg"}" class="img-circle img-md" alt=""></div>
							<div class="media-body">
								<div class="media-heading text-semibold">Dosya No: ${file.order} - ${Tarih(file.createdate)} <span class="text-muted">(${D})</span></div>
								<div class="media-heading text-semibold">Müvekkil : ${getField(file.form.FormData,"9AD70292DDAC62F604F79C57E78896D9")}</div>
								<span class="text-muted">${file.text}</span>
							</div>
							<div class="media-right media-middle text-nowrap">
								<i class="icon-menu7 display-block"></i>
							</div>
						</div>
						<div class="collapse" id="no_${file.note_id}" aria-expanded="false" style="height: 0px;">
							<div class="contact-details row">
								<div class="col-xs-6">
									<ul class="list-extended list-unstyled list-icons">
										<li><i class="icon-user-tie position-left"></i> <b>Ekleyen ${roles[file.personel.role]} :</b> ${file.personel.name} ${file.personel.surname}</li>
										<li><i class="icon-location3 position-left"></i> <b>Acente:</b> ${file.acente.name} </li>
									</ul>
								</div>
								<div class="col-xs-6">
									<ul class="list-extended list-unstyled list-icons text-right">
										<li><a class="btn btn-success" href="<?=$data->userPanelLink?>/dosya/${file.order}">Aç</a></li>
									</ul>
								</div>
							</div>
						</div>
					</li>`);
                };
				if(empty){
					content.push(`
					<li class="media">
						<div class="media-link cursor-pointer">
							<div class="media-body">
								<div class="media-heading text-semibold">Son 24 saatte her hangi bir gelişme olmadı</div>
							</div>
						</div>
					</li>`);
				}
				$("#partofkey").html(content.join(''));
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
