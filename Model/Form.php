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
        public function getType($id)
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(`id`) as id,`name` FROM form_types WHERE deletedate is null AND id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id",$id);
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
                $vars = $pre->fetchall(PDO::FETCH_OBJ);
                foreach($vars as $field)
                {
                    $field->variables = [];
                    $variables = $this->getVariables($field->id);
                    foreach($variables as $variable)
                    {
                        $field->variables[] = (object) [
                            "id"=>$variable->id,
                            "name"=>$variable->name
                        ];
                    };
                };
                return $vars;
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


        
        public function createVariable($field_id,$text)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO form_variables SET id = UNHEX(:id),`name` = :text, field_id = UNHEX(:field_id), createdate = NOW(), modifydate = NOW()");
            $pre->bindParam("field_id", $field_id);
            $pre->bindParam("text", $text);
            $pre->bindParam("id", $id);
            if(!$pre->execute());
                Flog(__FUNCTION__."(".var_export(func_get_args(),true)."):".var_export($pre->errorInfo(),true));
            return true;
        }
        public function updateVariable($id,$text)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_variables SET `name` = :text WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("text", $text);
            $pre->bindParam("id", $id);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return $pre->execute();
        }
        public function deleteVariable($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_variables SET deletedate = NOW() WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id", $id);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return $pre->execute();
        }
        public function getVariables($field_id)
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(id) as id,`name` FROM form_variables WHERE deletedate is NULL AND field_id = UNHEX(:field_id)");
            $pre->bindParam("field_id", $field_id);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }


        
        public function createRequiredForm($name)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO form_require SET id = UNHEX(:id),`name` = :text,required_forms = '', createdate = NOW(), modifydate = NOW()");
            $pre->bindParam("text", $name);
            $pre->bindParam("id", $id);
            if(!$pre->execute());
                Flog(__FUNCTION__."(".var_export(func_get_args(),true)."):".var_export($pre->errorInfo(),true));
            return true;
        }
        public function updateRequiredFormName($id,$name)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_require SET `name` = :name WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("name", $name);
            $pre->bindParam("id", $id);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return $pre->execute();
        }
        public function updateRequiredFormList($id,$text)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_require SET required_forms = :text WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("text", $text);
            $pre->bindParam("id", $id);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return $pre->execute();
        }
        public function deleteRequiredForm($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_require SET deletedate = NOW() WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id", $id);
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return $pre->execute();
        }
        public function getRequiredForms()
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(id) as id,`name`,required_forms as 'required' FROM form_require WHERE deletedate is NULL");
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getRequiredForm($id)
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(id) as id,`name`,required_forms as 'required' FROM form_require WHERE deletedate is NULL AND id = UNHEX(:id) LIMIT 1");
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            $pre->bindParam("id",$id);
            if($pre->execute())
            {
                return $pre->fetch(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
    };