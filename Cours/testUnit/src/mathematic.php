<?php

class mathematic {
    function add($nb1, $nb2): int {
        return $nb1 + $nb2;
    }
    function divide($nb1, $nb2): int {
        if($nb2 == 0) {
            throw new Exception();
        }
        return $nb1 / $nb2;
    }
}