<?php
    class Acente extends Model
    {
        public function isUsableName($name)
        {
            $user = $this->query("SELECT * FROM acente WHERE `name` = :name LIMIT 1",[
                "name" => $name
            ]);
            if(count($user) == 0)
            {
                return true;
            }else{
                return false;
            }
        }
        public function createAcente($name)
        {
            global $db;
            try{
                $pre = $db->prepare("INSERT INTO acente (`id`,`name`,`createdate`,`modifydate`) VALUES (UNHEX(:id),:name,NOW(),NOW())");
                $id = bin2hex(random_bytes(16));
                $pre->bindParam("id", $id);
                $pre->bindParam("name",$name);
                $pre->execute();
                return $id;
            }catch(Exception $i){
                var_dump($i);
                exit;
            }
        }
    };