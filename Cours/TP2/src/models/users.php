<?php

namespace models;

class users {
    public int $id;
    public string $username;
    public string $password;
    public string $email;
    public bool $status;
    public $token;
    public int $exptoken;
    public $remember;
    public int $expremember;
}