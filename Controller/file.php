<?php
    include("Model/File.php");
    include("Model/User.php");
    include("Model/Form.php");
    include("Model/Acente.php");
    include("Model/Notes.php");

    $main = new class extends Controller{
        public function viewFiles()
        {
            permission("admin|kullanici|personel");
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("dosya/files",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function viewHatirlatici()
        {
            permission("admin|kullanici|personel");
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("dosya/hatirlatici",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function viewFile()
        {
            $id = getUrlTokens()[2];
            $form = new Form();
            $file = new File();
            if($file->getFileNum($id) == false)
            {
                SendStatus(404);
                exit;
            };
            $id = bin2hex($file->getFileNum($id)->id);
            $data = $form->getFileForm($id);
            permission("admin|kullanici|personel");
            global $workspaceDir;
            $status = $file->getFileStatus($id);
            $note = new Notes();
            $notes = $note->get($id);
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("dosya/file",(object)[
                "userPanelLink"=>$userPanelLink,
                "form"=>$data,
                "order"=>getUrlTokens()[2],
                "status"=>$status,
                "notes"=>$notes
            ]);
        }
        public function eksikler()
        {
            permission("admin|kullanici|personel");
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("dosya/eksik",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function viewForms()
        {
            permission("admin|kullanici|personel");
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("form/tumu",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function addForm()
        {
            permission("admin");
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("dosya/addform",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function sondurum()
        {
            permission("admin|kullanici|personel");
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("dosya/sondurum",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function post()
        {
            global $workspaceDir;
            $form = new Form();
            $users = new User();
            $file = new File();
            $acente = new Acente();
            switch(Request::post("action"))
            {
                case "sendEvrak":{
                    permission("admin|personel|kullanici");
                    if(Request::file("file")){
                        $newName = Request::acceptFile("file");
                        if(!$newName){
                            Response::soap("fail","NO_FILE");
                        }
                    }else{
                        Response::soap("fail","NO_FILE");
                        return;
                    };
                    
                    $file = new File();
                    $file->createEvrak(
                        Request::post("requireid"),
                        $_SESSION["userid"],
                        Request::post("fileid"),
                        $newName
                    );
                    Response::soap("success","OK");
                    break;
                }
                case "sendNote":{
                    permission("admin|personel");
                    $note = new Notes();
                    Request::validation("POST","fileid",["require"=>true],"Dosya kimliği geçersiz");
                    Request::validation("POST","text",["require"=>true],"Yapılan açıklama geçersiz");
                    Request::validation("POST","type",["require"=>true],"Bildirilen veri geçersiz");
                    $notes = $note->add(
                        Request::post("fileid"),
                        Request::post("text"),
                        $_SESSION["userid"],
                        Request::post("type")
                    );
                    Response::soap("success","OK");
                    break;
                }
                case "deleteNote":{
                    permission("admin|personel");
                    $note = new Notes();
                    $note->delete(Request::post("id"));
                    Response::soap("success","OK");
                    break;
                }
                case "tumpersoneller":{
                    permission("admin|personel|kullanici");
                    $allAcente = $acente->getAcentePersonelAll();
                    Response::soap("success","PERSONEL_ALL",$allAcente);
                    break;
                }
                case "tumavukatlar":{
                    permission("admin|personel|kullanici");
                    $allAcente = (new User)->getAll("avukat");
                    Response::soap("success","AVUKAT_ALL",$allAcente);
                    break;
                }
                case "tumacenteler":{
                    permission("admin|personel|kullanici");
                    $allAcente = $acente->getAll();
                    Response::soap("success","ACENTE_ALL",$allAcente);
                    break;
                }
                case "tumformislemleri":{
                    permission("admin|personel|kullanici");
                    $reqforms = $form->getRequiredForms();
                    Response::soap("success","FORMREQTYPE_ALL",$reqforms);
                    break;
                }
                case "tumformlar":{
                    permission("admin|personel|kullanici");
                    $allAcente = $form->getAllType();
                    Response::soap("success","FORMTYPE_ALL",$allAcente);
                    break;
                }
                case "getFields":{
                    permission("admin|personel|kullanici");
                    $form = new Form();
                    $fields = $form->getFields(Request::post("id"));
                    Response::soap("success","FORMTYPE_ALL",$fields);
                    break;
                }
                case "saveFile":{
                    permission("admin|personel");
                    $form = new Form();
                    $fileid = $file->createFile(
                        Request::post("name"),
                        Request::post("acente"),
                        Request::post("personel"),
                        Request::post("avukat")
                    );
                    $fields = $form->getFields();
                    $values = [];
                    foreach($fields as $field)
                    {
                        $value = Request::post($field->id);
                        $values[$field->id] = $value;
                    };
                    $num = $file->getFileId($fileid)->order;
                    $id = $form->saveForm(
                        $fileid,
                        Request::post("personel"),
                        $values
                    );
                    $userPanelLink = $workspaceDir."/".$_SESSION["name"];
                    Response::soap("success","ADD_FORM",[
                        "newURL" => $userPanelLink . "/dosya/" . $num
                    ]);
                    break;
                }
                case "updateFile":{
                    permission("admin");
                    $form = new Form();
                    $fields = $form->getFields();
                    $id = Request::post("id");
                    $name = Request::post("name");
                    $acente = Request::post("acente");
                    $personel = Request::post("personel");
                    $avukat = Request::post("avukat");
                    if($file->getFileId($id) == false){
                        SendStatus(404);
                        exit;
                    };
                    $formid = $form->getFileFormId($id);
                    foreach($fields as $field)
                    {
                        $value = Request::post($field->id);
                        $form->updateValue($field->id,$formid,$value);
                    };
                    $file->updateFile($id,$name,$acente,$personel,$avukat);
                    Response::soap("success","UPDATE_FILE",true);
                    break;
                }
                case "getTypes":{
                    permission("admin|personel|kullanici");
                    $types = $form->getAllType();
                    Response::soap("success","ALL_TYPES",$types);
                    break;
                }
                case "getTypes":{
                    $types = $form->getAllType();
                    Response::soap("success","ALL_TYPES",$types);
                    break;
                }
                case "deleteFile":{
                    permission("admin");
                    $id = Request::post("id");
                    if($file->getFileId($id) == false){
                        SendStatus(404);
                        exit;
                    }else $file->deleteFile($id);
                    Response::soap("success","DELETED_FILE");
                    break;
                }
                case "getFiles":{
                    permission("admin|personel|kullanici");
                    $count = Request::post("count");
                    if(is_null($count) || empty($count)) $count = 90000000;
                    $start = Request::post("start");
                    if(is_null($start) || empty($start)) $start = 0;
                    if($_SESSION["role"] == "admin"){
                        $kle = $file->getAllFiles($start,$count);
                    }else if($_SESSION["role"] == "kullanici"){
                        $kle = $file->getAllFilesForAcente($_SESSION["acente"],$start,$count);
                    }else if($_SESSION["role"] == "personel"){
                        $kle = $file->getAllFilesForUser($_SESSION["userid"],$start,$count);
                    };
                    $note = new Notes();
                    foreach($kle as $Ofile)
                    {
                        $Ofile->evraklar = $file->getFileStatus($Ofile->id);
                        $Ofile->notes = $note->get($Ofile->id);
                        $Ofile->form = $form->getFileForm($Ofile->id);
                        unset($Ofile->form["Form"]);
                    };
                    $types = $form->getAllType();
                    $acenteler = $acente->getAll();
                    $personeller = $users->getAll('personel');
                    $avukatlar = $users->getAll('avukat');
                    $personels = [];
                    foreach($personeller as $p){
                        $personels[$p->id] = $p;
                    };
                    $acentes = [];
                    foreach($acenteler as $p){
                        $acentes[$p->id] = $p;
                    };
                    $avukats = [];
                    foreach($avukatlar as $p){
                        $avukats[$p->id] = $p;
                    };
                    Response::soap("success","FILES_ALL",[
                        "Acente"=>$acentes,
                        "Files"=>$kle,
                        "Personel"=>$personels,
                        "Avukat"=>$avukats
                    ]);
                    break;
                }
                default:{
                    SendStatus(403);
                }
            };
        }
    };