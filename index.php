<?php
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
                SendStatus(404);
            }
        }else{
            SendStatus(404);
        }
    }else{
        $logfile = null;
        $workflow = time();
        try{
            include("Controller/$MVC_currentRouter->name.php");
            $main->connect();
        }catch(Exception $i){
            SendStatus(500);
            var_dump($i);
        }finally{
            $workflow = time() - $workflow;
            if(isset($logfile)) fclose($logfile);
        }
    };