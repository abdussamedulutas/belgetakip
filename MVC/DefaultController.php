<?php
    class Model {
        public function __construct()
        {
            if(session_status() != PHP_SESSION_ACTIVE) session_start();
            ConnectDatabase();
        }
        public function setSettings($name,$value)
        {
            $settings = new Settings();
            $settings->set($name,$value);
        }
        public function getSettings($name)
        {
            $settings = new Settings();
            return $settings->get($name);
        }
        public function flushSettings()
        {
            $settings = new Settings();
            $settings->flush();
        }
        public function transection()
        {
            global $db;
            $db->beginTransaction();
        }
        public function rollback()
        {
            global $db;
            $db->rollBack();
        }
        public function commit()
        {
            global $db;
            $db->commit();
        }
        public function query($sql,$vars=[])
        {
            global $db;
            $pre = $db->prepare($sql);
            foreach($vars as $_ids => $_names)
            {
                $pre->bindParam($_ids,$_names);
            };
            if($pre->execute())
            {
                return $pre->fetchall(PDO::FETCH_OBJ);
            }else{
                var_dump($db->errorInfo());
                exit;
            }
        }
    };
    class Controller extends Model
    {
        public function connect()
        {
            global $MVC_currentRouter;
            if(Request::method() == "POST")
            {
                $action = Request::post("action");
                if(!isset($MVC_currentRouter->func))
                {
                    if(method_exists($this,"post".$action))
                    {
                        try{
                            $this->{"post".$action}();
                        }catch(Exception $i){
                            SendStatus(403);
                            var_dump($i);
                        }
                    }else{
                        method_exists($this,"post".$action);
                        echo "no method exists: (post".$action.")";
                        SendStatus(403);
                    }
                }else{
                    if(method_exists($this,$MVC_currentRouter->func))
                    {
                        try{
                            $this->{$MVC_currentRouter->func}();
                        }catch(Exception $i){
                            SendStatus(403);
                            var_dump($i);
                        }
                    }else{
                        method_exists($this,$MVC_currentRouter->func);
                        echo "no method exists: (".$MVC_currentRouter->func.")";
                        SendStatus(403);
                    }
                }
            }else{
                try{
                    if(isset($MVC_currentRouter->func))
                    {
                        if(method_exists($this,$MVC_currentRouter->func))
                        {
                            try{
                                $this->{$MVC_currentRouter->func}();
                            }catch(Exception $i){
                                SendStatus(403);
                                var_dump($i);
                            }
                        }else{
                            method_exists($this,$MVC_currentRouter->func);
                            echo "no method exists: (".$MVC_currentRouter->func.")";
                            SendStatus(403);
                        }
                    }else{
                        $this->getView();
                    }
                }catch(Exception $i){
                    SendStatus(403);
                    var_dump($i);
                }
            }
        }
    };

    class Settings extends Model
    {
        public static $data = [];
        public static $changedData = [];
        public static $createdData = [];
        public static $loaded = false;
        public function __construct(){
            $this->load();
        }
        public function load()
        {
            if(Settings::$loaded) return;
            $im = $this->query("SELECT * FROM `settings` WHERE deletedate is null");  
            foreach($im as $record)
            {
                Settings::$data[$record->name] = $record->value;
            };
            Settings::$loaded = true;
        }
        public function get($name)
        {
            if($this->exists($name)) return Settings::$data[$name];
            else return false;
        }
        public function exists($name)
        {
            return isset(Settings::$data[$name]) ? true : false;
        }
        public function set($name,$value)
        {
            if($this->exists($name))
            {
                Settings::$changedData[$name] = $value;
            }else{
                Settings::$createdData[$name] = $value;
            }
        }
        public function flush()
        {
            $this->transection();
            foreach(Settings::$changedData as $name => $value)
            {
                $this->query("UPDATE `settings` SET value = :value, modifydate = NOW() WHERE name = :name",array(
                    "value" => $value,
                    "name" => $name
                ));
            }
            foreach(Settings::$createdData as $name => $value)
            {
                $this->query("INSERT INTO `settings` SET id=:id, name=:name, value=:value, createdate=NOW(), modifydate=NOW()",array(
                    "id" => getRandom(),
                    "value" => $value,
                    "name" => $name
                ));
            }
        }
    };