<?php
    class Notes extends Model
    {
        public function add($formid,$text)
        {
            global $db;
            try{
                $pre = $db->prepare("INSERT
                    INTO form_notes
                    SET `id`= :id,
                        `formid`=UNHEX(:formid),
                        `text` = :text,
                        createdate=NOW()
                ");
                $id = getRandom();
                $pre->bindParam("id", $id);
                $pre->bindParam("formid",$formid);
                $pre->bindParam("text",$text);
                return $pre->execute();
            }catch(Exception $i){
                exit;
            }
        }
        public function get($formid)
        {
            global $db;
            try{
                $pre = $db->prepare("SELECT HEX(id) as id,`text` FROM form_notes WHERE `formid`= UNHEX(:formid) AND deletedate is null");
                $pre->bindParam("formid",$formid);
                $pre->execute();
                return $pre->fetch(PDO::FETCH_OBJ);
            }catch(Exception $i){
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