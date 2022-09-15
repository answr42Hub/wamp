<?php

session_start();

//page choix de classe
$_SESSION['perso'] = new Guerrier();
$_SESSION['monstre'] = new EtreVivant();

//page combat
$_SESSION['perso']->attaque();

/*
use Voiture\TiteVoiture;

apl_autoload_register();

$user = new User();
$admin = new Admin();

$user->isAdmin();
echo '<br>';
$admin->isAdmin();

$voiture = new TiteVoiture();

$voiture = new \Voiture\TiteVoiture();

$bd = new PDO('mysql:dbname=test;host=host.docker.internal; port=3306', 'root', 'root');
$query = $bd->prepare('SELECT * FROM users');
$query->execute();
$users = $query->fetchAll(PDO::FETCH_CLASS, 'User');
echo '<pre>';
print_r($users);
*/
