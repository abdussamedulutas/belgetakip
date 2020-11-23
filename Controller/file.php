<?php
    include("Model/File.php");
    include("Model/User.php");
    include("Model/Form.php");
    include("Model/Acente.php");
    include("Model/Notification.php");

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
        public function viewFile()
        {
            $id = getUrlTokens()[2];
            $form = new Form();
            $file = new File();
            $id = bin2hex($file->getFileNum($id)->id);
            $data = $form->getFileForm($id);
            permission("admin|kullanici|personel");
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("dosya/file",(object)[
                "userPanelLink"=>$userPanelLink,
                "form"=>$data
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
        public function post()
        {
            global $workspaceDir;
            $form = new Form();
            $users = new User();
            $file = new File();
            $acente = new Acente();
            switch(Request::post("action"))
            {
                case "tumpersoneller":{
                    permission( "admin");
                    $allAcente = $acente->getAcentePersonelAll();
                    Response::soap("success","PERSONEL_ALL",$allAcente);
                    break;
                }
                case "tumacenteler":{
                    permission( "admin");
                    $allAcente = $acente->getAll();
                    Response::soap("success","ACENTE_ALL",$allAcente);
                    break;
                }
                case "tumformislemleri":{
                    permission( "admin");
                    $reqforms = $form->getRequiredForms();
                    Response::soap("success","FORMREQTYPE_ALL",$reqforms);
                    break;
                }
                case "tumformlar":{
                    permission( "admin");
                    $allAcente = $form->getAllType();
                    Response::soap("success","FORMTYPE_ALL",$allAcente);
                    break;
                }
                case "getFields":{
                    $form = new Form();
                    $fields = $form->getFields(Request::post("id"));
                    Response::soap("success","FORMTYPE_ALL",$fields);
                    break;
                }
                case "saveFile":{
                    permission( "admin");
                    $form = new Form();
                    $fileid = $file->createFile(
                        Request::post("name"),
                        Request::post("acente"),
                        Request::post("personel")
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
                case "getTypes":{
                    $types = $form->getAllType();
                    Response::soap("success","ALL_TYPES",$types);
                    break;
                }
                case "getTypes":{
                    $types = $form->getAllType();
                    Response::soap("success","ALL_TYPES",$types);
                    break;
                }
                case "changeFile":{
                    permission( "admin");
                    Response::soap("success","CHANGED_FILE");
                    break;
                }
                case "deleteFile":{
                    permission( "admin");
                    Response::soap("success","DELETED_FILE");
                    break;
                }
                case "getFiles":{
                    permission("admin|personel|kullanici");
                    if($_SESSION["role"] == "admin"){
                        $kle = $file->getAllFiles();
                    }else{
                        $kle = $file->getAllFilesForUser($_SESSION["userid"]);
                    }
                    $types = $form->getAllType();
                    $acenteler = $acente->getAll();
                    $personeller = $users->getAll('personel');
                    $personels = [];
                    foreach($personeller as $p){
                        $personels[$p->id] = $p;
                    };
                    $acentes = [];
                    foreach($acenteler as $p){
                        $acentes[$p->id] = $p;
                    };
                    Response::soap("success","FILES_ALL",[
                        "Acente"=>$acentes,
                        "Files"=>$kle,
                        "Personel"=>$personels
                    ]);
                    break;
                }
                default:{
                    SendStatus(403);
                }
            };
        }
    };