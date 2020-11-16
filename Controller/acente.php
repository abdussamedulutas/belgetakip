<?php
    include("Model/Acente.php");
    include("Model/User.php");

    function useAuthGET()
    {
        global $workspaceDir;
        if(!isset($_SESSION["user"]))
        {
            Response::tempRedirect("$workspaceDir/login");
            exit;
        }
    };
    function useAuthPOST()
    {
        global $workspaceDir;
        if(!isset($_SESSION["user"]))
        {
            SendStatus(404);
        };
    }

    $main = new class extends Controller{
        public function yeniFormu()
        {
            useAuthGET();
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("acente/yeni",(object)[
                "userPanelLink"=>$userPanelLink
            ]);
        }
        public function showList()
        {
            useAuthGET();
            global $workspaceDir;
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            $acente = new Acente();
            $acenteler = $acente->getAll();
            Response::view("acente/liste",(object)[
                "userPanelLink"=>$userPanelLink,
                "acenteler"=>$acenteler
            ]);
        }
        public function yeni()
        {
            useAuthPOST();
            global $workspaceDir;
            if(Request::method() != "POST")
            {
                SendStatus(403);
                exit;
            };
            Request::validation("POST","name",[
                "require"=>true,
                "regex"=>"/^.{6,31}$/"
            ],"Acente ismi boş veya geçersiz");
            $acente = new Acente();
            if($acente->isUsableName(Request::post("name")))
            {
                if($id = $acente->createAcente(Request::post("name")))
                {
                    Response::soap("success","CREATED_ACENTE",[
                        "path"=>$workspaceDir."/".username()."/acente/".$id
                    ]);
                }else{
                    SendStatus(500);
                }
            }else{
                Response::soap("fail","ALREADYEXISTS",["text"=>"E-Mail mevcut lütfen başka bir adres deneyiniz"]);
            }
        }
        public function editForm()
        {
            useAuthGET();
            $id = getUrlTokens()[2];
            global $workspaceDir;
            $acente = new Acente();
            $acente = $acente->getAcente($id);
            if(count($acente) == 0){
                SendStatus(404);
            }else $acente = $acente[0];
            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            $cente = new Acente();
            $tumPersoneller = $cente->getAcentePersonelAll($id);  
            Response::view("acente/duzenle",(object)[
                "userPanelLink"=>$userPanelLink,
                "acente"=>$acente,
                "personeller" => $tumPersoneller
            ]);
        }
        public function post()
        {
            useAuthPOST();
            switch(Request::post("action"))
            {
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
            }
        }
        public function edit()
        {
            useAuthPOST();
            switch(Request::post("action"))
            {
                case "changeAcenteName":{
                    $id = getUrlTokens()[2];
                    global $workspaceDir;
                    $acente = new Acente();
                    $a = $acente->getAcente($id);
                    if(count($a) == 0){
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
                case "getPersonelInfo":{
                    $user = new User();
                    $id = Request::post("id");
                    $personel = $user->getPersonel($id);
                    if(count($personel) != 0){
                        Response::soap("success","PERSONEL_INFO",$personel[0]);
                    }else{
                        SendStatus(404);
                    }
                    break;
                }
                case "deletePersonel":{
                    $user = new User();
                    $id = Request::post("id");
                    if($user->deletePersonel($id)){
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
                    $personel = $user->getPersonel($id)[0];
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
                    if($user->updatePersonel(
                        $id,
                        Request::post("name"),
                        Request::post("surname"),
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
                    $id = getUrlTokens()[2];
                    global $workspaceDir;
                    Request::validation("POST","name",["require"=>true],"İsim alanı boş veya geçersiz");
                    Request::validation("POST","surname",["require"=>true],"Soyisim alanı boş veya geçersiz");
                    Request::validation("POST","email",["require"=>true],"E-Mail Adresi alanı boş veya geçersiz");
                    Request::validation("POST","password1",["require"=>true],"Parola alanı boş veya geçersiz");
                    Request::validation("POST","password2",["require"=>true],"Parola alanı boş veya geçersiz");
                    Request::validation("POST","birthday",["require"=>true],"Doğum tarihi alanı boş veya geçersiz");
                    Request::validation("POST","acente_id",["require"=>true],"Acente alanı boş veya geçersiz");
                    if(Request::post("password1") != Request::post("password2")){
                        return Response::soap("fail","INVALID_FIELD",[
                            "fieldName" => "password2",
                            "text" => "Parolalar eşleşmiyor"
                        ]);
                    };
                    $user = new User();
                    if($user->isUsableMail(Request::post("email")))
                    {
                        return Response::soap("fail","ALREADYEXISTS",["text"=>"E-Mail mevcut lütfen başka bir adres deneyiniz"]);
                    }
                    if(Request::file("image")){
                        $newName = Request::acceptFile("image");
                    }else $newName = "";
                    $user = new User();
                    if($user->createPersonel(
                        Request::post("name"),
                        Request::post("surname"),
                        Request::post("email"),
                        $newName,
                        Request::post("password1"),
                        Request::post("birthday"),
                        Request::post("acente_id")
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