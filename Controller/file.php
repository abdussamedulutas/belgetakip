<?php
    include("Model/File.php");
    include("Model/User.php");
    include("Model/Form.php");
    include("Model/Acente.php");
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
        public function viewFiles()
        {
            useAuthGET();
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            Flog("WITH POST DATA:".var_export($_POST,true));
            Response::view("dosya/files",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function post()
        {
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            Flog("WITH POST DATA:".var_export($_POST,true));
            useAuthPOST();
            global $workspaceDir;
            $form = new Form();
            $users = new User();
            $file = new File();
            $acente = new Acente();
            switch(Request::post("action"))
            {
                case "tumpersoneller":{
                    $allAcente = $acente->getAcentePersonelAll(Request::post("id"));
                    Response::soap("success","PERSONEL_ALL",$allAcente);
                    break;
                }
                case "tumacenteler":{
                    $allAcente = $acente->getAll();
                    Response::soap("success","ACENTE_ALL",$allAcente);
                    break;
                }
                case "tumformislemleri":{
                    $reqforms = $form->getRequiredForms();
                    foreach($reqforms as $tforms)
                    {
                        $tforms->required = explode(',',$tforms->required);
                    };
                    Response::soap("success","FORMREQTYPE_ALL",$reqforms);
                    break;
                }
                case "tumformlar":{
                    $allAcente = $form->getAllType();
                    Response::soap("success","FORMTYPE_ALL",$allAcente);
                    break;
                }
                case "saveFile":{
                    Response::soap("success","SAVED_FILE");
                    break;
                }
                case "changeFile":{
                    Response::soap("success","CHANGED_FILE");
                    break;
                }
                case "deleteFile":{
                    Response::soap("success","DELETED_FILE");
                    break;
                }
                default:{
                    SendStatus(403);
                }
            };
        }
    };