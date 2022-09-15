<?php

namespace controllers;

use repositories\userrepository;

class apicontroller {
    function userexist() {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];

            $userRepo = new userrepository();
            $user = $userRepo->getOne($username);
            if($user) {
                http_response_code(200);
            }
            else {
                http_response_code(400);
            }
        }
    }
}