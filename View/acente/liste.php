<!DOCTYPE html>
<html lang="en">
<head>
	<base href="<?=$workspaceDir?>/">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$settings->get("appname") . " | Acente Listesi"?></title>
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
			<?php include(__DIR__."/../partials/sidebar.php");?>
			<div class="content-wrapper">
				<div class="row">
                    <div class="panel panel-flat">
						<div class="panel-heading">
							<h6 class="panel-title">Acenteler<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
							<div class="heading-elements">
								<ul class="icons-list">
									<li><a data-action="collapse"></a></li>
									<li><a data-action="reload"></a></li>
									<li><a data-action="close"></a></li>
								</ul>
							</div>
						</div>
						<div class="panel-body">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-striped table-hover datatablepin">
                                    <thead>
                                        <tr>
                                            <th>Acente İsmi</th>
                                            <th width="1%"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($data->acenteler as $acente): ?>
                                        <tr>
                                            <td><?=$acente->name?></td>
                                            <td style="white-space:nowrap">
                                                <a class="btn btn-default" href="<?="$data->userPanelLink/acente/$acente->id"?>">Düzenle</a>
                                                <button class="btn btn-danger" onclick="Sil(this,'<?=$acente->id?>');">Kaldır</button>
                                            </td>
                                        </tr>
                                        <?php endforeach;    ?>
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
        function Sil(btn,id)
        {
            swal({
                title: "Dikkat",
                text: "Acente silme işlemi gerçekleştirmek istediğinize emin misiniz?",
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
                    Server.deleteAcente(id,function(){
                        swal.close();
                        $(btn).closest("tr").remove();
                        Notify.successText("Acente Hesabı","Acente Silme işlemi başarılı");
                    },function(){
                        swal.close();
                        Notify.errorText("Acente Hesabı","Acente Silme işlemi başarısız");
                    });
                }
            });
        }
    </script>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>