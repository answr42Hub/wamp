<?php


class Admin extends User {
    public const IS_ADMIN = true;

    function __construct(?string $username = null, ?string $password = null) {
        parent::__construct($username, $password);
    }
}