<?php

namespace controllers;
class usercontroller {

    function login() {
        if(isset($_SESSION['csrf'])) {
            if (isset($_POST['username']) && isset($_POST['csrf']) && $_POST['csrf'] == $_SESSION['csrf']) {

                $username = $_POST['username'];
                $password = $_POST['password'];
                $userRepo = new \repositories\userrepository();
                $user = $userRepo->getOne($username);

                if ($user) {//&& !$userRepo->getStatus()
                    if (password_verify($password, $user->password)) {

                        $_SESSION['user'] = $user;
                        //envoyer un email de confirmation
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
                elseif($_POST['username'] == '') {
                    $errorMsg = 'Etrez un nom d\'utilisateur !';
                }
                else {
                    $errorMsg = 'Le mot de passe ou le nom d\'utilisateur est incorrect !';
                }
            }
        }

        $_SESSION['csrf'] = hash("sha256", bin2hex(random_bytes(16)) . "login");
        require __DIR__ . '/../views/users/login.php';
    }

    function disconnect() {
        unset($_SESSION['user']);
        session_destroy();
        $_SESSION = [];
        header('Location: ' . HOME_PATH . '/users/login');
    }

    function register() {
        if(isset($_SESSION['csrf'])) {
            if(isset($_POST['username']) && !$_POST['username'] == '' && isset($_POST['csrf']) && $_POST['csrf'] == $_SESSION['csrf']) {
                $_SESSION['csrf_count'] = ($_SESSION['csrf_count'] ?? 0) + 1;
                $username = $_POST['username'];
                $userRepo = new \repositories\userrepository();
                $user = $userRepo->getOne($username);
                if(!$user && !$userRepo->getEmail($user->email)) {
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
                            $email = $_POST['email'];
                            $user = new \models\users();
                            $user->username = $username;
                            $user->email = $email;
                            $user->password = password_hash($password, PASSWORD_DEFAULT);

                            $userRepo = new \repositories\userrepository();
                            $userRepo->insert($user);
                            $successMsg = "Votre compte a été créé ! Un e-mail de confirmation vous a été envoyé.";

                            $subject = "HTML email";

                            $message = "
                                        <html>
                                        <head>
                                        <title>HTML email</title>
                                        </head>
                                        <body>
                                        <p>Confirmez votre e-mail en cliquant </p><a href='http://172.19.0.1:81/users/login'>ici</a>
                                        <table>
                                        <tr>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        </tr>
                                        <tr>
                                        <td>John</td>
                                        <td>Doe</td>
                                        </tr>
                                        </table>
                                        </body>
                                        </html>
                                        ";

                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

                            mail($email,$subject,$message,$headers);
                        }
                        else {
                            $errorMsg = 'Assurez-vous que les deux mots de passes soient identiques !';
                        }
                    }
                }
                else {
                    $successMsg = "Votre compte a été créé ! Un e-mail de confirmation vous a été envoyé.";
                    //envoyer un email qui redirige vers le login au lieu de la confirmation d'email.
                    die();
                }
            }
        }

        $_SESSION['csrf'] = hash("sha256", bin2hex(random_bytes(16)) . "register");
        require __DIR__ . '/../views/users/register.php';
    }

    function forgot() {
        if (isset($_POST['email'])) {
            if(!$_POST['email'] == '') {
                $email = $_POST['email'];
                //$userRepo->sendEmail($email); a implementer
                $successMsg = "Un courriel a été envoyé à l'adresse " . $email . ", cliquez sur le lien reçu pour activer votre compte.";
            }
            else
                $errorMsg = "Entrez un e-mail !";
        }

        require __DIR__ . '/../views/users/forgot_password.php';
    }

    function changePass() {
        if(isset($_POST['oldpass']) && isset($_POST['newpass']) && isset($_POST['newpassconf'])) {

            $password = $_POST['newpass'];
            $oldpass = $_POST['oldpass'];
            $user = $_SESSION['user'];
            if(password_verify($oldpass, $user->password)) {
                if (!$password == '') {
                    if (!$_POST['newpassconf'] == '') {
                        $passconf = $_POST['newpassconf'];
                    } else {
                        $errorMsg = 'Confirmez votre mot de passe !';
                        die();
                    }

                } else {
                    $errorMsg = 'Entrez un mot de passe !';
                    die();
                }

                if ($password == $passconf) {
                    //calls updatePass() with right user
                    $successMsg = "Votre mot de passe a été modifé !";
                } else {
                    $errorMsg = 'Assurez-vous que les deux mots de passes soient identiques !';
                }
            }
            else{
                $errorMsg = 'Assurez-vous de bien entrer votre ancien mot de passe !';
            }
        }
        require __DIR__ . '/../views/users/change_password.php';
    }

    function profile() {
        if(isset($_SESSION['user'])) {
            require __DIR__ . '/../views/users/profile.php';
        }
        else
            $this->error();
    }

    function error() {
        require __DIR__ . '/../views/404.php';
    }
}