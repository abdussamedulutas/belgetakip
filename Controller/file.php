<?php
    include("Model/File.php");
    include("Model/User.php");
    include("Model/Form.php");
    include("Model/Acente.php");
    include("Model/Notification.php");
    function useAuthGET()
    {
        global $workspaceDir;
        if(!isset($_SESSION["user"]))
        {
            Response::tempRedirect("$workspaceDir/login");
            exit;
        }
    };
    function useAuthPOST()
    {
        global $workspaceDir;
        if(!isset($_SESSION["user"]))
        {
            SendStatus(404);
            exit;
        };
    }
    function useOnlyAdminAuthGET()
    {
        global $workspaceDir;
        if(!isset($_SESSION["user"]) || (isset($_SESSION["user"]) && $_SESSION["role"] != "admin"))
        {
            Response::tempRedirect("$workspaceDir/login");
            exit;
        }
    };
    function useOnlyAdminPOST()
    {
        global $workspaceDir;
        if(!isset($_SESSION["user"]) || (isset($_SESSION["user"]) && $_SESSION["role"] != "admin"))
        {
            SendStatus(404);
            exit;
        };
    }

    $main = new class extends Controller{
        public function viewFiles()
        {
            useAuthGET();
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("dosya/files",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function viewForms()
        {
            useAuthGET();
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("form/tumu",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function addForm()
        {
            useOnlyAdminAuthGET();
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("dosya/addform",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function post()
        {
            useAuthPOST();
            global $workspaceDir;
            $form = new Form();
            $users = new User();
            $file = new File();
            $acente = new Acente();
            switch(Request::post("action"))
            {
                case "tumpersoneller":{
                    useOnlyAdminPOST();
                    $allAcente = $acente->getAcentePersonelAll(Request::post("id"));
                    Response::soap("success","PERSONEL_ALL",$allAcente);
                    break;
                }
                case "tumacenteler":{
                    useOnlyAdminPOST();
                    $allAcente = $acente->getAll();
                    Response::soap("success","ACENTE_ALL",$allAcente);
                    break;
                }
                case "tumformislemleri":{
                    useOnlyAdminPOST();
                    $reqforms = $form->getRequiredForms();
                    foreach($reqforms as $tforms)
                    {
                        $tforms->required = explode(',',$tforms->required);
                    };
                    Response::soap("success","FORMREQTYPE_ALL",$reqforms);
                    break;
                }
                case "tumformlar":{
                    useOnlyAdminPOST();
                    $allAcente = $form->getAllType();
                    Response::soap("success","FORMTYPE_ALL",$allAcente);
                    break;
                }
                case "AddForm":{
                    useOnlyAdminPOST();
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
                    useOnlyAdminPOST();
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
                    useOnlyAdminPOST();
                    Response::soap("success","CHANGED_FILE");
                    break;
                }
                case "deleteFile":{
                    useOnlyAdminPOST();
                    Response::soap("success","DELETED_FILE");
                    break;
                }
                case "getFiles":{
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
                        $personeller[$filec->personel] = $users->getPersonel($filec->personel)[0];
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