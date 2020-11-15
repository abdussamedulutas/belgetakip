<?php
    $db = null;
    $MVC_route = [];
    $MVC_route_source = [];
    $MVC_dbconfig = null;

    

    $MVC_url        = $_SERVER["REQUEST_URI"];
    $MVC_purl        = (object) parse_url($MVC_url);
    $MVC_method     = $_SERVER["REQUEST_METHOD"];
    $MVC_currentRouter = null;
    $MVC_urlArgs = [];


    $_paths = [];
    function setSerialPath($name,$value)
    {
        global $_paths;
        $_paths[$name]=$value;
    };
    function getSerialPath($text)
    {
        global $_paths;
        return preg_replace_callback("/({([^}]+)})/",function($matches) use($_paths){
            if(isset($_paths[$matches[2]]))
            {
                return $_paths[$matches[2]];
            }else{
                return $matches[0];
            }
        },$text);
    };
    function MySQLConfig($config)
    {
        global $MVC_dbconfig;
        if(!isset($MVC_dbconfig))
        {
            $MVC_dbconfig = (object) $config;
        }
    };
    class Request {
        public static function url()
        {
            global $MVC_purl;
            return $MVC_purl;
        }
        public static function get($str)
        {
            if(!empty($_GET))
            {
                if(isset($_GET[$str]))
                {
                    return $_GET[$str];
                }
            };
            return false;
        }
        public static function post($str)
        {
            if(!empty($_POST))
            {
                if(isset($_POST[$str]))
                {
                    return $_POST[$str];
                }
            };
            return false;
        }
        public static function file($str)
        {
            if(!empty($_FILES))
            {
                if(isset($_FILES[$str]))
                {
                    return $_FILES[$str];
                }
            };
            return false;
        }
        public static function method()
        {
            global $MVC_method;
            return $MVC_method;
        }
        public static function validation($method,$field,$options,$description)
        {
            $require = isset($options["require"]) ? $options["require"] : true;
            switch($method)
            {
                case "POST":{
                    $var = Request::post($field);
                    if($require && $var == false)
                    {
                        Response::soap("fail","REQUIRED_FIELD",[
                            "fieldName" => $field,
                            "text" => $description
                        ]);
                        exit;
                    }
                    if(isset($options["regex"]))
                    {
                        if(preg_match($options["regex"],$var) == -1)
                        {
                            Response::soap("fail","INVALID_FIELD",[
                                "fieldName" => $field,
                                "text" => $description
                            ]);
                            exit;
                        }
                    }
                    break;
                }
                case "GET":{
                    $var = Request::get($field);
                    if($require && $var == false)
                    {
                        Response::soap("fail","REQUIRED_FIELD",[
                            "fieldName" => $field,
                            "text" => $description
                        ]);
                        exit;
                    }
                    if(isset($options->regex))
                    {
                        if(preg_match($options->regex,$var) == -1)
                        {
                            Response::soap("fail","INVALID_FIELD",[
                                "fieldName" => $field,
                                "text" => $description
                            ]);
                            exit;
                        }
                    }
                    break;
                }
            }
        }
    };
    class Response {
        public static function view($path,$data = [])
        {
            global $workspaceDir;
            $settings = new Settings();
            if(file_exists("View/$path.php") && is_file("View/$path.php"))
            {
                include("View/$path.php");
            }else if(file_exists("View/$path.html") && is_file("View/$path.html"))
            {
                include("View/$path.html");
            }else if(file_exists("View/$path") && is_file("View/$path"))
            {
                include("View/$path");
            }else{
                throw new Exception("Cannot find View file : $path");
            }
        }
        public static function json($value)
        {
            header("Content-Type:application/json;charset=utf8");
            echo json_encode($value);
        }
        public static function soap($status,$code,$arguments)
        {
            Response::json([
                "status" => $status,
                "code" => $code,
                "data" => $arguments,
                "date" => date("H:i:s d/m/Y",time())
            ]);
        }
        public static function text($value)
        {
            header("Content-Type:text/plain;charset=utf8");
            echo $value;
        }
        public static function file($path)
        {
            SendFile($path);
        }
        public static function tempRedirect($path)
        {
            header("Location:$path");
            http_response_code(307);
        }
        public static function redirect($path)
        {
            header("Location:$path");
            http_response_code(301);
        }
    };
    function ConnectDatabase()
    {
        global $db,$MVC_dbconfig;
        if(isset($db)) return;
        $db = new PDO("mysql:dbname=$MVC_dbconfig->Database;host=$MVC_dbconfig->Host;charset=$MVC_dbconfig->Charset",$MVC_dbconfig->UserName,$MVC_dbconfig->UserPassword);
    };
    function getRandom()
    {
        return bin2hex(random_bytes(16));
    };
    function RegisterController($route)
    {
        global $MVC_route;
        $m = ($route["method"] ?? "GET") . "|".$route["url"];
        $MVC_route[$m] = $route;
    }
    function RegisterPublicSource($reg,$directorPath)
    {
        global $MVC_route_source;
        $MVC_route_source[] = [$reg,$directorPath];
    }

    include("Settings/Settings.php");
    function HandleRoute()
    {
        global $MVC_currentRouter,$MVC_purl,$MVC_method,$MVC_urlArgs,$MVC_route;
        foreach($MVC_route as $route)
        {
            $reg = getSerialPath($route["url"]);
            if(strtoupper($route["method"]) == $MVC_method)
            {
                if(preg_match($reg,$MVC_purl->path,$splice))
                {
                    $MVC_urlArgs = $splice;
                    $MVC_currentRouter = (object) $route;
                    $_name = explode('::',$MVC_currentRouter->name);
                    $MVC_currentRouter->name = $_name[0];
                    if(count($_name) == 2) $MVC_currentRouter->func = $_name[1];
                    break;
                }
            }
        };
    };

    $MVC_handledSource = null;
    function getHandledSource()
    {
        global $MVC_handledSource;
        return $MVC_handledSource;
    }
    function HandlePublicSource()
    {
        global $MVC_purl,$MVC_route_source,$MVC_handledSource;
        foreach($MVC_route_source as $source)
        {
            preg_match(getSerialPath($source[0]),$MVC_purl->path,$res);
            if(count($res) != 0)
            {
                $MVC_handledSource = $source[1].$res[1];
                return $MVC_handledSource;
            }
        };
    }
    function SendStatus($no)
    {
        http_response_code($no);
    };
    
    include("DefaultController.php");
    include("MimeTypes.php");
    function SendFile($filepath)
    {
        global $MVC_mimeTypes;
        $_s = explode(".",getSerialPath($filepath));
        $ext = end($_s);
        if(file_exists($filepath) && is_file($filepath))
        {
            $mimetype = $MVC_mimeTypes[$ext] ?? "application/octet-stream";
            header("Content-Type:$mimetype");
            readfile($filepath);
            return true;
        }else{
            return false;
        }
    }
    function safeName($str)
    {
        return preg_replace("/[\s*\'\"\!\(\)]/",'',str_replace([
            'Ü',
            'ü',
            'Ğ',
            'ğ',
            'İ',
            'ı',
            'Ş',
            'ş',
            'Ç',
            'ç',
            'Ö',
            'ö',
            '?',';',':'
        ],[
            'U',
            'u',
            'G',
            'g',
            'I',
            'i',
            'S',
            's',
            'C',
            'c',
            'O',
            'o',
            '','',''
        ],$str));
    };