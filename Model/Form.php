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
        public function getFields()
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(id) as id,`name`,`type`,`order` FROM form_fields WHERE deletedate is NULL ORDER BY `order` ASC");
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
        public function createField($text)
        {
            global $db;
                $pre = $db->prepare("SELECT MAX(form_fields.`order`)+1 as maxid,COUNT(form_fields.`order`) as nullid FROM form_fields WHERE deletedate is null LIMIT 1");
                $pre->execute();
                $row = $pre->fetch();
                if($row["maxid"] == null){
                    $order = $row["nullid"];
                }else{
                    $order = $row["maxid"];
                };
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO form_fields SET id = UNHEX(:id),`name` = :text, `order` = :order, `type` = 'text', createdate = NOW(), modifydate = NOW()");
            $pre->bindParam("text", $text);
            $pre->bindParam("order", $order);
            $pre->bindParam("id", $id);
            if(!$pre->execute());
                return true;
        }
        public function updateField($id,$text,$order = -1)
        {
            global $db;
            if($order == -1)
            {
                $pre = $db->prepare("UPDATE form_fields SET `name` = :text,modifydate = NOW() WHERE id = UNHEX(:id) LIMIT 1");
                $pre->bindParam("text", $text);
                $pre->bindParam("id", $id);
                return $pre->execute();
            }else{
                $pre = $db->prepare("UPDATE form_fields SET `name` = :text, `order` = :order,modifydate = NOW() WHERE id = UNHEX(:id) LIMIT 1");
                $pre->bindParam("text", $text);
                $pre->bindParam("order", $order);
                $pre->bindParam("id", $id);
                return $pre->execute();
            }
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
            $pre = $db->prepare("INSERT INTO form_require SET id = UNHEX(:id),`name` = :text, createdate = NOW(), modifydate = NOW()");
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
            $pre = $db->prepare("SELECT HEX(id) as id,`name` FROM form_require WHERE deletedate is NULL");
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
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
                    `formid` = UNHEX(:formid),
                    `id` = UNHEX(:id)
            ");
            $pre->bindParam("field",$field);
            $pre->bindParam("text",$text);
            $pre->bindParam("formid",$formid);
            $pre->bindParam("id",$id);
            if($pre->execute())
            {
                return $id;
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function updateValue($field,$formid,$text)
        {
            global $db;
            $pre = $db->prepare("UPDATE `values`
                SET `text` = :text
                WHERE `field` = UNHEX(:field) AND `formid` = UNHEX(:formid)
            ");
            $pre->bindParam("field",$field);
            $pre->bindParam("formid",$formid);
            $pre->bindParam("text",$text);
            if($pre->execute())
            {
                return;
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
            $pre->bindParam("id",$id);
            if($pre->execute())
            {
                return true;
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getValue($field)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("SELECT `text` FROM  `values` WHERE field = UNHEX(:field) LIMIT 1");
            $pre->bindParam("field",$field);
            if($pre->execute())
            {
                return $pre->fetch(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function saveForm($file_id,$user,$values)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO forms
                SET `file_id` = UNHEX(:file_id),
                    `user` = UNHEX(:user),
                    `createdate`  = NOW(),
                    `modifydate` = NOW(),
                    `id` = UNHEX(:id)
            ");
            $pre->bindParam("file_id",$file_id);
            $pre->bindParam("user",$user);
            $pre->bindParam("id",$id);
            if($pre->execute())
            {
                foreach($values as $fieldid => $value)
                    $this->saveValue($fieldid,$id,$value);
                return $id;
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getFileForm($file_id)
        {
            global $db;
            $pre = $db->prepare("SELECT HEX(id) as id FROM `forms` WHERE `file_id` = UNHEX(:fileid) LIMIT 1");
            $pre->bindParam("fileid",$file_id);
            if($pre->execute())
            {
                $id = $pre->fetch()["id"];
                return $this->getForm($id);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function removeForm($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE `forms` SET deletedate = NOW() WHERE `id` = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id",$id);
            if($pre->execute())
            {
                return true;
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getForm($id)
        {
            global $db;
            $pre = $db->prepare("SELECT user,`file_id` FROM forms WHERE `id` = UNHEX(:id) AND deletedate is null LIMIT 1");
            $pre->bindParam("id",$id);
            $pre->execute();
            $form = $pre->fetch(PDO::FETCH_OBJ);
            if($form == false){
                return [
                    "FormData" => [],
                    "FormSettings" => []
                ];
            };
            $pre = $db->prepare("SELECT
                HEX(`values`.id) as valueid,
                HEX(`form_fields`.id) as field,
                HEX(`values`.formid) as formid,
                `name`,
                `type`,
                `values`.text
            FROM form_fields
            INNER JOIN `values` ON `values`.field = form_fields.id AND `values`.formid = UNHEX(:formid)
            WHERE  deletedate is null");
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
                    $field->textid = $variableId->text;
                };
            };
            return [
                "FormData" => $kle,
                "Form" => $form
            ];
        }
        public function get($id)
        {
            global $db;
            $pre = $db->prepare("SELECT user,`file_id` FROM forms WHERE `id` = UNHEX(:id) AND deletedate is null LIMIT 1");
            $pre->bindParam("id",$id);
            $pre->execute();
            return $pre->fetch(PDO::FETCH_OBJ);
        }
    };