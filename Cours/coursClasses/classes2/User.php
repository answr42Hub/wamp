<?php


class User {
    use HasCredentials, Connectable {
        Connectable::login insteadof HasCredentials;
        Connectable::login as login2;
    }
}

trait HasCredentials {
    public string $username;
    public string $password;
    public function login(string $username, string $password): bool {
        return $this->username == $username && $this->password == $password;
    }
}

trait Connectable {
    public function login(string $username, string $password): bool {
        return $this->username == $username && $this->password == $password;
    }
}

$user = new User();
$user->password = 'admin';
$user->username = 'admin';
$ok = $user->login('admin2', 'admin');
var_dump($ok);