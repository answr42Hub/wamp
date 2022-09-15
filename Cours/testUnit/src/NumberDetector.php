<?php

class NumberDetector {

    private NumberRepository $repo;

    public function __construct(?NumberDetector $repo = null) {

    }

    public function addIfNotExist(int $number): bool {
        $repo = new NumberRepository();
        if (!$this->inArray($number, $repo->get())) {
            $repo->add($number);
            return true;
        }
        else {
            $this->afficher_erreur();
            return false;
        }
    }
    public function tata(int $nb) {
        if($nb == 0) {
            $this->afficher_erreur();
        }
        else {
            echo 'Ca marche';
        }
    }

    public function afficher_erreur() {
        echo 'ca plante';
    }


    public function inArray(int $number, array $array): bool {
        foreach ($array as $n) {
            if ($n == $number) {
                return true;
            }
        }
        return false;
    }
}