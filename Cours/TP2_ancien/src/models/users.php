<?php

namespace models;

class users {
    public int $id;
    public string $username;
    public string $password;
    public string $email;
    public bool $status;
    public int $expstatus;
    public string $remember;
    public int $expremember;
}