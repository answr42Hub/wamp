<?php

namespace controllers;
use models\users;
use repositories\storerepository;
use repositories\userrepository;

class usercontroller {

    function login() {
        if(isset($_SESSION['csrf'])) {
            if(isset($_POST['username']) && isset($_POST['csrf'])) {
                if($_POST['csrf'] == $_SESSION['csrf']) {
                    $username = $_POST['username'];
                    $password = $_POST['password'];
                    $userRepo = new \repositories\userrepository();
                    $user = $userRepo->getOne($username);

                    if ($user) {
                        if($userRepo->getStatus($user->username)) {
                            if (password_verify($password, $user->password)) {
                                if(isset($_POST['remember'])) {
                                    $token = hash("sha256", bin2hex(random_bytes(16)) . "remember");
                                    $_COOKIE['remember'] = $token;
                                    $userRepo->setRemember($user->id, $token);
                                }
                                $_SESSION['user'] = $user;
                                header('location: ' . HOME_PATH . '/store/home');
                                die();
                            }
                            elseif($password == '') {
                                $errorMsg = 'Entrez un mot de passe !';
                            }
                            else {
                                $errorMsg = 'Le mot de passe ou le nom d\'utilisateur est incorrect !';
                            }
                        }
                        else {
                            $errorMsg = 'Le mot de passe ou le nom d\'utilisateur est incorrect !';
                        }
                    }
                    elseif($_POST['username'] == '') {
                        $errorMsg = 'Etrez un nom d\'utilisateur !';
                    }
                    else {
                        $errorMsg = 'Le mot de passe ou le nom d\'utilisateur est incorrect !';
                    }
                }
                else {
                    $this->error();
                    die();
                }
            }
        }

        $_SESSION['csrf'] = hash("sha256", bin2hex(random_bytes(16)) . "login");
        require __DIR__ . '/../views/users/login.php';
    }

    function disconnect() {
        $user = $_SESSION['user'];
        $userRepo = new userrepository();
        $userRepo->forgetMe($user->id);
        $_SESSION['user'] = '';
        unset($_SESSION['user']);
        session_destroy();
        $_SESSION = [];
        $_COOKIE['remember'] = '';
        unset($_COOKIE['remember']);
        header('Location: ' . HOME_PATH . '/users/login');
    }

    function register() {
        if(isset($_SESSION['csrf'])) {
            if(isset($_POST['username'])) {
                if(!$_POST['username'] == '') {
                    if($_POST['csrf'] == $_SESSION['csrf']) {
                        $username = $_POST['username'];
                        $userRepo = new \repositories\userrepository();
                        if(isset($_POST['email']) && !$_POST['email'] == '') {
                            if(isset($_POST['password']) && isset($_POST['passconf'])) {
                                if(!$_POST['password'] == '') {
                                    $password = $_POST['password'];
                                    if(!$_POST['passconf'] == '') {
                                        $passconf = $_POST['passconf'];
                                        if($password == $passconf) {
                                            $email = $_POST['email'];
                                            $user = new \models\users();
                                            $user->username = $username;
                                            $user->email = $email;
                                            $user->password = password_hash($password, PASSWORD_DEFAULT);

                                            $subject = "Confirmer e-mail";

                                            $existingUserEmail = new \models\users();

                                            $existingUserEmail = $userRepo->getOne($email);
                                            $existingUsername = $userRepo->getOne($username);

                                            if(!$existingUserEmail && !$existingUsername) {
                                                $token = hash('sha256', random_bytes(16));
                                                $user->token = $token;
                                                $userRepo->insert($user);
                                                $url = "https://420n46.jolinfo.cegep-lanaudiere.qc.ca/1409427/users/verify?token=" . $token;
                                                $message = "Pour confirmer votre compte, cliquez ";
                                                $this->sendEmail($user->username, $email, $url, $subject, $message);
                                            }
                                            else {
                                                $subject = "Compte existant.";
                                                $url = "https://420n46.jolinfo.cegep-lanaudiere.qc.ca/1409427/users/login";
                                                $message = "Votre compte est déjà existant, pour vous connecter, cliquez ";
                                                $this->sendEmail(($existingUsername) ? $existingUsername->username : $user->username,
                                                    ($existingUsername) ? $existingUsername->email : $email, $url, $subject, $message);
                                            }
                                            $_SESSION['msg'] = "Votre compte a été créé ! Un e-mail de confirmation vous a été envoyé.";
                                            header('location: ' . HOME_PATH . '/users/login');
                                        }
                                        else {
                                            $errorMsg = 'Assurez-vous que les deux mots de passes soient identiques !';
                                        }
                                    }
                                    else {
                                        $errorMsg = 'Confirmez votre mot de passe !';
                                    }
                                }
                                else {
                                    $errorMsg = 'Entrez un mot de passe !';
                                }
                            }
                        }
                        else {
                            $errorMsg = "Entrer un e-mail.";
                        }
                    }
                    else {
                        $this->error();
                        die();
                    }
                }
                else {
                    $errorMsg = "Entrez un Nom d'utilisateur !";
                }
            }
        }

        $_SESSION['csrf'] = hash("sha256", bin2hex(random_bytes(16)) . "register");
        require __DIR__ . '/../views/users/register.php';
    }

