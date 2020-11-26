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
		"Anasayfa" => "$data->userPanelLink/sondurum",
		"Dosyalar" => "$data->userPanelLink/dosyalar"
    ];
    function addRemoveTD($note)
    {
        if(ipermission("admin"))
        {
?>
<td> <button class="btn btn-danger" onclick="NotSil('<?=$note->id?>')">Sil</button> </td>
<?php
        }
    };
    function addRemoveTH()
    {
        if(ipermission("admin"))
        {
?>
<th width="1%">İşlem</th>
<?php
        }
    };
?>
<body class="navbar-bottom navbar-top">
	<?php include(__DIR__."/../partials/main.navbar.php"); ?>
	<?php include(__DIR__."/../partials/main.header.php"); ?>
	<div class="page-container">
		<div class="page-content">
			<div class="content-wrapper">
				<div class="row">
                    <div class="col-md-5">
						<div class="panel panel-danger ">
							<div class="panel-heading">
								<h6 class="panel-title ">Form<a class="heading-elements-toggle"><i class="icon-more"></i></a></h6>
								<div class="heading-elements">
									<ul class="icons-list">
										<li><a data-action="collapse"></a></li>
										<li><a data-action="close"></a></li>
									</ul>
								</div>
							</div>
							<div class="panel-body table-responsive">
								<table class="table table-bordered folding mb-15">
									<tbody>
                                        <tr>
											<td>
											    Dosya Numarası
											</td>
											<td width="50%">
											    <?=$data->order?>
                                            </td>
										</tr>
                                        <?php foreach($data->form["FormData"] as $field): ?>
                                        <tr>
											<td>
											    <?=$field->name?>
											</td>
											<td width="50%">
											    <?=$field->text?>
                                            </td>
										</tr>
                                        <?php endforeach; ?>
									</tbody>
								</table>
								<table class="table table-bordered folding text-muted">
									<tbody>
										<tr>
											<td>
												Dosya Kimliği
											</td>
											<td width="50%">
                                                <?=bin2hex($data->form["Form"]->file_id)?>
											</td>
										</tr>
										<tr>
											<td>
												Personel
											</td>
											<td>
                                                <?=bin2hex($data->form["Form"]->user)?>
											</td>
										</tr>
									</tbody>
								</table>
                                <?php if(ipermission("admin")): ?>
                                <div class="col-md-12 text-right mt-5">
                                    <button class="btn btn-primary" onclick="edit()"> Güncelle </button>
                                    <button class="btn btn-danger" onclick="removeFile()"> Kaldır </button>
                                </div>
                                <?php endif; ?>
							</div>
						</div>
					</div>
					<div class="col-md-7">
                        <div class="panel panel-flat" id="pinpanel">
                            <div class="panel-body">
                                <div class="tabbable tab-content-bordered">
                                    <ul class="nav nav-lg nav-tabs nav-tabs-solid nav-tabs-component nav-justified">
                                        <li class="active">
                                            <a href="#tab-1" data-toggle="tab">Gelişmeler</a>
                                        </li>
                                        <li>
                                            <a href="#tab-2" data-toggle="tab">Eksik Evraklar</a>
                                        </li>
                                        <li>
                                            <a href="#tab-3" data-toggle="tab">Eklenen Evraklar</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane has-padding active" id="tab-1">
                                                <div class="tabbable tab-content-bordered">
                                                    <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                                                        <li class="active">
                                                            <a href="#tab1" data-toggle="tab">Hasar</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab2" data-toggle="tab">Adli Tıp</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab3" data-toggle="tab">Avukat</a>
                                                        </li>
                                                        <li>
                                                            <a href="#tab4" data-toggle="tab">İş kazası</a>
                                                        </li>
                                                    </ul>

                                                    <div class="tab-content">
                                                        <div class="tab-pane has-padding active table-responsive" id="tab1">
                                                            <table class="table table-bordered table-striped table-hover datatablepin">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="1%">Tarih</th>
                                                                        <th width="1%">Personel</th>
                                                                        <th>Yazı</th>
                                                                        <?php addRemoveTH(); ?>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php foreach($data->notes as $note): if($note->type!= "Hasar") continue; ?>
                                                                <tr>
                                                                    <td style="white-space:nowrap">
                                                                        <?=$note->tarih?>
                                                                    </td>
                                                                    <td style="white-space:nowrap">
                                                                        <?=$note->username?> <?=$note->usersurname?>
                                                                    </td>
                                                                    <td style="white-space:nowrap">
                                                                        <?=$note->text?>
                                                                    </td>
                                                                    <?php addRemoveTD($note); ?>
                                                                </tbody>
                                                                 <?php endforeach; ?>
                                                            </table>
                                                            <?php if(ipermission("admin|personel")): ?>
                                                            <div class="row send-note">
                                                                <div class="col-md-12">
                                                                    <h2>Hasar için gelişme gönder</h2>
                                                                </div>
                                                                <div class="col-md-11">
                                                                    <textarea class="form-control" placeholder="Gelişme ekle"></textarea>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button class="btn btn-success" onclick="sendNote(this,'Hasar')">Gönder</button>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="tab-pane has-padding table-responsive" id="tab2">
                                                            <table class="table table-bordered table-striped table-hover datatablepin">
                                                            <thead>
                                                                    <tr>
                                                                        <th width="1%">Tarih</th>
                                                                        <th width="1%">Personel</th>
                                                                        <th>Yazı</th>
                                                                        <?php addRemoveTH(); ?>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php foreach($data->notes as $note): if($note->type!= "Adli Tıp") continue; ?>
                                                                <tr>
                                                                    <td style="white-space:nowrap">
                                                                        <?=$note->tarih?>
                                                                    </td>
                                                                    <td style="white-space:nowrap">
                                                                        <?=$note->username?> <?=$note->usersurname?>
                                                                    </td>
                                                                    <td style="white-space:nowrap">
                                                                        <?=$note->text?>
                                                                    </td>
                                                                    <?php addRemoveTD($note); ?>
                                                                </tbody>
                                                                 <?php endforeach; ?>
                                                            </table>
                                                            <?php if(ipermission("admin|personel")): ?>
                                                            <div class="row send-note">
                                                                <div class="col-md-12">
                                                                    <h2>Adli tıp için gelişme gönder</h2>
                                                                </div>
                                                                <div class="col-md-11">
                                                                    <textarea class="form-control" placeholder="Gelişme ekle"></textarea>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button class="btn btn-success" onclick="sendNote(this,'Adli Tıp')">Gönder</button>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="tab-pane has-padding table-responsive" id="tab3">
                                                            <table class="table table-bordered table-striped table-hover datatablepin">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="1%">Tarih</th>
                                                                        <th width="1%">Personel</th>
                                                                        <th>Yazı</th>
                                                                        <?php addRemoveTH(); ?>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php foreach($data->notes as $note): if($note->type!= "Avukat") continue; ?>
                                                                <tr>
                                                                    <td style="white-space:nowrap">
                                                                        <?=$note->tarih?>
                                                                    </td>
                                                                    <td style="white-space:nowrap">
                                                                        <?=$note->username?> <?=$note->usersurname?>
                                                                    </td>
                                                                    <td style="white-space:nowrap">
                                                                        <?=$note->text?>
                                                                    </td>
                                                                    <?php addRemoveTD($note); ?>
                                                                </tbody>
                                                                 <?php endforeach; ?>
                                                            </table>
                                                            <?php if(ipermission("admin|personel")): ?>
                                                            <div class="row send-note">
                                                                <div class="col-md-12">
                                                                    <h2>Avukat için gelişme gönder</h2>
                                                                </div>
                                                                <div class="col-md-11">
                                                                    <textarea class="form-control" placeholder="Gelişme ekle"></textarea>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button class="btn btn-success" onclick="sendNote(this,'Avukat')">Gönder</button>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="tab-pane has-padding table-responsive" id="tab4">
                                                            <table class="table table-bordered table-striped table-hover datatablepin">
                                                            <thead>
                                                                    <tr>
                                                                        <th width="1%">Tarih</th>
                                                                        <th width="1%">Personel</th>
                                                                        <th>Yazı</th>
                                                                        <?php addRemoveTH(); ?>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php foreach($data->notes as $note): if($note->type != "İş Kazası") continue; ?>
                                                                <tr>
                                                                    <td style="white-space:nowrap">
                                                                        <?=$note->tarih?>
                                                                    </td>
                                                                    <td style="white-space:nowrap">
                                                                        <?=$note->username?> <?=$note->usersurname?>
                                                                    </td>
                                                                    <td style="white-space:nowrap">
                                                                        <?=$note->text?>
                                                                    </td>
                                                                    <?php addRemoveTD($note); ?>
                                                                </tbody>
                                                                 <?php endforeach; ?>
                                                            </table>
                                                            <?php if(ipermission("admin|personel")): ?>
                                                            <div class="row send-note">
                                                                <div class="col-md-12">
                                                                    <h2>İş kazası için gelişme gönder</h2>
                                                                </div>
                                                                <div class="col-md-11">
                                                                    <textarea class="form-control" placeholder="Gelişme ekle"></textarea>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <button class="btn btn-success" onclick="sendNote(this,'İş Kazası')">Gönder</button>
                                                                </div>
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="tab-pane has-padding table-responsive" id="tab-2">
                                            <table class="table table-bordered table-striped table-hover datatablepin" id="eksikevraklar">
                                                <thead>
                                                    <tr>
                                                        <th>İsim</th>
                                                        <th width="1%"></th>
                                                        <th width="1%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($data->status->RequiredFormFile as $file): if($file->status) continue; ?>
                                                    <tr class="text-danger">
                                                        <td>
                                                            <?=$file->name?>
                                                        </td>
                                                        <td style="white-space:nowrap">
                                                            Eksik Evrak
                                                        </td>
                                                        <?php if(ipermission("admin|personel")): ?>
                                                            <td style="white-space:nowrap">
                                                                <button class="btn btn-success" onclick="sendFormFile('<?=$file->id?>','<?=$file->name?>')">Ekle</button>
                                                            </td>
                                                        <?php else: ?>
                                                            <td style="white-space:nowrap"></td>
                                                        <?php endif; ?>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="tab-pane has-padding table-responsive" id="tab-3">
                                            <table class="table table-bordered table-striped table-hover datatablepin" id="eksikevraklar">
                                                <thead>
                                                    <tr>
                                                        <th>İsim</th>
                                                        <th width="1%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($data->status->RequiredFormFile as $file): if(!$file->status) continue; ?>
                                                    <tr class="text-success">
                                                        <td>
                                                            <?=$file->name?>
                                                        </td>
                                                        <td style="white-space:nowrap">
                                                            <a class="btn btn-success" href="uploads/<?=$file->filepath?>" download target="blank">Dosyayı indir</a>
                                                        </td>
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
			</div>
		</div>
	</div>
    <script>
        function sendNote(btn,type)
        {
            var text = $(btn).closest(".send-note").find("textarea").val();
            if(!text || text.length == 0 || text.trim().length == 0) return;
            Notify.confirm({
                title:"Dikkat!",
                text:`Bu notu göndermek istediğinize emin misiniz?`,
                confirmText:"Evet, Gönder",
                cancelText:"İptal",
                confirm:function(){
                    Server.request({
                        action:"sendNote",
                        text:text,
                        type:type,
                        fileid:"<?=bin2hex($data->form["Form"]->file_id)?>"
                    },function(json){
                        window.location.reload();
                    })
                }
            });
        };
        function NotSil(id)
        {
            Notify.confirm({
                title:"Dikkat!",
                text:`Bu notu silmek istediğinize emin misiniz?`,
                confirmText:"Evet, Gönder",
                cancelText:"İptal",
                confirm:function(){
                    Server.request({
                        action:"deleteNote",
                        id:id
                    },function(json){
                        window.location.reload();
                    })
                }
            });
        };
        var fileid;
        function sendFormFile(_fileid,name)
        {
            fileid = _fileid;
            $("#add-file #evrakname").html(name);
            $("#add-file").modal("show");
        };
        $(function(){
            $(".actionbtn").click(function(){
                Server.request({
                    action:"sendEvrak",
                    fileid:"<?=bin2hex($data->form["Form"]->file_id)?>",
                    requireid:fileid,
                    file:$("#dosya")[0].files[0]
                },function(json){
                    confirm("Evrak başarılı bir şekilde sisteme yüklendi");
                   window.location.reload();
                })
            });
        });
    </script>
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
    </div>

    <script>
    var tumacenteler = false;
    var tumpersoneller = false;
    var tumformislemleri = false;
    var data = null;
    function getField(obj,name)
    {
        for(var column of obj){
            if(column.name == name)
            {
                return column.text
            }
        };
    }
    var tumacenteler,tumpersoneller;
    $(function(){
        Server.request({
            action:"tumacenteler"
        },function(json){
            tumacenteler = json.data
        })
        Server.request({
            action:"tumpersoneller"
        },function(json){
            tumpersoneller = json.data;
        })
    });
    function edit()
    {
        autoCommit = true;
        if(!tumacenteler) return;

        $("#acente").html(
        tumacenteler.map(function(acente){
            return `<option value="${acente.id}">${acente.name}</option>`
        }));
        $("#acente").trigger("change");
        $("#personel").html(tumpersoneller.map(function(pers){
            return `<option value="${pers.id}">${pers.name} ${pers.surname}</option>`
        }));
        $("#personel").trigger("change");
        $("#addfile").modal("show");
        autoCommit = false;
    }
    </script>
	<div id="addfile" class="modal fade">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h5 class="modal-title">Dosya Güncelleme</h5>
                </div>
                <form class="modal-body" id="createform">
                    <input type="hidden" name="id" value="<?=$data->status->File->id?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Dosya İsmi</label>
                                <input type="text" id="fname" name="name" class="form-control" value="<?=$data->status->File->name?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6">
                                <label>İlgili Acente</label>
                                <select class="select2 no-search" id="acente" name="acente">
                                    <option value="RO">Acente Seç</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label>Acente Personeli</label>
                                <select class="select2 no-search" id="personel" name="personel">
                                    <option value="RO">Personel Seç</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table table-bordered table-striped table-hover datatablepin no-paginate no-searching no-order" id="newformdata">
                                    <thead>
                                        <tr>
                                            <th>İsim</th>
                                            <th width="50%">Değer</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Kapat</button>
                    <button type="submit" class="btn btn-primary" onclick="Server.updateFile(this)">Gönder</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        var data = <?=json_encode($data->form["FormData"])?>;
        var values = {};
        data.map(function(val){
            values[val.field] = val;
        });
        $(function(){
            Server.request({
                action:"getFields"
            },function(json){
                var last;
                $("#newformdata").DataTable().clear()
                for(var k of json.data){
                    last = $("#newformdata").DataTable().row.add([
                        `${k.name}`,
                        input(k.type,k.id,k.variables)
                    ])
                };
                last.draw();
                reinitialize();
            })
            function input(type,id,valuec)
            {
                var selectedValue = values[id];
                switch(type)
                {
                    case "select": return `<select class="select2 field_data" name="${id}"><option>Seçin</option>`+valuec.map(function(value){return `<option value="${value.id}" ${selectedValue?value.id==selectedValue.textid?"selected":"":""}>${value.name}</option>`}).join('')+`</select>`;
                    case "text": return `<input class="form-control field_data" name="${id}" value='${selectedValue.text}'>`;
                    case "date": return `<input type="date" class="form-control field_data" name="${id}" value="${selectedValue.text}">`;
                }
            };
            Server.updateFile = function(btn)
            {
                var b = blockbtn(btn);
                var t = new FormData($("#createform")[0]);
                t.append("action","updateFile");
                Server.request(t,function(json){
                    setTimeout(function(){
                        b();
                        window.location.reload();
                    },500);
                })
            };
        });
        function removeFile()
        {
            Notify.confirm({
                title:"Uyarı",
                text:"Bu dosya silindiğinde evraklar ve gelişmelerde gösterilemeyecek yinede silmek istediğinize emin misiniz?",
                confirmText:"Evet, Sil",
                confirm:function(){
                    var k = Notify.progress("Dosya Silme","Dosya silme isteği iletiliyor");
                    Server.request({
                        action:"deleteFile",
                        id:"<?=$data->status->File->id?>"
                    },function(json){
                        k();
                        Notify.progress("Dosya Silme","Dosya silme işlemi başarılı");
                        setTimeout(function(){
                            window.location = "<?="$data->userPanelLink/dosyalar"?>";
                        },1000);
                    })
                }
            });
        }
    </script>
    <style>
    .nav-tabs:before{
        content:'' !important;
        display:none !important;
    }
    </style>
	<?php include(__DIR__."/../partials/footer.php"); ?>
	<?php include(__DIR__."/../partials/scripts.php"); ?>
</body>
</html>
