<?php
    include("Model/User.php");
    include("Model/Form.php");
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
        };
    }

    $main = new class extends Controller{
        public function viewSettings()
        {
            useAuthGET();
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            $form = new Form();
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            Flog("WITH POST DATA:".var_export($_POST,true));
            $types = $form->getAllType();
            Response::view("form/formayarlari",(object)[
                "userPanelLink"=>$userPanelLink,
                "types"=>$types
            ]);
        }
        public function viewRequired()
        {
            useAuthGET();
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            Flog("WITH POST DATA:".var_export($_POST,true));
            Response::view("form/gerekenformlar",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function post()
        {
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            Flog("WITH POST DATA:".var_export($_POST,true));
            useAuthPOST();
            global $workspaceDir;
            switch(Request::post("action"))
            {
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
                    $types = $form->createField(Request::post("id"),Request::post("name"));
                    Response::soap("success","CREATE_FIELD");
                    break;
                }
                case "updateField":{
                    $form = new Form();
                    $types = $form->updateField(Request::post("id"),Request::post("name"));
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