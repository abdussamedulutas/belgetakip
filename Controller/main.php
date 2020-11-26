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
        public function review()
        {
            permission("admin");
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"]; 

            global $db;
            
            $acente = $db->query("SELECT * FROM `acente`",PDO::FETCH_OBJ);
            $file = $db->query("SELECT * FROM `file`",PDO::FETCH_OBJ);
            $forms = $db->query("SELECT * FROM `forms`",PDO::FETCH_OBJ);
            $form_fields = $db->query("SELECT * FROM `form_fields`",PDO::FETCH_OBJ);
            $form_files = $db->query("SELECT * FROM `form_files`",PDO::FETCH_OBJ);
            $form_notes = $db->query("SELECT * FROM `form_notes`",PDO::FETCH_OBJ);
            $form_require = $db->query("SELECT * FROM `form_require`",PDO::FETCH_OBJ);
            $form_types = $db->query("SELECT * FROM `form_types`",PDO::FETCH_OBJ);
            $form_variables = $db->query("SELECT * FROM `form_variables`",PDO::FETCH_OBJ);
            $notification = $db->query("SELECT * FROM `notification`",PDO::FETCH_OBJ);
            $user = $db->query("SELECT * FROM `user`",PDO::FETCH_OBJ);
            $degerler = $db->query("SELECT * FROM `values`",PDO::FETCH_OBJ);

            Response::view("review",(object)[
                "userPanelLink"=>$userPanelLink,
                "acente" => $acente,
                "file" => $file,
                "forms" => $forms,
                "form_fields" => $form_fields,
                "form_files" => $form_files,
                "form_notes" => $form_notes,
                "form_require" => $form_require,
                "form_types" => $form_types,
                "form_variables" => $form_variables,
                "notification" => $notification,
                "user" => $user,
                "degerler" => $degerler
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