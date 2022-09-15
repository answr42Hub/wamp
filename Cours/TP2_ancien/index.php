<?php
/*Checks if we are in localhost, if so -> http else -> https
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('Location: ' . $location);
    exit;
}
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('./vendor/autoload.php');

const HOME_PATH = '';
const HOST = '172.19.0.2';
const PORT = '3306';
const DB_NAME = 'test';
const DB_USER = 'root';
const DB_PASSWORD = 'root';


session_name("SessionCookie");
session_set_cookie_params(0, HOME_PATH, null, false, true);

session_start();

$uri = $_SERVER['REQUEST_URI'];

$uri = substr($uri, strlen(HOME_PATH) + 1);
$parts = explode('/', $uri);

if(count($parts) == 1 && $parts[0] == HOME_PATH) {
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
    elseif($parts[1] == 'changepass') {
        $controller->changePass();
    }
    elseif($parts[1] == 'profile') {
        $controller->profile();
    }
    else {
        $controller = new controllers\usercontroller();
        $controller->error();
    }
}
elseif ($parts[0] == 'store') {
    $controller = new controllers\storecontroller();
    if($parts[1] == 'home' && isset($_SESSION['user'])) {
        $controller->home();
    }
    else {
        $controller = new controllers\usercontroller();
        $controller->login();
    }
}
else {
    $controller = new controllers\usercontroller();
    $controller->error();
}