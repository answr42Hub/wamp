<?php

namespace repositories;

class baserepository {
    public $bd;

    public function __construct() {
        $this->bd = new \PDO('mysql:dbname=' . DB_NAME . ';host=' . HOST . ';port=' . PORT,
            DB_USER, DB_PASSWORD);

            $this->bd->query("CREATE TABLE IF NOT EXIST `" . DB_NAME . "`.`users` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
            `username` VARCHAR(255) NOT NULL , `email` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL,
            `status` TINYINT(1) DEFAULT 0 NOT NULL , `expstatus` INT UNSIGNED DEFAULT 0 NOT NULL , `remember` VARCHAR(255) DEFAULT NULL , 
            `expremember` INT UNSIGNED DEFAULT 0 NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB");

    }
}