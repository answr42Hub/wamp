<?php

namespace repositories;

class baserepository {
    public $bd;

    public function __construct() {
        $this->bd = new \PDO('mysql:dbname=test;host=172.25.0.2;port=3306',
            'root', 'root');
    }


}