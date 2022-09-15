<?php

namespace models\heroes;
use models;
class michael extends hero
{
    public function __construct($exp){
        $this->exp = $exp;
        $this->name = 'Michael Scott';
        $this->maxhp = 80 + (int)($this->exp/10);
        $this->currenthp = $this->maxhp;
        $this->force = 12 + (int)($this->exp/10);
        $this->def = 7 + (int)($this->exp/10);
        $this->img = "michael_scott.png";
        $this->nb_spec_left = 4;
        $this->spec_attack = 0;
        $this->pass_pwr = 5;
        $this->attack_msg = "Michael raconte une blague douteuse ! ";
        $this->spec_pwr_msg = "Micheal crie THAT'S WHAT SHE SAID ! ";
        $this->pass_pwr_msg = "Michael prend un café ! ";
        $this->passiveused = false;
    }
}