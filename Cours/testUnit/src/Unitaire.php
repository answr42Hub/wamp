<?php
class Unitaire {
    public function fonctionATester($nombre1, $nombre2) {

        if (!$this->isInt($nombre1) || !$this->isInt($nombre2)) {
            throw new InvalidArgumentException();
        }
        else if ($nombre2 == 0) {
            throw new UnexpectedValueException();
        }
        else {
            return $nombre1 / $nombre2;
        }
    }

    public function isInt($nombre) {
        return intval($nombre) == $nombre;
    }
}