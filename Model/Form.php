<?php
    class Form extends Model
    {
        public function createType($name)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO form_types SET name = :name,id = UNHEX(:id), createdate = NOW()");
            $pre->bindParam("name", $name);
            $pre->bindParam("id", $id);
            return $pre->execute();
        }
        public function updateType($id,$name)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_types SET name = :name, modifydate = NOW() WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("name", $name);
            $pre->bindParam("id", $id);
            return $pre->execute();
        }
        public function deleteType($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_types SET deletedate = NOW() WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id", $id);
            return $pre->execute();
        }
        public function getAllType()
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(id) as id,name FROM form_types WHERE deletedate is null");
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                return [];
                var_dump($db->errorInfo());
            }
        }
    };