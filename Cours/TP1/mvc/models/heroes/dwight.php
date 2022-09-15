<?php

namespace models\heroes;
use models;
class dwight extends hero
{
    public function __construct(int $exp){
        $this->exp = $exp;
        $this->name = 'Dwight Shrute';
        $this->maxhp = 50 + (int)($this->exp/10);
        $this->currenthp = $this->maxhp;
        $this->force = 10 + (int)($this->exp/10);
        $this->def = 5 + (int)($this->exp/10);
        $this->img = "dwight_schrute.png";
        $this->nb_spec_left = 4;
        $this->spec_attack = 4*$this->force;
        $this->pass_pwr = 10;
        $this->attack_msg = "Dwight lance une betterave ! ";
        $this->spec_pwr_msg = "Dwight se déguise en belsnickel et quadruple sa force !";
        $this->pass_pwr_msg = "Dwight se guérit en mangeant une betterave ! ";
        $this->passiveused = false;
    }
}