<?php
    class Acente extends Model
    {
        public function isUsableName($name)
        {
            $user = $this->query("SELECT * FROM acente WHERE `name` = :name AND deletedate is null LIMIT 1",[
                "name" => $name
            ]);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
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
                Flog(__FUNCTION__."(".var_export(func_get_args(),true).") : $cvp");
                return $id;
            }catch(Exception $i){
                Flog(__FUNCTION__."(".var_export(func_get_args(),true).") : Error {".var_export($i,true)."}");
                exit;
            }
        }
        public function getAcente($id)
        {
            global $db;
            $pre = $db->prepare("SELECT * FROM acente WHERE id = UNHEX(:id) AND deletedate is NULL  LIMIT 1");
            $pre->bindParam("id", $id);
            if($pre->execute())
            {
                Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                Flog(__FUNCTION__."(".var_export(func_get_args(),true).") : MysqlError {".var_export($db->errorInfo(),true)."}");
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
                Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                Flog(__FUNCTION__."(".var_export(func_get_args(),true).") : MysqlError {".var_export($db->errorInfo(),true)."}");
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function deleteAcente($id)
        {
            global $db;;
            $pre = $db->prepare("UPDATE acente SET deletedate = NOW() WHERE id = UNHEX(:id) AND deletedate is NULL LIMIT 1");
            $pre->bindParam("id", $id);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
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
                Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                Flog(__FUNCTION__."(".var_export(func_get_args(),true).") : MysqlError {".var_export($db->errorInfo(),true)."}");
                return [];
            }
        }
        public function setName($id,$name)
        {
            global $db;
            $pre = $db->prepare("UPDATE acente SET `name` = :name WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id", $id);
            $pre->bindParam("name", $name);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return $pre->execute();
        }
        public function isExistsName($name)
        {
            global $db;
            $pre = $db->prepare("SELECT * FROM acente WHERE `name` = :name LIMIT 1");
            $pre->bindParam("name", $name);
            $pre->execute();
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return count($pre->fetchall(PDO::FETCH_OBJ)) != 0;
        }
    };