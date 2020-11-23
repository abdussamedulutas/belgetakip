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
                    foreach($reqforms as $tforms)
                    {
                        $tforms->required = explode(',',$tforms->required);
                    };
                    Response::soap("success","FORMREQTYPE_ALL",$reqforms);
                    break;
                }
                case "tumformlar":{
                    permission( "admin");
                    $allAcente = $form->getAllType();
                    Response::soap("success","FORMTYPE_ALL",$allAcente);
                    break;
                }
                case "AddForm":{
                    permission( "admin");
                    $form = new Form();
                    $fields = $form->getFields(Request::post("typeid"));
                    $fileid = Request::post("fileid");
                    $requireid = Request::post("requireid");
                    $values = [];
                    foreach($fields as $field)
                    {
                        $value = Request::post($field->id);
                        $values[$field->id] = $value;
                    };
                    
                    $id = $form->saveForm(
                        $fileid,
                        $requireid,
                        Request::post("typeid"),
                        Request::post("userid"),
                        $values
                    );
                    $userPanelLink = $workspaceDir."/".$_SESSION["name"];
                    Response::soap("success","ADD_FORM",[
                        "newURL" => $userPanelLink . "/form/" . $id
                    ]);
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
                    $file->createFile(
                        Request::post("name"),
                        Request::post("requiredForms"),
                        Request::post("acente"),
                        Request::post("personel")
                    );
                    Response::soap("success","SAVED_FILE");
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
                    $formtype = [];
                    $formlar = [];
                    $acenteler = [];
                    $personeller = [];
                    $fakes = [];
                    foreach($kle as $filec)
                    {
                        $forms = explode(',',$filec->reqforms);
                        foreach($forms as $requiredId)
                        {
                            $formtype[$requiredId] = $form->getRequiredForm($requiredId);
                            $forms = explode(',',$formtype[$requiredId]->required);
                            foreach($forms as $reelform)
                            {
                                $formlar[$reelform] = $form->getType($reelform);
                            };
                        };
                        $acenteler[$filec->acente] = $acente->getAcente($filec->acente);
                        $personeller[$filec->personel] = $users->get($filec->personel);
                        $fake = $file->getStatus($filec->id);
                        if(!isset($fakes[$filec->id])) $fakes[$filec->id] = [];
                        foreach($fake as $name => $k)
                        {
                            if(!isset($fakes[$filec->id][$name])) $fakes[$name] = [];
                            foreach($k as $kname => $t)
                            {
                                $fakes[$filec->id][$name][$kname] = $t;
                            };
                        };
                    };
                    Response::soap("success","FILES_ALL",[
                        "Acente"=>$acenteler,
                        "Files"=>$kle,
                        "RequiredForms"=>$formtype,
                        "Forms"=>$formlar,
                        "Personel"=>$personeller,
                        "Processor"=>$fakes
                    ]);
                    break;
                }
                default:{
                    SendStatus(403);
                }
            };
        }
    };