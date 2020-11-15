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
        "url" => "/^{rootPath}([^\/]+)\/form\/yeni$/",
        "method" => "get",
        "name" => "form::sendNewForm"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/yeni$/",
        "method" => "post",
        "name" => "form::createForm"
    ]);