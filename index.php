<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    include("MVC/Engine.php");
    HandleRoute();
    if(!isset($MVC_currentRouter) || !file_exists("Controller/$MVC_currentRouter->name.php"))
    {
        if(HandlePublicSource())
        {
            $filepath = getHandledSource();
            $_s = explode(".",$filepath);
            $ext = end($_s);
            if(file_exists($filepath) && is_file($filepath))
            {
                $mimetype = $MVC_mimeTypes[$ext] ?? "application/octet-stream";
                header("Content-Type:$mimetype");
                readfile($filepath);
            }else{
                echo "Not find public file";
                SendStatus(404);
            }
        }else{
            echo "Not handled public file";
            SendStatus(404);
        }
    }else{
        $logfile = null;
        function Flog($text)
        {
            global $logfile,$MVC_method,$logfile;
            if(!isset($logfile)) $logfile = fopen("logs/".$MVC_method."_".time()."_".bin2hex(random_bytes(5)).".log","a");
            fwrite($logfile,$text."\n");
        };
        $workflow = time();
        Flog("STARTED");
        Flog("POST:".var_export($_POST,true));
        Flog("GET:".var_export($_GET,true));
        Flog("FILES:".var_export($_FILES,true));
        try{
            include("Controller/$MVC_currentRouter->name.php");
            $main->connect();
        }catch(Exception $i){
            SendStatus(500);
            var_dump($i);
        }finally{
            $workflow = time() - $workflow;
            Flog("ENDED $workflow ms time");
            Flog("SERVER:".var_export($_SERVER,true));
            Flog(date("d/m/Y H:i:s"));
            if(isset($logfile)) fclose($logfile);
        }
    };