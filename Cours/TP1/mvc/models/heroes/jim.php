<?php

namespace models\heroes;
use models;
class jim extends hero
{
    public function __construct(int $exp){
        $this->exp = $exp;
        $this->name = 'Jim Halpert';
        $this->maxhp = 60 + (int)($this->exp/10);
        $this->currenthp = $this->maxhp;
        $this->force = 10 + (int)($this->exp/10);
        $this->def = 5 + (int)($this->exp/10);
        $this->img = "jim_halpert.png";
        $this->nb_spec_left = 4;
        $this->spec_attack = 0;
        $this->pass_pwr = 0;
        $this->attack_msg = "Jim prank l'ennemi ! ";
        $this->spec_pwr_msg = "Jim met les choses de son ennemi dans le JEll-O !";
        $this->pass_pwr_msg = "Jim trouve le moyen de fuir le combat ! ";
        $this->passiveused = false;
    }
}