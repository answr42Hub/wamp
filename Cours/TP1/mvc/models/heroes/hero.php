<?php

namespace models\heroes;

class hero extends \models\human
{
    public int $exp;
    public int $spec_attack;
    public int $nb_spec_left;
    public int $pass_pwr;
    public string $attack_msg;
    public string $spec_pwr_msg;
    public string $pass_pwr_msg;
    public bool $passiveused;
}