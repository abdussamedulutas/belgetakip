<?php
    include("Model/Acente.php");
    include("Model/User.php");
    include("Model/Notification.php");

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
            exit;
        };
    }
    function useOnlyAdminAuthGET()
    {
        global $workspaceDir;
        if(!isset($_SESSION["user"]) || (isset($_SESSION["user"]) && $_SESSION["role"] != "admin"))
        {
            Response::tempRedirect("$workspaceDir/login");
            exit;
        }
    };
    function useOnlyAdminPOST()
    {
        global $workspaceDir;
        if(!isset($_SESSION["user"]) || (isset($_SESSION["user"]) && $_SESSION["role"] != "admin"))
        {
            SendStatus(404);
            exit;
        };
    }

    $main = new class extends Controller{
        public function viewAcente()
        {
            useOnlyAdminAuthGET();
            global $workspaceDir;

            $acente = new Acente();
            $acenteler = $acente->getAll();

            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("acente/acenteler",(object)[
                "userPanelLink"=>$userPanelLink,
                "acenteler"=>$acenteler
            ]);
        }
        public function viewPersonel()
        {
            useOnlyAdminAuthGET();
            global $workspaceDir;

            $acente = new User();
            $personeller = $acente->getPersonelAll();

            $userPanelLink = $workspaceDir."/".$_SESSION["name"];
            Response::view("acente/personeller",(object)[
                "userPanelLink"=>$userPanelLink,
                "personeller"=>$personeller
            ]);
        }
        public function post()
        {
            useOnlyAdminPOST();
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
                    if($user->createPersonel(
                        Request::post("name"),
                        Request::post("surname"),
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