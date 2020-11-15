<?php
    MySQLConfig([
        "Host" => "127.0.0.1",
        "UserName" => "root",
        "UserPassword" => "",
        "Database" => "dosyatakip",
        "Charset" => "utf8"
    ]);

    RegisterPublicSource("/\/assets\/(.+)/","./Contents/");
    RegisterPublicSource("/\/template\/(.+)/","./View/templates/");
    RegisterPublicSource("/\/(.+)/","./Contents/");

    RegisterController([
        "url" => "/",
        "type" => "text",
        "method" => "get",
        "name" => "main::redirectpanel"
    ]);
    RegisterController([
        "url" => "/([^\/]+)\/panel/",
        "type" => "regex",
        "method" => "get",
        "name" => "main"
    ]);
    RegisterController([
        "url" => "/([^\/]+)\/logout/",
        "type" => "regex",
        "method" => "get",
        "name" => "auth::logout"
    ]);
    RegisterController([
        "url" => "/login",
        "type" => "text",
        "method" => "post",
        "name" => "auth"
    ]);
    RegisterController([
        "url" => "/login",
        "type" => "text",
        "method" => "get",
        "name" => "auth"
    ]);