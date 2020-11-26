<?php
    include("Model/Acente.php");
    include("Model/User.php");
    include("Model/Notification.php");
    $main = new class extends Controller{
        public function viewAcente()
        {
            permission("personel|admin");
            global $workspaceDir;

            $acente = new Acente();
            $acenteler = $acente->getAll();

            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("acente/acenteler",(object)[
                "userPanelLink"=>$userPanelLink,
                "acenteler"=>$acenteler
            ]);
        }
        public function viewKullanici()
        {
            permission("personel|admin");
            global $workspaceDir;

            $acente = new User();
            $kullanicilar = $acente->getAll('kullanici');

            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("acente/kullanicilar",(object)[
                "userPanelLink"=>$userPanelLink,
                "kullanicilar"=>$kullanicilar
            ]);
        }
        public function viewYoneticiler()
        {
            permission("personel|admin");
            global $workspaceDir;

            $acente = new User();
            $admin = $acente->getAll('admin');

            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("acente/yoneticiler",(object)[
                "userPanelLink"=>$userPanelLink,
                "admin"=>$admin
            ]);
        }
        
        public function viewPersonel()
        {
            permission("personel|admin");
            global $workspaceDir;

            $acente = new User();
            $personeller = $acente->getAll('personel');

            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("acente/personeller",(object)[
                "userPanelLink"=>$userPanelLink,
                "personeller"=>$personeller
            ]);
        }
        public function post()
        {
            switch(Request::post("action"))
            {
                case "getAcenteList":{
                    $acente = new Acente();
                    $personeller = $acente->getAll();
                    Response::soap("success","ALL_ACENTE",$personeller);
                    break;
                }
                case "createAcente":{
                    $acente = new Acente();
                    $name = Request::post("name");
                    if($acente->createAcente($name)){
                        Response::soap("success","CREATE_ACENTE");
                    }else{
                        SendStatus(404);
                    }
                    break;
                }
                case "deleteAcente":{
                    $acente = new Acente();
                    $id = Request::post("id");
                    if($acente->deleteAcente($id)){
                        Response::soap("success","DELETEACENTE");
                    }else{
                        SendStatus(404);
                    }
                    break;
                }
                case "changeAcenteName":{
                    global $workspaceDir;
                    $acente = new Acente();
                    $id = Request::post("id");
                    $a = $acente->getAcente($id);
                    if(!isset($a)){
                        Response::soap("fail","ACENTE_WRONGID");
                        return;
                    };
                    if(!$acente->isUsableName(Request::post("name")))
                    {
                        return Response::soap("fail","ALREADYEXISTS",["text"=>"İsim mevcut lütfen başka bir adres deneyiniz"]);
                    }
                    if($acente->setName($id,Request::post("name")))
                    {
                        Response::soap("success","ACENTE_CHANGEDNAME");
                    }else{
                        SendStatus(500);
                    }
                    break;
                }
                case "getKullaniciInfo":
                case "getPersonelInfo":
                case "getAdminInfo":{
                    $user = new User();
                    $id = Request::post("id");
                    $personel = $user->get($id);
                    if($personel != false){
                        Response::soap("success","USER_INFO",$personel);
                    }else{
                        SendStatus(404);
                    }
                    break;
                }
                case "tumacenteler":{
                    $allAcente = (new Acente())->getAll();
                    Response::soap("success","ACENTE_ALL",$allAcente);
                    break;
                }
                case "deletePersonel":{
                    $user = new User();
                    $id = Request::post("id");
                    if($user->delete($id)){
                        Response::soap("success","DELETEPERSONEL");
                    }else{
                        SendStatus(404);
                    }
                    break;
                }
                case "editPersonel":{
                    $id = Request::post("id");
                    global $workspaceDir;
                    Request::validation("POST","name",["require"=>true],"İsim alanı boş veya geçersiz");
                    Request::validation("POST","surname",["require"=>true],"Soyisim alanı boş veya geçersiz");
                    Request::validation("POST","email",["require"=>true],"E-Mail Adresi alanı boş veya geçersiz");
                    $user = new User();
                    $personel = $user->get($id);
                    if($personel->email != Request::post("email")){
                        if($user->isUsableMail(Request::post("email")))
                        {
                            return Response::soap("fail","ALREADYEXISTS",["text"=>"E-Mail mevcut lütfen başka bir adres deneyiniz"]);
                        }
                    };
                    if(Request::file("image")){
                        $newName = Request::acceptFile("image");
                    }else{
                        $newName = $personel->image;
                    }
                    $user = new User();
                    if($user->update(
                        $id,
                        Request::post("name"),
                        Request::post("surname"),
                        'personel',
                        Request::post("email"),
                        $newName
                    )){
                        Response::soap("success","PERSONEL_UPDATE");
                    }else{
                        SendStatus(500);
                    }
                    break;
                }
                case "createPersonel":{
                    global $workspaceDir;
                    Request::validation("POST","name",["require"=>true],"İsim alanı boş veya geçersiz");
                    Request::validation("POST","surname",["require"=>true],"Soyisim alanı boş veya geçersiz");
                    Request::validation("POST","email",["require"=>true],"E-Mail Adresi alanı boş veya geçersiz");
                    Request::validation("POST","password1",["require"=>true],"Parola alanı boş veya geçersiz");
                    Request::validation("POST","password2",["require"=>true],"Parola alanı boş veya geçersiz");
                    if(Request::post("password1") != Request::post("password2")){
                        return Response::soap("fail","INVALID_FIELD",[
                            "fieldName" => "password2",
                            "text" => "Parolalar eşleşmiyor"
                        ]);
                    };
                    $user = new User();
                    if($user->isUsableMail(Request::post("email")))
                    {
                        return Response::soap("fail","ALREADYEXISTS",["text"=>"E-Mail Adresi mevcut lütfen başka bir adres deneyiniz"]);
                    };
                    if(Request::file("image")){
                        $newName = Request::acceptFile("image");
                    }else $newName = "";
                    $user = new User();
                    if($user->createUser(
                        Request::post("name"),
                        Request::post("surname"),
                        'personel',
                        Request::post("email"),
                        $newName,
                        Request::post("password1")
                    )){
                        Response::soap("success","PERSONEL_CREATEDPERSONEL");
                    }else{
                        SendStatus(500);
                    }
                    break;
                }
                case "deleteKullanici":{
                    $user = new User();
                    $id = Request::post("id");
                    if($user->delete($id)){
                        Response::soap("success","DELETEPERSONEL");
                    }else{
                        SendStatus(404);
                    }
                    break;
                }
                case "editKullanici":{
                    $id = Request::post("id");
                    global $workspaceDir;
                    Request::validation("POST","name",["require"=>true],"İsim alanı boş veya geçersiz");
                    Request::validation("POST","surname",["require"=>true],"Soyisim alanı boş veya geçersiz");
                    Request::validation("POST","email",["require"=>true],"E-Mail Adresi alanı boş veya geçersiz");
                    $user = new User();
                    $personel = $user->get($id);
                    if($personel->email != Request::post("email")){
                        if($user->isUsableMail(Request::post("email")))
                        {
                            return Response::soap("fail","ALREADYEXISTS",["text"=>"E-Mail mevcut lütfen başka bir adres deneyiniz"]);
                        }
                    };
                    if(Request::file("image")){
                        $newName = Request::acceptFile("image");
                    }else{
                        $newName = $personel->image;
                    }
                    $user = new User();
                    if($user->updateKullanici(
                        $id,
                        Request::post("name"),
                        Request::post("surname"),
                        'kullanici',
                        Request::post("email"),
                        $newName
                    )){
                        Response::soap("success","PERSONEL_UPDATE");
                    }else{
                        SendStatus(500);
                    }
                    break;
                }
                case "createKullanici":{
                    global $workspaceDir;
                    Request::validation("POST","name",["require"=>true],"İsim alanı boş veya geçersiz");
                    Request::validation("POST","surname",["require"=>true],"Soyisim alanı boş veya geçersiz");
                    Request::validation("POST","email",["require"=>true],"E-Mail Adresi alanı boş veya geçersiz");
                    Request::validation("POST","password1",["require"=>true],"Parola alanı boş veya geçersiz");
                    Request::validation("POST","password2",["require"=>true],"Parola alanı boş veya geçersiz");
                    if(Request::post("password1") != Request::post("password2")){
                        return Response::soap("fail","INVALID_FIELD",[
                            "fieldName" => "password2",
                            "text" => "Parolalar eşleşmiyor"
                        ]);
                    };
                    $user = new User();
                    if($user->isUsableMail(Request::post("email")))
                    {
                        return Response::soap("fail","ALREADYEXISTS",["text"=>"E-Mail Adresi mevcut lütfen başka bir adres deneyiniz"]);
                    };
                    if(Request::file("image")){
                        $newName = Request::acceptFile("image");
                    }else $newName = "";
                    $user = new User();
                    if($user->createUser(
                        Request::post("name"),
                        Request::post("surname"),
                        'kullanici',
                        Request::post("email"),
                        $newName,
                        Request::post("password1"),
                        Request::post("acente")
                    )){
                        Response::soap("success","PERSONEL_CREATEDPERSONEL");
                    }else{
                        SendStatus(500);
                    }
                    break;
                }
                case "deleteAdmin":{
                    $user = new User();
                    $id = Request::post("id");
                    if($user->delete($id)){
                        Response::soap("success","DELETEPERSONEL");
                    }else{
                        SendStatus(404);
                    }
                    break;
                }
                case "editAdmin":{
                    $id = Request::post("id");
                    global $workspaceDir;
                    Request::validation("POST","name",["require"=>true],"İsim alanı boş veya geçersiz");
                    Request::validation("POST","surname",["require"=>true],"Soyisim alanı boş veya geçersiz");
                    Request::validation("POST","email",["require"=>true],"E-Mail Adresi alanı boş veya geçersiz");
                    $user = new User();
                    $personel = $user->get($id);
                    if($personel->email != Request::post("email")){
                        if($user->isUsableMail(Request::post("email")))
                        {
                            return Response::soap("fail","ALREADYEXISTS",["text"=>"E-Mail mevcut lütfen başka bir adres deneyiniz"]);
                        }
                    };
                    if(Request::file("image")){
                        $newName = Request::acceptFile("image");
                    }else{
                        $newName = $personel->image;
                    }
                    $user = new User();
                    if($user->update(
                        $id,
                        Request::post("name"),
                        Request::post("surname"),
                        'admin',
                        Request::post("email"),
                        $newName
                    )){
                        Response::soap("success","PERSONEL_UPDATE");
                    }else{
                        SendStatus(500);
                    }
                    break;
                }
                case "createAdmin":{
                    global $workspaceDir;
                    Request::validation("POST","name",["require"=>true],"İsim alanı boş veya geçersiz");
                    Request::validation("POST","surname",["require"=>true],"Soyisim alanı boş veya geçersiz");
                    Request::validation("POST","email",["require"=>true],"E-Mail Adresi alanı boş veya geçersiz");
                    Request::validation("POST","password1",["require"=>true],"Parola alanı boş veya geçersiz");
                    Request::validation("POST","password2",["require"=>true],"Parola alanı boş veya geçersiz");
                    if(Request::post("password1") != Request::post("password2")){
                        return Response::soap("fail","INVALID_FIELD",[
                            "fieldName" => "password2",
                            "text" => "Parolalar eşleşmiyor"
                        ]);
                    };
                    $user = new User();
                    if($user->isUsableMail(Request::post("email")))
                    {
                        return Response::soap("fail","ALREADYEXISTS",["text"=>"E-Mail Adresi mevcut lütfen başka bir adres deneyiniz"]);
                    };
                    if(Request::file("image")){
                        $newName = Request::acceptFile("image");
                    }else $newName = "";
                    $user = new User();
                    if($user->createUser(
                        Request::post("name"),
                        Request::post("surname"),
                        'admin',
                        Request::post("email"),
                        $newName,
                        Request::post("password1")
                    )){
                        Response::soap("success","PERSONEL_CREATEDPERSONEL");
                    }else{
                        SendStatus(500);
                    }
                    break;
                }
            }
        }
    };