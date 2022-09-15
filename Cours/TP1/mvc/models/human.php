<?php

namespace models;

class human {
    public string $name;
    public int $maxhp;
    public int $currenthp;
    public int $force;
    public int $def;
    public string $img;

    function __construct() {
        $this->currenthp = $this->maxhp;
    }

}