<?php
    MySQLConfig([
        "Host" => "127.0.0.1",
        "UserName" => "root",
        "UserPassword" => "",
        "Database" => "dosyatakip",
        "Charset" => "utf8"
    ]);

    setSerialPath("rootPath","\/");
    $workspaceDir = "";

    RegisterPublicSource("/{rootPath}assets\/(.+)/","./Contents/");
    RegisterPublicSource("/{rootPath}template\/(.+)/","./View/templates/");
    RegisterPublicSource("/{rootPath}(.+)/","./Contents/");

    RegisterController([
        "url" => "/^{rootPath}$/",
        "method" => "get",
        "name" => "main::redirectpanel"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/logout$/",
        "method" => "get",
        "name" => "auth::logout"
    ]);
    RegisterController([
        "url" => "/^{rootPath}login$/",
        "method" => "post",
        "name" => "auth"
    ]);
    RegisterController([
        "url" => "/^{rootPath}login$/",
        "method" => "get",
        "name" => "auth"
    ]);

    
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/panel$/",
        "method" => "get",
        "name" => "main"
    ]);

    
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/acente\/yeni$/",
        "method" => "get",
        "name" => "acente::yeniFormu"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/acente\/yeni$/",
        "method" => "post",
        "name" => "acente::yeni"
    ]);