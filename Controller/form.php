<?php
    include("Model/User.php");
    include("Model/Form.php");
    include("Model/Notes.php");
    include("Model/File.php");
    include("Model/Acente.php");

    $main = new class extends Controller{
        public function viewSettings()
        {
            permission("admin");
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            $form = new Form();
            $types = $form->getAllType();
            Response::view("form/formayarlari",(object)[
                "userPanelLink"=>$userPanelLink,
                "types"=>$types
            ]);
        }
        public function viewRequired()
        {
            permission("admin");
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("form/gerekenformlar",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function viewForm()
        {
            permission("admin|personel|kullanici");
            global $workspaceDir;
            $id = getUrlTokens()[2];

            $form = new Form();
            $data = $form->getForm($id);
            $note = new Notes();
            $note = $note->get($id);

            if(count($data["FormData"]) == 0){
                SendStatus(404);
                exit;
            }
            $user = new User();
            $personel = $user->get(bin2hex($data["Form"]->user));

            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("form/goster",(object)[
                "userPanelLink"=>$userPanelLink,
                "formid" =>$id,
                "form" =>$data,
                "note" => $note,
                "personel" => $personel
            ]);
        }
        public function editForm()
        {
            global $workspaceDir;
            $id = getUrlTokens()[2];

            $form = new Form();
            $data = $form->getForm($id);

            if(count($data["FormData"]) == 0){
                SendStatus(404);
                exit;
            }

            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("dosya/editform",(object)[
                "userPanelLink"=>$userPanelLink,
                "id" =>bin2hex($data["Form"]->type_id),
                "formid" =>$id,
                "values" => $data["FormData"]
            ]);
        }
        public function post()
        {
            global $workspaceDir;
            switch(Request::post("action"))
            {
                case "getFilesI":{
                    $file = new File();
                    $acente = new Acente();
                    $user = new User();
                    permission("admin|personel|kullanici");
                    if($_SESSION["role"] == "admin"){
                        $kle = $file->getAllI();
                    }else{
                        $kle = $file->getAllIForUser($_SESSION["userid"]);
                    };
                    foreach($kle as $file)
                    {
                        $file->acente = $acente->getAcente($file->acente);
                        $file->personel = $user->get($file->personel);
                    };
                    Response::soap("success","FILES_ALL",$kle);
                    break;
                }
                case "getFiles":{
                    permission("admin|personel|kullanici");
                    if($_SESSION["role"] == "admin"){
                        $kle = $file->getAllForUser();
                    }else{
                        $kle = $file->getAllForUser($_SESSION["userid"]);
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
                case "updateReqFile":{
                    permission("admin");
                    $form = new Form();
                    $form->updateRequiredFormName(Request::post("id"),Request::post("name"));
                    Response::soap("success","OK");
                    break;
                }
                case "deleteReqFile":{
                    permission("admin");
                    $form = new Form();
                    $form->deleteRequiredForm(Request::post("id"));
                    Response::soap("success","OK");
                    break;
                }
                case "createReqFile":{
                    permission("admin");
                    $form = new Form();
                    $form->createRequiredForm(Request::post("name"));
                    Response::soap("success","OK");
                    break;
                }
                case "getReqFilesList":{
                    permission("admin");
                    $form = new Form();
                    $allAcente = $form->getRequiredForms();
                    Response::soap("success","ACENTE_ALL",$allAcente);
                    break;
                }
                case "addNote":{
                    $note = new Notes();
                    $note->add(
                        Request::post("formid"),
                        Request::post("text")
                    );
                    Response::soap("success","ADD_NOTE");
                    break;
                }
                case "removeNote":{
                    $note = new Notes();
                    $note->delete(
                        Request::post("id")
                    );
                    Response::soap("success","DEL_NOTE");
                    break;
                }
                case "editNote":{
                    $note = new Notes();
                    $note->edit(
                        Request::post("id"),
                        Request::post("text")
                    );
                    Response::soap("success","DEL_NOTE");
                    break;
                }
                case "deleteForm":{
                    permission("admin");
                    $form = new Form();
                    $fields = $form->removeForm(Request::post("id"));
                    Response::soap("success","FORM_REMOVE",$fields);
                    break;
                }
                case "EditForm":{
                    permission("admin");
                    $form = new Form();
                    $fields = $form->getFields(Request::post("typeid"));
                    $id = Request::post("id");
                    $values = [];
                    foreach($fields as $field)
                    {
                        $value = Request::post($field->id);
                        $form->updateValue($field->id,$id,$value);
                    };
                    Response::soap("success","EDIT_FORM");
                    break;
                }
                case "getFields":{
                    $form = new Form();
                    $fields = $form->getFields(Request::post("id"));
                    Response::soap("success","FORMTYPE_ALL",$fields);
                    break;
                }
                case "changeFieldType":{
                    $form = new Form();
                    if($form->changeFieldType(Request::post("id"),Request::post("name")))
                        Response::soap("success","CHANGE_TYPE");
                    else
                        Response::soap("fail","CHANGE_TYPE");
                    break;
                }
                case "createFormType":{
                    $form = new Form();
                    if($form->createType(Request::post("name")))
                        Response::soap("success","CREATE_FORM");
                    else
                        Response::soap("fail","CREATE_FORM");
                    break;
                }
                case "updateFormType":{
                    $form = new Form();
                    if($form->updateType(Request::post("id"),Request::post("name")))
                        Response::soap("success","CREATE_FORM");
                    else
                        Response::soap("fail","CREATE_FORM");
                    break;
                }
                case "deleteFormType":{
                    $form = new Form();
                    if($form->deleteType(Request::post("id")))
                        Response::soap("success","CREATE_FORM");
                    else
                        Response::soap("fail","CREATE_FORM");
                    break;
                }
                case "formpanel":{
                    $form = new Form();
                    $types = $form->getFields(Request::post("id"));
                    Response::soap("success","GET_FORMPANEL",$types);
                    break;
                }
                case "createfield":{
                    $form = new Form();
                    $types = $form->createField(Request::post("name"));
                    Response::soap("success","CREATE_FIELD");
                    break;
                }
                case "updateField":{
                    $form = new Form();
                    $types = $form->updateField(Request::post("id"),Request::post("name"));
                    Response::soap("success","UPDATE_FIELD");
                    break;
                }
                case "updateFieldOrder":{
                    $form = new Form();
                    $types = $form->updateField(Request::post("id"),Request::post("name"),Request::post("order"));
                    Response::soap("success","UPDATE_FIELD");
                    break;
                }
                case "deleteField":{
                    $form = new Form();
                    $types = $form->deleteField(Request::post("id"));
                    Response::soap("success","DELETE_VARIABLE");
                    break;
                }
                
                case "createvariable":{
                    $form = new Form();
                    $types = $form->createVariable(Request::post("id"),Request::post("name"));
                    Response::soap("success","CREATE_VARIABLE");
                    break;
                }
                case "updatevariable":{
                    $form = new Form();
                    $types = $form->updateVariable(Request::post("id"),Request::post("name"));
                    Response::soap("success","UPDATE_VARIABLE");
                    break;
                }
                case "deletevariable":{
                    $form = new Form();
                    $types = $form->deleteVariable(Request::post("id"));
                    Response::soap("success","DELETE_VARIABLE");
                    break;
                }
                case "requiredformpanel":{
                    $form = new Form();
                    $forms = $form->getAllType();
                    $reqforms = $form->getRequiredForms();
                    foreach($reqforms as $tforms)
                    {
                        $tforms->required = explode(',',$tforms->required);
                    };
                    Response::soap("success","GET_REQUIREDFORMPANEL",(object)[
                        "requiredForms"=>$reqforms,
                        "allForms"=>$forms,
                        "values"=>[]
                    ]);
                    break;
                }
                case "createreqform":{
                    $form = new Form();
                    $types = $form->createRequiredForm(Request::post("name"));
                    Response::soap("success","CREATE_REQUIREDFORM");
                    break;
                }
                case "updatereqformname":{
                    $form = new Form();
                    $types = $form->updateRequiredFormName(Request::post("id"),Request::post("name"));
                    Response::soap("success","UPDATE_REQUIREDFORM");
                    break;
                }
                case "updatereqformlist":{
                    $form = new Form();
                    $types = $form->updateRequiredFormList(Request::post("id"),Request::post("list"));
                    Response::soap("success","UPDATE_REQUIREDFORM");
                    break;
                }
                case "deletereqform":{
                    $form = new Form();
                    $types = $form->deleteRequiredForm(Request::post("id"));
                    Response::soap("success","DELETE_REQUIREDFORM");
                    break;
                }
                default:{
                    SendStatus(403);
                }
            };
        }
    };