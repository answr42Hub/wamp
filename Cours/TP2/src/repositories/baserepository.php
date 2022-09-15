<?php

namespace repositories;

class baserepository {
    public $bd;

    public function __construct() {
        $this->bd = new \PDO('mysql:dbname=' . DB_NAME . ';host=' . HOST . ';port=' . PORT,
            DB_USER, DB_PASSWORD);

        $this->bd->query("CREATE TABLE IF NOT EXISTS `users` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
            `username` VARCHAR(255) NOT NULL ,
            `email` VARCHAR(255) NOT NULL ,
            `password` VARCHAR(255) NOT NULL,
            `status` TINYINT(1) DEFAULT 0 NOT NULL ,
            `token` VARCHAR(255) DEFAULT '',
            `exptoken` BIGINT UNSIGNED DEFAULT 0 NOT NULL ,
            `remember` VARCHAR(255) NULL DEFAULT NULL , 
            `expremember` BIGINT UNSIGNED DEFAULT 0 NOT NULL ,
            PRIMARY KEY (`id`)) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4");

        $this->bd->query("CREATE TABLE IF NOT EXISTS `articles` (
            `id` int unsigned NOT NULL AUTO_INCREMENT,
            `name` varchar(40) NOT NULL,
            `desc` varchar(255) NOT NULL,
            `price` double unsigned NOT NULL DEFAULT '2.00',
            `image` varchar(255) NOT NULL,
            `creationdate` int unsigned NOT NULL,
            `seller` int unsigned NOT NULL,
            `sold` tinyint unsigned NOT NULL DEFAULT '0',
            PRIMARY KEY (`id`),
            FOREIGN KEY (`seller`) REFERENCES `users` (`id`) ON DELETE CASCADE )");

        $this->bd->query("CREATE TABLE IF NOT EXISTS `transactions` (
            `id` int unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `paymentid` varchar(255) NOT NULL,
            `numfact` int unsigned NOT NULL,
            `usercustomer` int unsigned NOT NULL,
            `userseller` int unsigned NOT NULL,
            `article` int unsigned NOT NULL,
            `price` double unsigned NOT NULL,
            `status` tinyint unsigned NOT NULL,
            `datepayment` int unsigned NOT NULL,
            FOREIGN KEY (`usercustomer`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
            FOREIGN KEY (`userseller`) REFERENCES `users` (`id`) ON DELETE NO ACTION,
            FOREIGN KEY (`article`) REFERENCES `articles` (`id`) ON DELETE NO ACTION)");
    }
}