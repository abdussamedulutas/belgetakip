<?php
    class User extends Model
    {
        public function CheckSession()
        {
            if(isset($_SESSION["user"]))
            {
                return true;
            }else{
                return false;
            }
        }
        public function Logout()
        {
            unset($_SESSION["user"]);
        }
        public function varifyUser($email,$password)
        {
            $user = $this->query("SELECT * FROM user WHERE `email` = :email  AND `password` = :password LIMIT 1",[
                "email" => $email,
                "password" => $password
            ]);
            if(count($user) == 0)
            {
                return false;
            }else{
                return $user[0];
            }
        }
        public function varifyAdmin($email,$password)
        {
            $settings = new Settings();
            $adminMail = $settings->getSettings("admin.email");
            $adminPass = $settings->getSettings("admin.password");
            return $adminMail == $email && $adminPass == md5($password);
        }
    };
    function username()
    {
        return $_SESSION["name"];
    }
    function usernamesurname()
    {
        return $_SESSION["name"]." ".$_SESSION["surname"];
    }
    function userimage()
    {
        if(isset($_SESSION["image"]))
        {
            return "assets/images/placeholder.jpg";
        };
        return $_SESSION["image"];
    }
    function userrole()
    {
        switch($_SESSION["role"])
        {
            case "admin":{
                return "Yönetici";
                break;
            }
            case "acente":{
                return "Acente Personeli";
                break;
            }
        };
    };