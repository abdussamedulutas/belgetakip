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
            $pre = $db->prepare("SELECT HEX(id) as id,`name` FROM form_types WHERE deletedate is null");
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                return [];
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
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                return [];
                var_dump($db->errorInfo());
            }
        }
        public function getFields($type_id)
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(id) as id,`name`,`type` FROM form_fields WHERE deletedate is NULL AND form_type_id = UNHEX(:formtypeid)");
            $pre->bindParam("formtypeid", $type_id);
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
                return true;
        }
        public function updateField($id,$text,$order = -1)
        {
            global $db;
            if($order == -1)
            {
                $pre = $db->prepare("SELECT MAX(other.`order`)+1 as maxid,COUNT(other.`order`) as nullid FROM form_fields
                INNER JOIN form_fields as other on other.form_type_id = form_fields.form_type_id
                WHERE form_fields.id = UNHEX(:id) LIMIT 1");
                $pre->bindParam("id", $id);
                $pre->execute();
                $row = $pre->fetch();
                if($row["maxid"] == null){
                    $oder = $row["nullid"];
                }else{
                    $oder = $row["maxid"];
                }
                $order = $maxid;
            };
            exit;
            $pre = $db->prepare("UPDATE form_fields SET `name` = :text WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("text", $text);
            $pre->bindParam("type", "text");
            $pre->bindParam("id", $id);
            return $pre->execute();
        }
        public function changeFieldType($id,$type)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_fields SET `type` = :type WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("type", $type);
            $pre->bindParam("id", $id);
            return $pre->execute();
        }
        public function deleteField($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_fields SET deletedate = NOW() WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id", $id);
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
                return true;
        }
        public function updateVariable($id,$text)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_variables SET `name` = :text WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("text", $text);
            $pre->bindParam("id", $id);
            return $pre->execute();
        }
        public function deleteVariable($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_variables SET deletedate = NOW() WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id", $id);
            return $pre->execute();
        }
        public function getVariables($field_id)
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(id) as id,`name` FROM form_variables WHERE deletedate is NULL AND field_id = UNHEX(:field_id)");
            $pre->bindParam("field_id", $field_id);
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getVariable($id)
        {
            global $db;
            $pre = $db->prepare("SELECT `name` FROM form_variables WHERE deletedate is NULL AND id = UNHEX(:id)");
            $pre->bindParam("id", $id);
            if($pre->execute())
            {
                return $pre->fetch(PDO::FETCH_OBJ);
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
                return true;
        }
        public function updateRequiredFormName($id,$name)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_require SET `name` = :name WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("name", $name);
            $pre->bindParam("id", $id);
            return $pre->execute();
        }
        public function updateRequiredFormList($id,$text)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_require SET required_forms = :text WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("text", $text);
            $pre->bindParam("id", $id);
            return $pre->execute();
        }
        public function deleteRequiredForm($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE form_require SET deletedate = NOW() WHERE id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id", $id);
            return $pre->execute();
        }
        public function getRequiredForms()
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(id) as id,`name`,required_forms as 'required' FROM form_require WHERE deletedate is NULL");
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
            $pre->bindParam("id",$id);
            if($pre->execute())
            {
                return $pre->fetch(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function saveValue($field,$formid,$text)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO `values`
                SET `field` = UNHEX(:field),
                    `text` = :text,
                    `id` = :id,
                    formid = UNHEX(:formid)
            ");
            $pre->bindParam("formid",$formid);
            $pre->bindParam("field",$field);
            $pre->bindParam("text",$text);
            $pre->bindParam("id",$id);
            if($pre->execute())
            {
                return $id;
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function updateValue($id,$text)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("UPDATE `values`
                SET `text` = :text
                WHERE `id` = :id LIMIT 1
            ");
            $pre->bindParam("text",$text);
            $pre->bindParam("id",$id);
            if($pre->execute())
            {
                return $id;
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function deleteValue($id)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("DELETE FROM `values` WHERE `id` = :id LIMIT 1");
            $pre->bindParam("text",$text);
            $pre->bindParam("id",$id);
            if($pre->execute())
            {
                return true;
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getValue($field,$form)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("SELECT `text` FROM  `values` WHERE field = UNHEX(:field) AND formid = UNHEX(:formid) LIMIT 1");
            $pre->bindParam("field",$field);
            $pre->bindParam("formid",$form);
            if($pre->execute())
            {
                return $pre->fetch(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function saveForm($file_id,$required_id,$type_id,$user,$value)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO forms
                SET `type_id` = UNHEX(:type_id),
                    `require_id` = UNHEX(:required_id),
                    `file_id` = UNHEX(:file_id),
                    `user` = UNHEX(:user),
                    `createdate`  = NOW(),
                    `modifydate` = NOW(),
                    `id` = UNHEX(:id)
            ");
            $pre->bindParam("file_id",$file_id);
            $pre->bindParam("type_id",$type_id);
            $pre->bindParam("required_id",$required_id);
            $pre->bindParam("user",$user);
            $pre->bindParam("id",$id);
            if($pre->execute())
            {
                foreach($value as $fieldid => $value)
                    $this->saveValue($fieldid,$id,$value);
                return $id;
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getForm($id)
        {
            global $db;
            $pre = $db->prepare("SELECT type_id,user,require_id FROM forms WHERE `id` = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id",$id);
            $pre->execute();
            $form = $pre->fetch(PDO::FETCH_OBJ);
            if($form == false){
                return [
                    "FormData" => [],
                    "FormSettings" => []
                ];
            };
            $pre = $db->prepare("SELECT `name` FROM form_types WHERE `id` = :id LIMIT 1");
            $pre->bindParam("id",$form->type_id);
            $pre->execute();
            $typeform = $pre->fetch(PDO::FETCH_OBJ);


            $pre = $db->prepare("SELECT
                HEX(`values`.id) as valueid,
                HEX(`form_fields`.id) as field,
                `name`,
                `type`,
                `values`.text
            FROM form_fields
            INNER JOIN `values` ON `values`.field = form_fields.id AND `values`.formid = UNHEX(:formid)
            WHERE `form_type_id` = :form_type_id");
            $pre->bindParam("form_type_id",$form->type_id);
            $pre->bindParam("formid",$id);
            $pre->execute();
            $kle = $pre->fetchall(PDO::FETCH_OBJ);


            foreach($kle as $field)
            {
                if($field->type == "select")
                {
                    
                    $variableId = $this->getValue($field->field,$id);
                    $value = $this->getVariable($variableId->text);
                    $field->text = $value->name;
                };
            };
            return [
                "FormData" => $kle,
                "FormSettings" => $typeform
            ];
        }
    };