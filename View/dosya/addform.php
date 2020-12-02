<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Form Ekle"?></title>
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
					<div class="panel panel-flat">
                        <div class="panel-heading">
							<h6 class="panel-title">Yeni Dosya Ekle<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="collapse"></a></li>
									<li><a data-action="reload"></a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body" id="pane">
                            <form class="col-md-6 col-md-push-3 table-responsive" id="form">
                                <table class="table table-bordered table-striped table-hover datatablepin no-paginate no-searching no-order" id="formpanel">
                                    <thead>
                                        <tr>
                                            <th>İsim</th>
                                            <th width="50%">Değer</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </form>
                            <div class="col-md-12 text-center">
                                <button class="btn btn-success" onclick="yeniForm()">Kaydet</button>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    <script>
    var tumacenteler = false;
    var tumformislemleri = false;
    var tumformlar = false;
    var autoCommit = false;
    var data = null;
    function yeniForm()
    {
        var progress = Notify.progress("Form Ekle","Bilgiler iletiliyor");
        var data = new FormData($("#form")[0]);
        data.append("action","AddForm");
        data.append("language",navigator.language);
        data.append("fileid",$("#file").val().split('|')[0]);
        Server._ajax(window.location.pathname,data,function(ans) {
            if(ans.status == "success")
            {
                progress.remove();
                Notify.successText("Form Ekle","Başarıyla eklendi",progress,3000);
                setTimeout(function(){
                    window.location = ans.data.newURL;
                },1000);
            }else Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
        },function(){
            Notify.errorText("Hata!","Sunucu tarafında hata oluştu",progress,3000);
        });
    };

    </script>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
