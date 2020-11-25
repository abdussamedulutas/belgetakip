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
        public function recoveryView()
        {
            permission("admin");
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            $config = readConfig();
            Response::view("recovery",(object)[
                "userPanelLink"=>$userPanelLink,
                "config"=>$config
            ]);
        }
        public function getRecovery()
        {
            permission("admin");
            if($g = Request::get("date"))
            {
                ImportDatabase($g);
                echo "$g tarihli veritabanı Yedeği başarıyla alındı";
                exit;
            };
            if(ExportDatabase())
            {
                echo "Veritabanı Yedeği başarıyla alındı";
            }else{
                echo "Veritabanı Yedeğı alınmadı veya zaten bu günün yedeği alınmış durumda";
            }
        }
    };