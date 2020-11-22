<?php
    include("Model/User.php");
    $main = new class extends Controller{
        public function getView()
        {
            global $workspaceDir;
            if(isset($_SESSION["user"]))
            {
                if($_SESSION["role"] == "admin")
                {
                    $userPanelLink = $workspaceDir."/".$_SESSION["name"];
                    Response::view("main",(object)[
                        "userPanelLink"=>$userPanelLink
                    ]);
                }else{
                    $userPanelLink = $workspaceDir."/".$_SESSION["name"];
                    Response::view("personel",(object)[
                        "userPanelLink"=>$userPanelLink
                    ]);
                }
            }else Response::tempRedirect("$workspaceDir/login");
        }
        public function redirectpanel()
        {
            global $workspaceDir;
            if(isset($_SESSION["user"]))
            {
                $safe = safeName($_SESSION["name"]);
                Response::tempRedirect("$workspaceDir/$safe/dosyalar");
            }else Response::tempRedirect("$workspaceDir/login");
        }
    };