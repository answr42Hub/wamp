<?php

namespace controllers;
class usercontroller {

    function login() {


        if (isset($_POST['username']) && !$_POST['username'] == '') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userRepo = new \repositories\userrepository();
            $user = $userRepo->getOne($username);
            if ($user) {
                if (password_verify($password, $user->password)) {
                    $_SESSION['user'] = $user;
                    header('location: ' . HOME_PATH . '/game/menu');
                }
                elseif($password == '') {
                    $errorMsg = 'Entrez un mot de passe !';
                }
                else {
                    $errorMsg = 'Le mot de passe est incorrect !';
                }
            }
            else {
                $errorMsg = 'Il n\'y a pas d\'utilisateur à ce nom !';
            }
        }
        require __DIR__ . '/../views/users/login.php';

    }

    function disconnect() {
        session_destroy();
        unset($_SESSION);
        header('Location: ' . HOME_PATH . '/users/login');
    }

    function register() {

        if(isset($_POST['username']) && !$_POST['username'] == '') {
            $username = $_POST['username'];
            $userRepo = new \repositories\userrepository();
            $user = $userRepo->getOne($username);
            if(!$user) {
                if(isset($_POST['password']) && isset($_POST['passconf'])) {
                    if(!$_POST['password'] == '') {
                        $password = $_POST['password'];
                        if(!$_POST['passconf'] == '') {
                            $passconf = $_POST['passconf'];
                        }
                        else
                            $errorMsg = 'Confirmez votre mot de passe !';
                    }
                    else
                        $errorMsg = 'Entrez un mot de passe !';

                    if($password == $passconf) {
                        $user = new \models\users();
                        $user->username = $username;
                        $user->password = password_hash($password, PASSWORD_DEFAULT);

                        $userRepo = new \repositories\userrepository();
                        $userRepo->insert($user);
                        $this->login();
                    }
                    else {
                        $errorMsg = 'Assurez-vous que les deux mots de passes soient identiques !';
                    }
                }
            }
            else {
                $errorMsg = "Ce nom d'utilisateur existe déjà !";
            }
        }
        require __DIR__ . '/../views/users/register.php';
    }

    function error() {
        require __DIR__ . '/../views/users/404.php';
    }
}