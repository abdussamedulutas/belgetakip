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
            $user = $db->prepare("SELECT * FROM `user` WHERE `email` = :email AND `password` = MD5(:password) LIMIT 1");
            $user->bindParam("email",$email);
            $user->bindParam("password",$password);
            $user->execute();
            $usert = $user->fetch(PDO::FETCH_OBJ);
            return $usert;
        }
        public function createUser($name,$surname,$role,$email,$image,$password,$acente = -1)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO `user` SET
                `id` = UNHEX(:id),
                `name` = :name,
                `surname` = :surname,
                `email` = :email,
                `image` = :image,
                `role` = :role,
                `password` = MD5(:password),
                `createdate` = NOW(),
                `modifydate` = NOW();
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("name", $name);
            $pre->bindParam("surname", $surname);
            $pre->bindParam("email", $email);
            $pre->bindParam("image", $image);
            $pre->bindParam("role", $role);
            $pre->bindParam("password", $password);
            $pre->execute();
            if($acente != -1) $this->updateUserAcente($id,$acente);
            return $id;
        }
        public function updateUserAcente($id,$acente)
        {
            global $db;
            $pre = $db->prepare("UPDATE `user` SET `acente_id` = UNHEX(:acente) WHERE `id` = UNHEX(:id) ");
            $pre->bindParam("id", $id);
            $pre->bindParam("acente", $acente);
            return $pre->execute();
        }
        public function getAll($role)
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(user.id) as id,
                user.name as name,
                user.surname as surname,
                user.image as image,
                user.role as role,
                user.email as email
            FROM user WHERE user.deletedate is null AND role = :role");
            $pre->bindParam("role", $role);
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function get($id)
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(user.acente_id) as acente,
                HEX(user.id) as id,
                user.name as name,
                user.surname as surname,
                user.image as image,
                user.role as role,
                user.email as email
            FROM user WHERE user.deletedate is null AND id = UNHEX(:id)");
            $pre->bindParam("id", $id);
            if($pre->execute())
            {
                return $pre->fetch(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function isUsableMail($email)
        {
            global $db;
            $pre = $db->prepare("SELECT * FROM `user` WHERE email = :email AND deletedate is null LIMIT 1");
            $pre->bindParam("email", $email);
            $pre->execute();
            return count($pre->fetchall(PDO::FETCH_OBJ)) != 0;
        }
        public function delete($id)
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
        public function update($id,$name,$surname,$role,$email,$image)
        {
            global $db;
            $pre = $db->prepare("UPDATE `user` SET
                `name` = :name,
                `surname` = :surname,
                `email` = :email,
                `image` = :image,
                `role` = :role,
                `modifydate` = NOW()
                WHERE id = UNHEX(:id) AND deletedate is null LIMIT 1;
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("name", $name);
            $pre->bindParam("surname", $surname);
            $pre->bindParam("email", $email);
            $pre->bindParam("image", $image);
            $pre->bindParam("role", $role);
            if($pre->execute()){
                return true;
            }else{
                echo var_dump([$name,$surname,$email,$image]);
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
        if(!isset($_SESSION["image"]) || empty($_SESSION["image"]))
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
    function permission($permissions)
    {
        global $workspaceDir;
        $split = explode("|",$permissions);
        
        if(isset($_SESSION["user"]))
        {
            foreach($split as $role)
                if($role == $_SESSION["role"])
                    return;
            Response::tempRedirect("$workspaceDir/login");
            exit;
        }else if(count($split) != 0){
            if(Request::method() == "POST"){
                SendStatus(403);
            }else{
                SendStatus(403);
            }
            exit;
        }
    };
    function ipermission($permissions)
    {
        global $workspaceDir;
        $split = explode("|",$permissions);
        
        if(isset($_SESSION["user"]))
        {
            foreach($split as $role)
                if($role == $_SESSION["role"])
                    return true;
            return false;
        }else if(count($split) != 0){
            return false;
        }
    };