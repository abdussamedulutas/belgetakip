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
            global $db;
            $user = $db->prepare("SELECT * FROM user WHERE email = :email AND password = MD5(:password) AND deletedate is null LIMIT 1");
            $user->bindParam("email",$email);
            $user->bindParam("password",$password);
            $user->execute();
            $user = $user->fetch(PDO::FETCH_OBJ);
            return $user;
        }
        public function varifyAdmin($email,$password)
        {
            $settings = new Settings();
            $adminMail = $settings->getSettings("admin.email");
            $adminPass = $settings->getSettings("admin.password");
            return $adminMail == $email && $adminPass == md5($password);
        }
        public function createPersonel($name,$surname,$email,$image,$password)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO `user` SET
                `id` = UNHEX(:id),
                `name` = :name,
                `surname` = :surname,
                `email` = :email,
                `image` = :image,
                `role` = 'personel',
                `password` = MD5(:password),
                `createdate` = NOW(),
                `modifydate` = NOW();
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("name", $name);
            $pre->bindParam("surname", $surname);
            $pre->bindParam("email", $email);
            $pre->bindParam("image", $image);
            $pre->bindParam("password", $password);
            return $pre->execute();
        }
        public function createKullanici($name,$surname,$email,$image,$password)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO `user` SET
                `id` = UNHEX(:id),
                `name` = :name,
                `surname` = :surname,
                `email` = :email,
                `image` = :image,
                `role` = 'personel',
                `password` = MD5(:password),
                `createdate` = NOW(),
                `modifydate` = NOW();
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("name", $name);
            $pre->bindParam("surname", $surname);
            $pre->bindParam("email", $email);
            $pre->bindParam("image", $image);
            $pre->bindParam("password", $password);
            $pre->bindParam("acente_id", $acente_id);
            return $pre->execute();
        }
        public function isUsableMail($email)
        {
            global $db;
            $pre = $db->prepare("SELECT * FROM `user` WHERE email = :email AND deletedate is null LIMIT 1");
            $pre->bindParam("email", $email);
            $pre->execute();
            return count($pre->fetchall(PDO::FETCH_OBJ)) != 0;
        }
        public function deletePersonel($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE `user` SET
                `deletedate` = NOW()
                WHERE id = UNHEX(:id) AND deletedate is null LIMIT 1;
            ");
            $pre->bindParam("id", $id);
            if($pre->execute()){
                return true;
            }else{
                echo var_dump([$name,$surname,$email,$image]);
            }
        }
        public function updatePersonel($id,$name,$surname,$email,$image)
        {
            global $db;
            $pre = $db->prepare("UPDATE `user` SET
                `name` = :name,
                `surname` = :surname,
                `email` = :email,
                `image` = :image,
                `role` = 'personel',
                `modifydate` = NOW()
                WHERE id = UNHEX(:id) AND deletedate is null LIMIT 1;
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("name", $name);
            $pre->bindParam("surname", $surname);
            $pre->bindParam("email", $email);
            $pre->bindParam("image", $image);
            if($pre->execute()){
                return true;
            }else{
                echo var_dump([$name,$surname,$email,$image]);
            }
        }
        public function getPersonelAll()
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(user.id) as id,
                user.name as name,
                user.surname as surname,
                user.image as image,
                user.email as email
            FROM user WHERE user.deletedate is null LIMIT 1");
            $pre->bindParam("id", $id);
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getPersonel($id)
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(user.id) as id,
                user.name as name,
                user.surname as surname,
                user.image as image,
                user.email as email
            FROM user WHERE user.id = UNHEX(:id) AND user.deletedate is null LIMIT 1");
            $pre->bindParam("id", $id);
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
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
        if(!isset($_SESSION["image"]))
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
            case "personel":{
                return "Acente Personeli";
                break;
            }
        };
    };