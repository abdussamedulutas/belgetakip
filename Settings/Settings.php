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
    RegisterPublicSource("/{rootPath}uploads\/(.+)/","./Uploads/");
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

    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/acente\/([^\/]{32})$/",
        "method" => "get",
        "name" => "acente::editForm"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/acente\/([^\/]{32})$/",
        "method" => "post",
        "name" => "acente::edit"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/acente\/([^\/]{32})$/",
        "method" => "get",
        "name" => "acente::editForm"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/acente\/list$/",
        "method" => "get",
        "name" => "acente::showList"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/acente\/list$/",
        "method" => "post",
        "name" => "acente::post"
    ]);

    
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/list$/",
        "method" => "get",
        "name" => "acente::listView"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/list$/",
        "method" => "get",
        "name" => "acente::post"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/turleri$/",
        "method" => "get",
        "name" => "form::viewSettings"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/turleri$/",
        "method" => "post",
        "name" => "form::post"
    ]);