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
            };
        }
    };