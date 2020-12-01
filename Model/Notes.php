<?php
    class Notes extends Model
    {
        public function add($fileid,$text,$user,$type)
        {
            global $db;
            try{
                $pre = $db->prepare("INSERT
                    INTO form_notes
                    SET `id`= UNHEX(:id),
                        `file_id`= UNHEX(:fileid),
                        `type`= :type,
                        `user`= :user,
                        `text` = :text,
                        createdate=NOW()
                ");
                $id = getRandom();
                $pre->bindParam("id", $id);
                $pre->bindParam("type",$type);
                $pre->bindParam("fileid",$fileid);
                $pre->bindParam("user",$user);
                $pre->bindParam("text",$text);
                $k = $pre->execute();
                $this->lastInsetFile($fileid);
                return $k;
            }catch(Exception $i){
                var_dump($i);
            }
        }
        public function lastInsetFile($id)
        {
            global $db;
            $pre = $db->prepare("UPDATE `file` SET `lastinsetdate` = NOW() WHERE `id` =  UNHEX(:id) LIMIT 1");
            $pre->bindParam("id",$id);
            return $pre->execute();
        }
        public function get($fileid)
        {
            global $db;
            try{
                $pre = $db->prepare("SELECT form_notes.createdate as tarih,HEX(form_notes.id) as id,form_notes.`text`,form_notes.`type`,HEX(form_notes.`user`) as user,`user`.`name` as username,`user`.`surname` as usersurname FROM form_notes
                INNER JOIN user ON user.id = form_notes.user
                WHERE `file_id`= UNHEX(:fileid) AND form_notes.deletedate is null AND user.deletedate is null ORDER BY form_notes.createdate DESC");
                $pre->bindParam("fileid",$fileid);
                $pre->execute();
                return $pre->fetchall(PDO::FETCH_OBJ);
            }catch(Exception $i){
                var_dump($i);
                exit;
            }
        }
        public function edit($id,$text)
        {
            global $db;
            try{
                $pre = $db->prepare("UPDATE form_notes
                    SET `text` = :text,
                        modifydate=NOW()
                    WHERE `id`= UNHEX(:id)
                ");
                $pre->bindParam("id", $id);
                $pre->bindParam("text",$text);
                return $pre->execute();
            }catch(Exception $i){
                exit;
            }
        }
        public function delete($id)
        {
            global $db;
            try{
                $pre = $db->prepare("UPDATE form_notes
                    SET deletedate=NOW()
                    WHERE`id`= UNHEX(:id)
                ");
                $pre->bindParam("id", $id);
                return $pre->execute();
            }catch(Exception $i){
                exit;
            }
        }
    };