<?php
    include("Model/Acente.php");
    include("Model/User.php");
    $main = new class extends Controller{
        public function yeniFormu()
        {
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("acente/yeni",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function yeni()
        {
            global $workspaceDir;
            if(Request::method() != "POST")
            {
                SendStatus(403);
                exit;
            };
            Request::validation("POST","name",[
                "require"=>true,
                "regex"=>"/^.{6,31}$/"
            ],"Acente ismi boş veya geçersiz");

            $acente = new Acente();
            if($acente->isUsableName(Request::post("name")))
            {
                if($id = $acente->createAcente(Request::post("name")))
                {
                    Response::soap("success","CREATED_ACENTE",[
                        "path"=>$workspaceDir."/".username()."/acente/".$id
                    ]);
                }else{
                    SendStatus(500);
                }
            }else{
                Response::soap("fail","ALREADYEXISTS");
            }
        }
    };