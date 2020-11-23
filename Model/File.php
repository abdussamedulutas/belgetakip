<?php
    class File extends Model
    {
        public function lastNumber()
        {
            global $db;
            $pre = $db->prepare("SELECT MAX(`order`)+1 as num FROM `file` WHERE deletedate is null");
            $pre->execute();
            $if = $pre->fetch();
            if(isset($if["num"]))
            {   
                return $if["num"];
            }else{
                return 1;
            }
        }
        public function createFile($name,$acente,$personel)
        {
            global $db;
            $id = getRandom();
            $num = $this->lastNumber();
            $pre = $db->prepare("INSERT INTO `file` SET
                `id` = UNHEX(:id),
                `name` = :name,
                acente_id = UNHEX(:acente),
                personel_id = UNHEX(:personel),
                createdate = NOW(),
                modifydate = NOW(),
                `order` = :num
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("acente", $acente);
            $pre->bindParam("personel", $personel);
            $pre->bindParam("name", $name);
            $pre->bindParam("num", $num);
            if(!$pre->execute()){
                var_dump($pre->errorInfo());
            }else return $id;
        }
        public function getFileId($id)
        {
            global $db;
            $num = $this->lastNumber();
            $pre = $db->prepare("SELECT * FROM `file` WHERE deletedate is null AND id = UNHEX(:id)");
            $pre->bindParam("id", $id);
            $pre->execute();
            return $pre->fetch(PDO::FETCH_OBJ);
        }
        public function getFileNum($id)
        {
            global $db;
            $num = $this->lastNumber();
            $pre = $db->prepare("SELECT * FROM `file` WHERE deletedate is null AND `order` =:num");
            $pre->bindParam("num", $id);
            $pre->execute();
            return $pre->fetch(PDO::FETCH_OBJ);
        }
        public function updateFile($name,$forms,$acente,$personel)
        {
            global $db;
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO `file` SET
                id = UNHEX(:id),
                `name` = :name,
                acente_id = UNHEX(:acente),
                personel_id = UNHEX(:personel),
                modifydate = NOW()
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("acente", $acente);
            $pre->bindParam("personel", $personel);
            $pre->bindParam("name", $name);
            return $pre->execute();
        }
        public function deleteFile($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE `file` SET
                deletedate = NOW()
                WHERE id = UNHEX(:id) LIMIT 1;
            ");
            $pre->bindParam("id", $id);
            return $pre->execute();
        }
        public function getAllFiles()
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(id) as 'id',
                `name` as 'name',
                `order` as 'order',
                HEX(acente_id) as 'acente',
                hex(personel_id) as 'personel',
                lastinsetdate FROM `file` WHERE deletedate is null");
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getAllFilesForUser($id)
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(id) as 'id',
                `name` as 'name',
                `order` as 'order',
                HEX(acente_id) as 'acente',
                hex(personel_id) as 'personel',
                lastinsetdate FROM `file` WHERE deletedate is null AND personel_id = :user");
            $pre->bindParam("user",$id);
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getStatus($id)
        {
            //dosya alınıyor
            global $db;
            $pre = $db->prepare("SELECT * FROM file WHERE file.id = UNHEX(:id) AND deletedate is null");
            $pre->bindParam("id",$id);
            $pre->execute();
            $file = $pre->fetch(PDO::FETCH_OBJ);
            $formsrequires1 = explode(",",$file->required_forms);
            $shown = [];
            foreach($formsrequires1 as $required_id)
            {
                $pre = $db->prepare("SELECT HEX(id) as id,name,required_forms FROM form_require WHERE id = UNHEX(:id) AND deletedate is null");
                $pre->bindParam("id",$required_id);
                $pre->execute();
                $require = $pre->fetch(PDO::FETCH_OBJ);
                $formtypes = explode(",",$require->required_forms);
                $shown[$require->id] = [];
                foreach($formtypes as $formtype_id)
                {
                    $pre1 = $db->prepare("SELECT HEX(id) as id,name as count FROM form_types WHERE `id` = UNHEX(:id) AND deletedate is null LIMIT 1");
                    $pre1->bindParam("id",$formtype_id);
                    $pre1->execute();
                    $rec = $pre1->fetch(PDO::FETCH_OBJ);
                    $pre2 = $db->prepare("SELECT HEX(id) as id FROM forms WHERE type_id = UNHEX(:type_id) AND `file_id` = UNHEX(:file_id) and `require_id` = UNHEX(:require_id) AND deletedate is null");
                    $pre2->bindParam("type_id",$formtype_id);
                    $pre2->bindParam("file_id",$id);
                    $pre2->bindParam("require_id",$required_id);
                    $pre2->execute();
                    $req = $pre2->fetch(PDO::FETCH_OBJ);
                    if($req != false)
                    {
                        $rec->status = true;
                        $rec->formid = $req->id;
                        $shown[$require->id][$rec->id] = $rec;
                    }else{
                        $rec->status = false;
                        $shown[$require->id][$rec->id] = $rec;
                    };
                };
            };
            return (object) $shown;
        }
    };