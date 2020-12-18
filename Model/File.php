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
        public function createEvrak($requireid,$userid,$fileid,$path)
        {
            global $db;
            $id = getRandom();
            $userid = bin2hex($userid);
            $pre = $db->prepare("INSERT INTO `form_files` SET
                `id` = UNHEX(:id),
                `requireid` = UNHEX(:requireid),
                fileid = UNHEX(:fileid),
                user = UNHEX(:userid),
                filepath = :filepath,
                createdate = NOW(),
                modifydate = NOW()
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("requireid", $requireid);
            $pre->bindParam("userid", $userid);
            $pre->bindParam("fileid", $fileid);
            $pre->bindParam("filepath", $path);
            if(!$pre->execute()){
                var_dump($pre->errorInfo());
            }else{
                $this->lastInsetFile($fileid);
                return $id;
            }
        }
        public function updateEvrak($id,$filepath)
        {
            global $db;
            $pre = $db->prepare("INSERT INTO `form_files` SET
                filepath = :filepath,
                modifydate = NOW()
                WHERE `id` = UNHEX(:id)
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("filepath", $filepath);
            if(!$pre->execute()){
                var_dump($pre->errorInfo());
            }else return $id;
        }
        public function deleteEvrak($id)
        {
            global $db;
            $pre = $db->prepare("INSERT INTO `form_files` SET
                deletedate = NOW()
                WHERE `id` = UNHEX(:id)
            ");
            $pre->bindParam("id", $id);
            if(!$pre->execute()){
                var_dump($pre->errorInfo());
            }else return $id;
        }
        public function getEvrak($id)
        {
            global $db;
            $pre = $db->prepare("SELECT * FROM `form_files` WHERE deletedate is null AND id = UNHEX(:id) LIMIT 1");
            $pre->bindParam("id", $id);
            $pre->execute();
            return $pre->fetch(PDO::FETCH_OBJ);
        }
        public function getEvrakFile($fileid)
        {
            global $db;
            $pre = $db->prepare("SELECT * FROM `form_files` WHERE deletedate is null AND fileid = UNHEX(:id) LIMIT 1");
            $pre->bindParam("fileid", $fileid);
            $pre->execute();
            return $pre->fetch(PDO::FETCH_OBJ);
        }
        public function getFileStatus($fileid)
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(file.id) as id,
                file.`name`,
                HEX(file.acente_id) as acente_id,
                HEX(file.personel_id) as personel_id,
                HEX(file.avukat_id) as avukat_id,
                file.`order`,
                `acente`.name as acentename,
                user.`name` as personelname,
                user.`surname` as personelsurname,
                avukat.`name` as avukatname,
                avukat.`surname` as avukatsurname,
                `file`.createdate as createdate
                FROM `file`
                INNER JOIN user ON user.id = file.personel_id
                LEFT JOIN user AS avukat ON avukat.id = file.avukat_id
                INNER JOIN acente ON acente.id = file.acente_id
                WHERE file.deletedate is null AND file.id = UNHEX(:id)
            ");
            $pre->bindParam("id", $fileid);
            $pre->execute();
            $file = $pre->fetch(PDO::FETCH_OBJ);
            $pre = $db->prepare("SELECT HEX(id) as id,HEX(user) as user,HEX(requireid) as requireid,HEX(fileid) as fileid,filepath FROM `form_files` WHERE deletedate is null AND fileid = UNHEX(:fileid)");
            $pre->bindParam("fileid", $fileid);
            $pre->execute();
            $form_file = $pre->fetchall(PDO::FETCH_OBJ);
            $pre = $db->prepare("SELECT HEX(id) as id,`name` FROM `form_require` WHERE deletedate is null");
            $pre->execute();
            $form_required = $pre->fetchall(PDO::FETCH_OBJ);
            $eksik = 0;
            $tam = 0;
            foreach($form_required as $require)
            {
                $flag = false;
                foreach($form_file as $filec)
                {
                    if($filec->requireid == $require->id)
                    {
                        $flag = true;
                        $require->status = true;
                        $require->filepath = $filec->filepath;
                        break;
                    }
                };
                
                if(!$flag){
                    $require->status = false;
                    $eksik++;
                }else{
                    $tam++;
                }
            };

            return (object) [
                "File"=>$file,
                "RequiredFormFile"=>$form_required,
                "Eksik" => $eksik,
                "Tam" => $tam
            ];
        }
        public function createFile($name,$acente,$personel,$avukat)
        {
            global $db;
            $id = getRandom();
            $num = $this->lastNumber();
            $pre = $db->prepare("INSERT INTO `file` SET
                `id` = UNHEX(:id),
                `name` = :name,
                acente_id = UNHEX(:acente),
                personel_id = UNHEX(:personel),
                avukat_id = UNHEX(:avukat),
                lastinsetdate = NOW(),
                createdate = NOW(),
                modifydate = NOW(),
                `order` = :num
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("acente", $acente);
            $pre->bindParam("personel", $personel);
            $pre->bindParam("avukat", $avukat);
            $pre->bindParam("name", $name);
            $pre->bindParam("num", $num);
            if(!$pre->execute()){
                var_dump($pre->errorInfo());
            }else return $id;
        }
        public function lastInsetFile($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE `file` SET `lastinsetdate` = NOW() WHERE `id` =  UNHEX(:id) LIMIT 1");
            $pre->bindParam("id",$id);
            return $pre->execute();
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
        public function updateFile($id,$name,$acente,$personel,$avukat)
        {
            global $db;
            $pre = $db->prepare("UPDATE `file` SET
                `name` = :name,
                acente_id = UNHEX(:acente),
                personel_id = UNHEX(:personel),
                avukat_id = UNHEX(:avukat),
                modifydate = NOW()
                WHERE id = UNHEX(:id)
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("acente", $acente);
            $pre->bindParam("personel", $personel);
            $pre->bindParam("avukat", $avukat);
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
        public function getAllFiles($start = 0, $count = 10000)
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(id) as 'id',
                `name` as 'name',
                `order` as 'order',
                `lastinsetdate`,
                HEX(acente_id) as 'acente',
                hex(personel_id) as 'personel',
                hex(avukat_id) as 'avukat',
                createdate,
                modifydate,
                lastinsetdate
                FROM `file` WHERE deletedate is null
                ORDER BY file.createdate DESC LIMIT $start, $count
            ");
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getAllFilesForUser($id,$start = 0, $count = 10000)
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(id) as 'id',
                `name` as 'name',
                `order` as 'order',
                `lastinsetdate`,
                HEX(acente_id) as 'acente',
                hex(personel_id) as 'personel',
                hex(avukat_id) as 'avukat',
                createdate,
                modifydate,
                lastinsetdate,
                deletedate
                FROM `file` WHERE file.deletedate is null AND (personel_id = :user OR avukat_id = :user)
                ORDER BY file.createdate DESC LIMIT $start, $count
            ");
            $pre->bindParam("user",$id);
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getAllFilesForAcente($id,$start = 0, $count = 10000)
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(id) as 'id',
                `name` as 'name',
                `order` as 'order',
                `lastinsetdate`,
                HEX(acente_id) as 'acente',
                hex(personel_id) as 'personel',
                hex(avukat_id) as 'avukat',
                createdate,
                modifydate,
                lastinsetdate
                FROM `file` WHERE deletedate is null AND acente_id = :acente
                ORDER BY file.createdate DESC LIMIT $start, $count
            ");
            $pre->bindParam("acente",$id);
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getAllI()
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(file.id) as 'id',
                `name` as 'name',
                `order` as 'order',
                HEX(acente_id) as 'acente',
                hex(form_notes.user) as 'personel',
                form_notes.createdate AS createdate,
                HEX(form_notes.id) as note_id,
                hex(avukat_id) as 'avukat',
                `text`
                FROM `file`
                INNER JOIN form_notes ON form_notes.file_id = file.id
                WHERE file.deletedate is null AND form_notes.deletedate is null ORDER BY form_notes.createdate DESC, file.createdate DESC
            ");
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getAllIForUser($id)
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(file.id) as 'id',
                `name` as 'name',
                `order` as 'order',
                HEX(acente_id) as 'acente',
                form_notes.createdate AS createdate,
                `text`,
                hex(personel_id) as 'personel',
                hex(avukat_id) as 'avukat',
                HEX(form_notes.id) as note_id,
                lastinsetdate FROM `file`
                INNER JOIN form_notes ON form_notes.file_id = file.id
                WHERE file.deletedate is null AND form_notes.deletedate is null AND (personel_id = :user OR avukat_id = :user) ORDER BY form_notes.createdate desc, file.createdate desc
            ");
            $pre->bindParam("user",$id);
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
        public function getAllIForAcente($id)
        {
            global $db;
            $pre = $db->prepare("SELECT
                HEX(file.id) as 'id',
                file.`name` as 'name',
                `order` as 'order',
                HEX(file.acente_id) as 'acente',
                form_notes.createdate AS createdate,
                hex(personel_id) as 'personel',
                hex(avukat_id) as 'avukat',
                HEX(form_notes.id) as note_id,
                `text`,
                lastinsetdate
                FROM `file`
                INNER JOIN form_notes ON form_notes.file_id = file.id
                INNER JOIN user ON user.acente_id = file.acente_id
                WHERE  file.deletedate is null AND form_notes.deletedate is null AND user.id = :user ORDER BY form_notes.createdate desc, file.createdate desc
            ");
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