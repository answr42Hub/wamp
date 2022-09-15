<?php

namespace models\heroes;
use models;
class kevin extends hero
{
    public function __construct(int $exp){
        $this->exp = $exp;
        $this->name = 'Kevin Melone';
        $this->maxhp = 30 + (int)($this->exp/10);
        $this->currenthp = $this->maxhp;
        $this->force = 5 + (int)($this->exp/10);
        $this->def = 2 + (int)($this->exp/10);
        $this->img = "kevin_melone.png";
        $this->nb_spec_left = 4;
        $this->spec_attack = 99999;
        $this->pass_pwr = 5;
        $this->attack_msg = "Une effluve de l'odeur des pieds de kevin se rend à l'ennemi ! ";
        $this->spec_pwr_msg = " Kevin renverse le chaudron de sa recette spéciale de chili sur le sol.";
        $this->pass_pwr_msg = "Kevin mange des cookie et se guérit.";
        $this->passiveused = false;
    }
}