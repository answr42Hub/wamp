<?php
//Checks if we are in localhost, if so -> http else -> https
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('Location: ' . $location);
    exit;
}

require('./vendor/autoload.php');

const HOME_PATH = '/1409427';
const HOST = 'localhost';
const PORT = '3306';
const DB_NAME = 'n46jolinfocegepl_1409427';
const DB_USER = 'n46jolinfocegepl_1409427';
const DB_PASSWORD = '<3RickAstley';


session_name("SessionCookie");
session_set_cookie_params(0, HOME_PATH, null, false, true);

session_start();

$uri = $_SERVER['REQUEST_URI'];

$uri = substr($uri, strlen(HOME_PATH) + 1);

$parts = explode('/', $uri);

if(count($parts) == 1 && $parts[0] == '') {
    $controller = new controllers\storecontroller();
    $controller->home();

}
elseif ($parts[0] == 'users') {
    $controller = new controllers\usercontroller();
    if($parts[1] == 'login') {

        $controller->login();
    }
    elseif($parts[1] == 'register') {
        $controller->register();
    }
    elseif($parts[1] == 'disconnect') {
        $controller->disconnect();
    }
    elseif($parts[1] == 'forgot') {
        $controller->forgot();
    }
    elseif(substr($parts[1], 0, 10) == 'changepass') {
        if(strlen($parts[1]) > 10) {
            $controller->changeForgot();
            die();
        }
        $controller->changePass();
    }
    elseif($parts[1] == 'profile') {
        $controller->profile();
    }
    elseif(substr($parts[1], 0, 6) == 'verify') {
        $controller->verify();
    }
    else {
        $controller = new controllers\usercontroller();
        $controller->error();
    }
}
elseif ($parts[0] == 'store') {
    $controller = new controllers\storecontroller();
    if($parts[1] == 'home') {
        $controller->home();
    }
    elseif($parts[1] == 'add') {
        $controller->add();
    }
    elseif(substr($parts[1], 0, 4) == 'edit') {
        $controller->edit();
    }
    elseif(substr($parts[1], 0, 3) == 'buy') {
        $controller->buy();
    }
    elseif(substr($parts[1], 0, 6) == 'refund') {
        $controller->refund();
    }
    else {
        $controller = new controllers\usercontroller();
        $controller->error();
    }
}
else {
    $controller = new controllers\usercontroller();
    $controller->error();
}