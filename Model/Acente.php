<?php
    class Acente extends Model
    {
        public function isUsableName($name)
        {
            $user = $this->query("SELECT * FROM acente WHERE `name` = :name AND deletedate is null LIMIT 1",[
                "name" => $name
            ]);
            if(count($user) == 0)
            {
                return true;
            }else{
                return false;
            }
        }
        public function createAcente($name)
        {
            global $db;
            try{
                $pre = $db->prepare("INSERT INTO acente (`id`,`name`,`createdate`,`modifydate`) VALUES (UNHEX(:id),:name,NOW(),NOW())");
                $id = bin2hex(random_bytes(16));
                $pre->bindParam("id", $id);
                $pre->bindParam("name",$name);
                $cvp = $pre->execute();
                return $id;
            }catch(Exception $i){
                exit;
            }
        }
        public function getAcente($id)
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(id) as id,name,image FROM acente WHERE id = UNHEX(:id) AND deletedate is NULL  LIMIT 1");
            $pre->bindParam("id", $id);
            if($pre->execute())
            {
                return $pre->fetch(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getAcentePersonelAll($acente)
        {
            global $db;
            $pre = $db->prepare("SELECT
                    HEX(`user`.id) as id,
                    `user`.name as name,
                    `user`.surname as surname,
                    `user`.email as email,
                    HEX(`user`.acente_id) as acente_id,
                    `user`.image as image,
                    acente.name as acente_name
                FROM `user`
                INNER JOIN acente ON `user`.acente_id = acente.id
                WHERE `user`.acente_id = UNHEX(:id) AND `user`.role = 'personel' AND acente.deletedate is NULL AND `user`.deletedate is NULL
            ");
            $pre->bindParam("id", $acente);
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function deleteAcente($id)
        {
            global $db;;
            $pre = $db->prepare("UPDATE acente SET deletedate = NOW() WHERE id = UNHEX(:id) AND deletedate is NULL LIMIT 1");
            $pre->bindParam("id", $id);
            return $pre->execute();
        }
        public function getAll()
        {
            global $db;
            $pre = $db->prepare("SELECT
                    HEX(acente.id) as id,
                    acente.name as name
                FROM `acente`
                WHERE acente.deletedate is NULL
            ");
            $pre->bindParam("id", $id);
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                return [];
            }
        }
        public function setName($id,$name)
        {
            global $db;
            $pre = $db->prepare("UPDATE acente SET `name` = :name WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id", $id);
            $pre->bindParam("name", $name);
            return $pre->execute();
        }
        public function isExistsName($name)
        {
            global $db;
            $pre = $db->prepare("SELECT * FROM acente WHERE `name` = :name LIMIT 1");
            $pre->bindParam("name", $name);
            $pre->execute();
            return count($pre->fetchall(PDO::FETCH_OBJ)) != 0;
        }
    };