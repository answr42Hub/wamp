<?php

class usercontroller {

    private userrepository $repo;

    public function __construct(userrepository $repo = null) {
        $this->repo = is_null($repo) ? new userrepository() : $repo;
    }

    public function list() {

        if($this->repo->count() > 0) {
            return 'ok';
        }
        else {
            $this->afficher_erreur();
        }
    }

    public function toto(int $nb) {
        if($nb == 0) {
            $this->afficher_erreur();
        }
        else {
            echo 'bla';
        }
    }

    public function afficher_erreur() {
        echo 'ca plante';
    }
}