    function changeForgot() {

        if(isset($_GET['token'])) {
            $userRepo = new userrepository();
            $token = $_GET['token'];
            $user = $userRepo->getOne($token);

            if($user->exptoken - time() <= 0) {
                $expire = "Vous avez dépassé le temps aloué. Veuillez réessayer !";
            }
        }
        if(isset($_SESSION['csrf'])) {
            if(isset($_GET['token']) && isset($_POST['newpass']) && isset($_POST['newpassconf'])) {
                if($_POST['csrf'] == $_SESSION['csrf']) {
                    $token = $_GET['token'];
                    $password = $_POST['newpass'];
                    $passconf = $_POST['newpassconf'];
                    $userRepo = new userrepository();
                    if (!$password == '') {
                        if (!$passconf == '') {
                            if($passconf == $password) {
                                $password = password_hash($password, PASSWORD_DEFAULT);
                                $userRepo->updatePass($token, $password);
                                $successMsg = "Mot de passe changé avec succès !";
                            }
                            else {
                                $errorMsg = 'Erreur dans la confirmation de mot de passe !';
                            }
                        }
                        else {
                            $errorMsg = 'Confirmez votre mot de passe !';
                        }

                    } else {
                        $errorMsg = 'Entrez un mot de passe !';
                    }
                }
                else {
                    $this->error();
                    die();
                }
            }
        }

        $_SESSION['csrf'] = hash("sha256", bin2hex(random_bytes(16)) . "changeforgot");
        require __DIR__ . '/../views/users/change_forgot.php';
    }

    function forgot() {

        if(isset($_POST['csrf'])) {
            $userRepo = new userrepository();
            if(isset($_POST['email'])) {
                if($_POST['csrf'] == $_SESSION['csrf']) {
                    if(!$_POST['email'] == '') {

                        $email = $_POST['email'];
                        $userRepo->unconfirm($email);
                        $user = new users();
                        $user = $userRepo->getOne($email);
                        $url = "https://420n46.jolinfo.cegep-lanaudiere.qc.ca/1409427/users/changepass?token=" . $user->token;
                        $this->sendEmail($user->username, $email, $url, "Chager le mot de passe", "Pour changer le mot de passe, cliquez ");
                        $successMsg = "Un courriel a été envoyé, cliquez sur le lien reçu pour changer le mot de passe.";
                    }
                    else
                        $errorMsg = "Entrez un e-mail !";
                }
                else {
                    $this->error();
                    die();
                }
            }
        }

        $_SESSION['csrf'] = hash("sha256", bin2hex(random_bytes(16)) . "forgot");
        require __DIR__ . '/../views/users/forgot_password.php';
    }

    function changePass() {
        if(isset($_SESSION['csrf'])) {
            if(isset($_POST['oldpass']) && isset($_POST['newpass']) && isset($_POST['newpassconf'])) {
                if($_POST['csrf'] == $_SESSION['csrf']) {
                    $password = $_POST['newpass'];
                    $passconf = $_POST['newpassconf'];
                    $oldpass = $_POST['oldpass'];
                    $user = $_SESSION['user'];
                    $userRepo = new userrepository();
                    if(password_verify($oldpass, $user->password)) {
                        if(!$password == '') {
                            if(!$passconf == '') {
                                if($password == $passconf) {
                                    $password = password_hash($password, PASSWORD_DEFAULT);
                                    $userRepo->updatePass($user->email, $password);
                                    $successMsg = "Votre mot de passe a été modifé !";
                                }
                                else {
                                    $errorMsg = 'Assurez-vous que les deux mots de passes soient identiques !';
                                }
                            }
                            else {
                                $errorMsg = 'Confirmez votre mot de passe !';
                            }
                        }
                        else {
                            $errorMsg = 'Entrez un mot de passe !';
                        }
                    }
                    else{
                        $errorMsg = 'Assurez-vous de bien entrer votre ancien mot de passe !';
                    }
                }
                else {
                    $this->error();
                    die();
                }
            }
        }

        $_SESSION['csrf'] = hash("sha256", bin2hex(random_bytes(16)) . "changepass");
        require __DIR__ . '/../views/users/change_password.php';
    }

    function verify() {
        if(isset($_GET['token'])) {
            $token = $_GET['token'];
            $userRepo = new userrepository();
            if($userRepo->confirm($token))
                $successMsg = "Votre compte est prêt !";
            else
                $errorMsg = "Quelque chose n'a pas fonctionné, cliquez sur renvoyer.";
        }
        require __DIR__ . "/../views/users/verify.php";
    }

    function profile() {
        if(isset($_SESSION['user']) && isset($_SESSION)) {
            unset($_SESSION['articles']);
            unset($_SESSION['purchases']);
            $user = $_SESSION['user'];
            $storeRepo = new storerepository();
            $articles = $storeRepo->getUserArticles($user->id);
            $mypurchases = $storeRepo->getMyPurchases($user->id);
            if($articles)
                $_SESSION['articles'] = $articles;
            if($mypurchases)
                $_SESSION['purchases'] = $mypurchases;

            require __DIR__ . '/../views/users/profile.php';
        }
        else
            $this->error();
    }

    private function sendEmail($username, $email, $url, $subject, $message) {
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $coremess = "
                                        <html>
                                        <head>
                                        <title>E-commerce</title>
                                        </head>
                                        <body>
                                        <h1>Bonjour " . $username . "</h1>
                                        <p>" . $message . "<a href='" . $url . "'>ici</a></p>
                                        </body>
                                        </html>
                                        ";

        mail($email,$subject,$coremess,$headers);
    }

    function error() {
        require __DIR__ . '/../views/404.php';
    }
}