<?php

namespace repositories;

class baserepository {
    public $bd;

    public function __construct() {
        $this->bd = new \PDO('mysql:dbname=' . DB_NAME . ';host=' . HOST . ';port=' . PORT,
            DB_USER, DB_PASSWORD);

        $result = $this->bd->query("SHOW TABLES LIKE 'users'");
        if(!$result->rowCount())
            $this->bd->query("CREATE TABLE `" . DB_NAME . "`.`users` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `username` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `exp` INT UNSIGNED NOT NULL DEFAULT '1' , PRIMARY KEY (`id`)) ENGINE = InnoDB");

        $result = $this->bd->query("SHOW TABLES LIKE 'monsters'");
        if(!$result->rowCount()) {
            $this->bd->query("CREATE TABLE `" . DB_NAME . "`.`monsters` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `maxhp` INT UNSIGNED NOT NULL , `force` INT UNSIGNED NOT NULL , `def` INT UNSIGNED NOT NULL , `img` VARCHAR(255) NOT NULL, `isboss` BOOLEAN NOT NULL DEFAULT FALSE , PRIMARY KEY (`id`)) ENGINE = InnoDB");

            $this->bd->query("INSERT INTO `monsters` (`name`, `maxhp`, `force`, `def`, `img`, `isboss`) VALUES ('Stanley Hudson', '10', '5', '1', 'stanley_hudson.png', '0')");

            $this->bd->query("INSERT INTO `monsters` (`name`, `maxhp`, `force`, `def`, `img`, `isboss`) VALUES ('Robert California', '80', '20', '10', 'robert_california.png', '1')");

            $this->bd->query("INSERT INTO `monsters` (`name`, `maxhp`, `force`, `def`, `img`, `isboss`) VALUES ('Charles Miner', '25', '11', '6', 'charles_miner.png', '0')");

            $this->bd->query("INSERT INTO `monsters` (`name`, `maxhp`, `force`, `def`, `img`, `isboss`) VALUES ('Prison Mike', '15', '4', '4', 'prison_mike.png', '0')");

            $this->bd->query("INSERT INTO `monsters` (`name`, `maxhp`, `force`, `def`, `img`, `isboss`) VALUES ('Jan Levenson', '20', '10', '6', 'jan_levenson.png', '0')");
        }
    }
}