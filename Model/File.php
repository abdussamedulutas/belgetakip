<?php
    class File extends Model
    {
        public function createFile($name,$forms,$acente,$personel)
        {
            global $db;
            $id = getRandom();
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            $pre = $db->prepare("INSERT INTO `file` SET
                `id` = UNHEX(:id),
                `name` = :name,
                required_forms = :forms,
                acente_id = UNHEX(:acente),
                personel_id = UNHEX(:personel),
                createdate = NOW(),
                modifydate = NOW()
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("forms", $forms);
            $pre->bindParam("acente", $acente);
            $pre->bindParam("personel", $personel);
            $pre->bindParam("name", $name);
            if(!$pre->execute()){
                var_dump($pre->errorInfo());
            }else return true;
        }
        public function updateFile($name,$forms,$acente,$personel)
        {
            global $db;
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            $id = getRandom();
            $pre = $db->prepare("INSERT INTO `file` SET
                id = UNHEX(:id),
                `name` = :name,
                required_forms = :forms,
                acente_id = UNHEX(:acente),
                personel_id = UNHEX(:personel),
                modifydate = NOW()
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("forms", $forms);
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
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            return $pre->execute();
        }
        public function getAllFiles()
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(id) as 'id',
                `name` as 'name',
                required_forms as 'reqforms',
                HEX(acente_id) as 'acente',
                hex(personel_id) as 'personel',
                lastinsetdate FROM `file` WHERE deletedate is null");
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
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
            foreach($formsrequires1 as $fileid)
            {
                $pre = $db->prepare("SELECT HEX(id) as id,name,required_forms FROM form_require WHERE id = UNHEX(:id) AND deletedate is null");
                $pre->bindParam("id",$fileid);
                $pre->execute();
                $require = $pre->fetch(PDO::FETCH_OBJ);
                $formtypes = explode(",",$require->required_forms);
                $shown[$require->id] = [];
                foreach($formtypes as $formtype)
                {
                    $pre1 = $db->prepare("SELECT HEX(id) as id,name as count FROM form_types WHERE `id` = UNHEX(:id) AND deletedate is null LIMIT 1");
                    $pre1->bindParam("id",$formtype);
                    $pre1->execute();
                    $rec = $pre1->fetch(PDO::FETCH_OBJ);
                    $pre2 = $db->prepare("SELECT COUNT(*) as count FROM forms WHERE type_id = UNHEX(:type_id) AND `file_id` = UNHEX(:file_id) AND deletedate is null");
                    $pre2->bindParam("type_id",$formtype);
                    $pre2->bindParam("file_id",$fileid);
                    $pre2->execute();
                    $req = $pre2->fetch(PDO::FETCH_OBJ);
                    if($req->count == 0)
                    {
                        $rec->status = false;
                        $shown[$require->id][$rec->id] = $rec;
                    }else{
                        $rec->status = true;
                        $shown[$require->id][$rec->id] = $rec;
                    };
                };
            };
            return (object) $shown;
        }
    };