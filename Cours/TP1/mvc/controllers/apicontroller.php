<?php

namespace controllers;

use repositories\monsterrepository;

class apicontroller
{

    function attack() {
        http_response_code(200);
        $endFight = false;
        $damage = 0;
        $force = 0;
        $def = 0;

        for($i = 0; $i < $_SESSION['hero']->force; $i++) {
            $dice = rand(1, 12);
            if($dice > 6) {
                $force++;
            }
        }
        for($i = 0; $i < $_SESSION['enemy']->def; $i++) {
            $dice = rand(1, 12);
            if($dice > 6) {
                $def++;
            }
        }

        if($force > $def) {
            $damage = $force - $def;
            if($_SESSION['enemy']->currenthp - $damage >= 0) {
                $_SESSION['enemy']->currenthp -= $damage;
                $message = $_SESSION['hero']->attack_msg;
                if($_SESSION['enemy']->currenthp == 0)
                    $endFight = true;
            }
            else {
                $endFight = true;
                $_SESSION['enemy']->currenthp = 0;
                $message = $_SESSION['hero']->attack_msg . " L'ennemi est mort !";
            }
        }
        else
            $message = "Attaque manquée";

        echo json_encode(["current" => $_SESSION['enemy']->currenthp, "damage" => $damage, "message" => $message, "endfight" => $endFight]);

    }
    function handleAttack() {
        http_response_code(200);

        $endFight = false;
        $damage = 0;
        $force = 0;
        $def = 0;
        for($i = 0; $i < $_SESSION['enemy']->force; $i++) {
            $dice = rand(1, 12);
            if($dice > 6) {
                $force++;
            }
        }
        for($i = 0; $i < $_SESSION['hero']->def; $i++) {
            $dice = rand(1, 12);
            if($dice > 6) {
                $def++;
            }
        }

        if($force > $def) {
            $damage = $force - $def;
            if($_SESSION['hero']->currenthp - $damage >= 0) {
                $_SESSION['hero']->currenthp -= $damage;
                $message = "L'ennemi attaque ! ";
            }
            else {
                $endFight = true;
                $_SESSION['hero']->currenthp = 0;
                $message = "L'ennemi vous a tué... ";
            }
        }
        else
            $message = "Attaque ennemi manquée";

        echo json_encode(["current" => $_SESSION['hero']->currenthp, "damage" => $damage, "message" => $message, "endfight" => $endFight]);
    }
    function specialAttack() {
        http_response_code(200);

        $damage = 0;
        $specleft = 0;
        $endFight = false;
        $message = "Il ne vous reste plus de pouvoir spécial..";

        if($_SESSION['hero']->nb_spec_left > 0) {
            switch($_SESSION['hero']->name) {
                case 'Michael Scott' : {
                    $_SESSION['hero']->nb_spec_left--;
                    $specleft = $_SESSION['hero']->nb_spec_left;
                    $damage = (int)($_SESSION['enemy']->currenthp/2);
                    if($_SESSION['enemy']->currenthp-$damage >= 0)
                        $_SESSION['enemy']->currenthp = (int)($_SESSION['enemy']->currenthp/2);
                    else {
                        $_SESSION['enemy']->currenthp = 0;
                        $endFight = true;
                    }
                    $message = $_SESSION['hero']->spec_pwr_msg;
                }
                    break;

                case 'Jim Halpert' : {
                    $_SESSION['hero']->nb_spec_left--;
                    $specleft = $_SESSION['hero']->nb_spec_left;
                    $_SESSION['enemy']->force = 0;
                    $message = $_SESSION['hero']->spec_pwr_msg . " L'ennemi ne peut plus attaquer !";
                }
                    break;

                case 'Kevin Melone' : {
                    $_SESSION['hero']->nb_spec_left--;
                    $specleft = $_SESSION['hero']->nb_spec_left;
                    $_SESSION['hero']->currenthp = (int)($_SESSION['hero']->currenthp/4);
                    $damage = $_SESSION['enemy']->currenthp;
                    $_SESSION['enemy']->currenthp = 0;
                    $endFight = true;
                    $message = $_SESSION['hero']->spec_pwr_msg;
                }
                    break;

                case 'Dwight Shrute' : {
                    $_SESSION['hero']->nb_spec_left--;
                    $specleft = $_SESSION['hero']->nb_spec_left;
                    $damage = $_SESSION['hero']->spec_attack;
                    if($_SESSION['enemy']->currenthp - $damage >= 0) {
                        $_SESSION['enemy']->currenthp -= $damage;
                        $message = $_SESSION['hero']->spec_pwr_msg;
                    }
                    else {
                        $endFight = true;
                        $_SESSION['enemy']->currenthp = 0;
                        $message = $_SESSION['hero']->spec_pwr_msg . " L'ennemi est mort !";
                    }
                }
                    break;
            }

        }
        echo json_encode(["currenthero"=>$_SESSION['hero']->currenthp,"currenten" => $_SESSION['enemy']->currenthp, "damage" => $damage, "message" => $message, "endfight" => $endFight, "specleft" => $specleft]);
    }
    function passivePower() {
        http_response_code(200);

        $endFight = false;

        if($_SESSION['hero']->name == 'Jim Halpert') {
            $rand = rand(1,100);
            if($rand > 10) {
                $endFight = true;
                $message =  $_SESSION['hero']->pass_pwr_msg;
            }
        }
        else {
            if($_SESSION['hero']->currenthp + $_SESSION['hero']->pass_pwr >= $_SESSION['hero']->maxhp) {
                $_SESSION['hero']->currenthp = $_SESSION['hero']->maxhp;
            }
            else {
                $_SESSION['hero']->currenthp += $_SESSION['hero']->pass_pwr;
            }
            $message =  $_SESSION['hero']->pass_pwr_msg;
        }
        
        echo json_encode(["current" => $_SESSION['hero']->currenthp, "message" => $message, "endfight" => $endFight]);
    }
}