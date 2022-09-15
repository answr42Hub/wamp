<?php

namespace controllers;

class storecontroller
{
    function home() {
        if(isset($_SESSION["user"])) {
            session_regenerate_id(true);//a regenerer tous les X min.
            require __DIR__ . "/../views/store/connected_home.php";
            die();
        }
        require __DIR__ . "/../views/store/home.php";
    }
}