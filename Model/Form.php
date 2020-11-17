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
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return $pre->execute();
        }
        public function updateType($id,$name)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_types SET name = :name, modifydate = NOW() WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("name", $name);
            $pre->bindParam("id", $id);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return $pre->execute();
        }
        public function deleteType($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_types SET deletedate = NOW() WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id", $id);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return $pre->execute();
        }
        public function getAllType()
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(id) as id,`name` FROM form_types WHERE deletedate is null");
            if($pre->execute())
            {
                Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                return [];
                Flog(__FUNCTION__."(".var_export(func_get_args(),true).") : Mysqlerror{".var_export($db->errorInfo(),true)."}");
                var_dump($db->errorInfo());
            }
        }
        public function getFields($type_id)
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(id) as id,`name` FROM form_fields WHERE deletedate is NULL AND form_type_id = UNHEX(:formtypeid)");
            $pre->bindParam("formtypeid", $type_id);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function createField($type_id,$text)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO form_fields SET id = UNHEX(:id),`name` = :text, form_type_id = UNHEX(:formtypeid), createdate = NOW(), modifydate = NOW()");
            $pre->bindParam("formtypeid", $type_id);
            $pre->bindParam("text", $text);
            $pre->bindParam("id", $id);
            if(!$pre->execute());
                Flog(__FUNCTION__."(".var_export(func_get_args(),true)."):".var_export($pre->errorInfo(),true));
            return true;
        }
        public function updateField($id,$text)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_fields SET `name` = :text WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("text", $text);
            $pre->bindParam("id", $id);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return $pre->execute();
        }
        public function deleteField($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_fields SET deletedate = NOW() WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id", $id);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return $pre->execute();
        }
    };