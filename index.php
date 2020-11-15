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
                echo "Not find public file";
                SendStatus(404);
            }
        }else{
            echo "Not handled public file";
            SendStatus(404);
        }
    }else{
        try{
            include("Controller/$MVC_currentRouter->name.php");
            $main->connect();
        }catch(Exception $i){
            SendStatus(500);
            var_dump($i);
        }
    };