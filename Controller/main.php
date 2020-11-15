<?php
    $main = new class extends Controller{
        public function getView()
        {
            if(isset($_SESSION["user"]))
            {
                Response::view("main");
            }else Response::tempRedirect("/login");
        }
        public function redirectpanel()
        {
            $safe = safeName($_SESSION["name"]);
            Response::tempRedirect("/$safe/panel");
        }
    };