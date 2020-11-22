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
        "url" => "/^{rootPath}([^\/]+)\/form\/ayarlar$/",
        "method" => "get",
        "name" => "form::viewSettings"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/ayarlar$/",
        "method" => "post",
        "name" => "form::post"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/gerekenler$/",
        "method" => "get",
        "name" => "form::viewRequired"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/gerekenler$/",
        "method" => "post",
        "name" => "form::post"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/dosyalar$/",
        "method" => "get",
        "name" => "file::viewFiles"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/dosyalar$/",
        "method" => "post",
        "name" => "file::post"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/ekle$/",
        "method" => "get",
        "name" => "file::addForm"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/ekle$/",
        "method" => "post",
        "name" => "file::post"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/([^\/]{32})$/",
        "method" => "get",
        "name" => "form::viewForm"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/([^\/]{32})$/",
        "method" => "post",
        "name" => "form::post"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/tumu$/",
        "method" => "get",
        "name" => "file::viewForms"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/tumu$/",
        "method" => "post",
        "name" => "file::post"
    ]);

    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/acenteler$/",
        "method" => "get",
        "name" => "acente::viewAcente"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/acenteler$/",
        "method" => "post",
        "name" => "acente::post"
    ]);

    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/personeller$/",
        "method" => "get",
        "name" => "acente::viewPersonel"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/personeller$/",
        "method" => "post",
        "name" => "acente::post"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/duzenle\/([^\/]{32})$/",
        "method" => "get",
        "name" => "form::editForm"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/form\/duzenle\/([^\/]{32})$/",
        "method" => "post",
        "name" => "form::post"
    ]);