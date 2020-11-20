<?php
    include("Model/User.php");
    $main = new class extends Controller{
        public function postLogin()
        {
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            Flog("WITH POST DATA:".var_export($_POST,true));
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
                Response::soap("success","login",["admin"]);
            }else if($user = $User->varifyUser(Request::post("email"),Request::post("password"))){
                $_SESSION["user"] = $user->email;
                $_SESSION["name"] = $user->name;
                $_SESSION["surname"] = $user->surname;
                $_SESSION["image"] = $user->image;
                $_SESSION["role"] = $user->role;
                $_SESSION["userid"] = $user->id;
                Response::soap("success","login",["user"]);
            }else{
                sleep(3);
                Response::soap("fail","NOUSER",[
                    "text" => "E-Posta veya şifresi yanlış"
                ]);
            }
        }
        public function getView()
        {
            if(isset($_SESSION["user"])){
                $safe = safeName($_SESSION["name"]);
                Response::tempRedirect("$workspaceDir/$safe/panel");
            }else{
                Response::view("login");
            }
        }
        public function logout()
        {
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            Flog("WITH POST DATA:".var_export($_POST,true));
            (new User())->Logout();
            Response::tempRedirect("$workspaceDir/login");
        }
    };