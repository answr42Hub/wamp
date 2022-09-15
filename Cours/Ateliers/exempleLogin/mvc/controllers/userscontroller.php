<?php

namespace controllers;

class userscontroller {
    function login() {
        require __DIR__ . '/../models/users.php';
        require __DIR__ . '/../repositories/userrepository.php';

        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userRepo = new \repositories\userrepository();
            $user = $userRepo->getOne($username);
            if ($user) {
                if (password_verify($password, $user->password)) {
                    echo 'Login réussi';
                }
                else {
                    echo 'Username existe';
                }
            }
            else {
                $user = new \models\users();
                $user->username = $username;
                $user->password = $password;
                \models\users::insert($user);
            }
        }
        require __DIR__ . '/../views/users/login.php';

    }
}