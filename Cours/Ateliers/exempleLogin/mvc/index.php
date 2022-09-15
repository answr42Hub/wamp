<?php

header('Content-Security-Policy: frame-ancestors none');

spl_autoload_register();

const HOME_PATH = '/exempleLogin/mvc';
$uri = $_SERVER['REQUEST_URI'];

$uri = substr($uri, 1);
$parts = explode('/', $uri);
$controllerName = $parts[2] ?? 'home';
$actionName = $parts[3] ?? 'index';

if($controllerName == 'users') {

    $cName = '\controllers\userscontroller';
    $controller = new $cName();
    if($actionName == 'login') {
        $controller->login();
    }
}
elseif($controllerName == 'api'){
    $controller = new \controllers\apicontroller();
    $controller->userexist();
}
else {
    $controller = new \controllers\homecontroller();
    $controller->index();
}

