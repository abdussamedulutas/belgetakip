<?php
    include("Model/User.php");
    $main = new class extends Controller{
        public function postLogin()
        {
            global $workspaceDir;
            Request::validation("POST","email",[
                "require"=>true,
                "regex"=>"/^.+@.+\..+$/"
            ],"Kullanıcı ismi boş veya geçersiz");
            Request::validation("POST","password",[
                "require"=>true,
                "regex"=>"/^.{6,31}$/"
            ],"Kullanıcı şifresi boş veya geçersiz");

            $User = new User();
            if($v = $User->varifyAdmin(Request::post("email"),Request::post("password")))
            {
                $_SESSION["user"] = Request::post("email");
                $_SESSION["role"] = "admin";
                $_SESSION["name"] = "admin";
                $safe = safeName($_SESSION["name"]);
                Response::soap("success","login",[
                    "newURL"=>"$workspaceDir/$safe/panel"
                ]);
            }else if($user = $User->varifyUser(Request::post("email"),Request::post("password"))){
                $_SESSION["user"] = $user->email;
                $_SESSION["name"] = $user->name;
                $_SESSION["surname"] = $user->surname;
                $_SESSION["image"] = $user->image;
                $_SESSION["role"] = $user->role;
                $_SESSION["userid"] = $user->id;
                $safe = safeName($_SESSION["name"]);
                Response::soap("success","login",[
                    "newURL"=>"$workspaceDir/$safe/panel"
                ]);
            }else{
                sleep(3);
                Response::soap("fail","NOUSER",[
                    "text" => "E-Posta veya şifresi yanlış"
                ]);
            }
        }
        public function getView()
        {
            global $workspaceDir;
            if(isset($_SESSION["user"])){
                $safe = safeName($_SESSION["name"]);
                Response::tempRedirect("$workspaceDir/$safe/panel");
            }else{
                Response::view("login");
            }
        }
        public function logout()
        {
            global $workspaceDir;
            (new User())->Logout();
            Response::tempRedirect("$workspaceDir/login");
        }
    };