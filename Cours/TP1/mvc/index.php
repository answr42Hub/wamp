<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register();

const HOME_PATH = '/1409427';
const HOST = 'localhost';
const PORT = '3306';
const DB_NAME = 'n46jolinfocegepl_1409427';
const DB_USER = 'n46jolinfocegepl_1409427';
const DB_PASSWORD = '<3RickAstley';

session_start();

$uri = $_SERVER['REQUEST_URI'];

$uri = substr($uri, strlen(HOME_PATH) + 1);
$parts = explode('/', $uri);


if(count($parts) == 1) {
    $controller = new \controllers\usercontroller();
    $controller->login();
}
elseif($parts[0] == 'users') {
    $controller = new \controllers\usercontroller();
    if($parts[1] == 'login') {
        $controller->login();
    }
    elseif($parts[1] == 'register') {
        $controller->register();
    }
    elseif($parts[1] == 'disconnect') {
        $controller->disconnect();
    }
    else {
        $controller = new \controllers\usercontroller();
        $controller->error();
    }
}
elseif($parts[0] == 'game') {
    $controller = new \controllers\gamecontroller();
    if($parts[1] == 'menu') {
        $controller->gameMenu();
    }
    elseif(str_starts_with($parts[1], 'floor')) {
        $controller->doorSelect();
    }
    elseif(str_starts_with($parts[1], 'next')) {
        $controller->nextFloor();
    }
    elseif($parts[1] == 'fight') {
        $controller->fight();
    }
    elseif ($parts[1] == 'attack') {
        $controller = new \controllers\apicontroller();
        $controller->attack();
    }
    elseif ($parts[1] == 'special') {
        $controller = new \controllers\apicontroller();
        $controller->specialAttack();
    }
    elseif ($parts[1] == 'passive') {
        $controller = new \controllers\apicontroller();
        $controller->passivePower();
    }
    elseif ($parts[1] == 'handle') {
        $controller = new \controllers\apicontroller();
        $controller->handleAttack();
    }
    elseif ($parts[1] == 'summery') {
        $controller->summery();
    }
    else {
        $controller = new \controllers\usercontroller();
        $controller->error();
    }
}
else {
    $controller = new \controllers\usercontroller();
    $controller->error();
}


