<?php
    class Notification extends Model
    {
        public static function notify($islem,$dosya="\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0",$form="\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0\0",$personel)
        {
            $t = new Notification();
            $t->createNotify($islem,$dosya,$form,$personel);
        }
        public function createNotify($islem,$dosya,$form,$personel)
        {
            global $db;
            $id = getRandom();
            Flog(__FUNCTION__."(".var_export(func_get_args(),true).")");
            $pre = $db->prepare("INSERT INTO `notification` SET
                `id` = UNHEX(:id),
                `islem` = :islem,
                dosya = :dosya,
                form = UNHEX(:form),
                personel = UNHEX(:personel),
                createdate = NOW(),
                modifydate = NOW()
            ");
            $pre->bindParam("id", $id);
            $pre->bindParam("islem", $islem);
            $pre->bindParam("dosya", $dosya);
            $pre->bindParam("form", $form);
            $pre->bindParam("personel", $personel);
            if(!$pre->execute()){
                var_dump($pre->errorInfo());
            }else return true;
        }
    };