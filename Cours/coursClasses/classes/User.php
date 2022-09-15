<?php

class User
{
    public const IS_ADMIN = false;
    public string $username;
    public string $password;

    /*
    function __construct(?string $username = null, ?string $password = null) {
        if(is_null($username)) {
            $this->username = 'admin';
        }
        else {
            $this->username = $username;
        }
        $this->password = $password ?? 'admin';
        //self::IS_ADMIN comme this maispour ce qui est static
    }
    */

    public function getUsername(): string {
        return $this->username;
    }

    public function setUsername(string $username): void {
        $this->username = $username;
    }

    public function isAdmin(): void {
        echo self::IS_ADMIN ? 'Admin' : 'Plebe';
    }
}