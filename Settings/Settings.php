<?php
    MySQLConfig([
        "Host" => "127.0.0.1",
        "UserName" => "u7417506_dosyatakip",
        "UserPassword" => "u8FxCdbBwt7jiB7",
        "Database" => "u7417506_dosyatakip",
        "Charset" => "utf8"
    ]);
    setSerialPath("rootPath","\/");
    $workspaceDir = "";
    
    RegisterPublicSource("/{rootPath}assets\/(.+)/","./Contents/");
    RegisterPublicSource("/{rootPath}uploads\/(.+)/","./Uploads/");
    RegisterPublicSource("/{rootPath}template\/(.+)/","./templates/");
    RegisterPublicSource("/{rootPath}(.+)/","./Contents/");
    RegisterPublicSource("/{rootPath}\/\.well-known\//","./.well-known/");

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
        "url" => "/^{rootPath}([^\/]+)\/hatirlatma$/",
        "method" => "get",
        "name" => "file::viewHatirlatici"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/hatirlatma$/",
        "method" => "post",
        "name" => "file::post"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/dosyalar$/",
        "method" => "post",
        "name" => "file::post"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/dosya\/(\d+)$/",
        "method" => "get",
        "name" => "file::viewFile"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/dosya\/(\d+)$/",
        "method" => "post",
        "name" => "file::post"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/eksikevraklar$/",
        "method" => "get",
        "name" => "file::eksikler"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/sondurum$/",
        "method" => "get",
        "name" => "file::sondurum"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/sondurum$/",
        "method" => "post",
        "name" => "form::post"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/eksikevraklar$/",
        "method" => "post",
        "name" => "file::post"
    ]);

    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/dosya\/ekle$/",
        "method" => "get",
        "name" => "file::addForm"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/dosya\/ekle$/",
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
        "url" => "/^{rootPath}([^\/]+)\/avukatlar$/",
        "method" => "get",
        "name" => "acente::viewAvukat"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/avukatlar$/",
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
        "url" => "/^{rootPath}([^\/]+)\/kullanicilar$/",
        "method" => "get",
        "name" => "acente::viewKullanici"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/kullanicilar$/",
        "method" => "post",
        "name" => "acente::post"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/yoneticiler$/",
        "method" => "get",
        "name" => "acente::viewYoneticiler"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/yoneticiler$/",
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
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/yedekler$/",
        "method" => "get",
        "name" => "main::recoveryView"
    ]);
    RegisterController([
        "url" => "/^{rootPath}recmode$/",
        "method" => "get",
        "name" => "main::getRecovery"
    ]);
    RegisterController([
        "url" => "/^{rootPath}review$/",
        "method" => "get",
        "name" => "main::review"
    ]);

    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/hesap$/",
        "method" => "get",
        "name" => "acente::account"
    ]);
    RegisterController([
        "url" => "/^{rootPath}([^\/]+)\/hesap$/",
        "method" => "post",
        "name" => "acente::post"
    ]);