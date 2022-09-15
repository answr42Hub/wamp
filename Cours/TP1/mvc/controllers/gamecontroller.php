<?php

namespace controllers;

use models\boss;
use models\door;
use repositories;
use repositories\userrepository;

class gamecontroller
{
    function gameMenu() {
        if(isset($_POST['radio'])){
            $hero = 'models\heroes\\' . $_POST['radio'];
            if(class_exists($hero)) {
                $_SESSION['hero'] = new $hero($_SESSION['user']->exp);
                $_SESSION['floor'] = 0;
                if(!isset($_SESSION['floors'])) {
                    $this->generateFloors();
                }
                $_SESSION['victory'] = false;

                header('Location: ' . HOME_PATH . '/game/floor');
            }
        }
        require __DIR__ . '/../views/game/menu.php';
    }

    function summery() {
        $userRepo = new \repositories\userrepository();

        $userRepo->updateExp($_SESSION['user']->id, $_SESSION['hero']->exp);


        $_SESSION['user'] = $userRepo->getOne($_SESSION['user']->username);

        unset($_SESSION['floors']);

        require __DIR__ . '/../views/game/summery.php';
    }

    function doorSelect() {

        if(isset($_GET['door']) && isset($_SESSION['floors'])) {

            $floor = $_SESSION['floors'][$_SESSION['floor']];
            $visitcount = 0;
            $_SESSION['infight'] = false;

            if(!$floor[$_GET['door']]->visited) {

                switch($floor[$_GET['door']]->content) {
                    case 'boss' :
                        $_SESSION['enemy'] = 'boss';
                        header('Location: ' . HOME_PATH . '/game/fight');
                        break;
                    case 'monster' :
                        $_SESSION['enemy'] = 'monster';
                        header('Location: ' . HOME_PATH . '/game/fight');
                        break;
                    case 'exp' :
                        $message = $this->exp();
                        break;
                    case 'heal' :
                        $message = $this->heal();
                        break;
                    case 'hurt' :
                        $message = $this->hurt();
                        break;
                }

                $floor[$_GET['door']]->visited = true;

                for($i = 0; $i < 5; $i++) {
                    if($floor[$i]->visited)
                        $visitcount++;
                }
                if($visitcount == 5) {
                    if($_SESSION['floor'] < 4)
                        $_SESSION['next'] = true;
                    else
                        $_SESSION['victory'] = true;
                }
            }
            else {
                echo "Im visited now";
            }
        }

        require __DIR__ . '/../views/game/floor.php';
    }

    function fight() {

        if(!$_SESSION['infight']) {
            if($_SESSION['enemy'] == 'boss') {
                $monstRepo = new \repositories\monsterrepository();
                $_SESSION['enemy'] = $monstRepo->getBoss();
            }
            else {
                $monstRepo = new \repositories\monsterrepository();
                $_SESSION['enemy'] = $monstRepo->getRandMonst();// verifier si ca marche !
            }
        }

        $_SESSION['infight'] = true;

        require __DIR__ . '/../views/game/fight.php';
    }

    function nextFloor() {
        if($_SESSION['floor'] < 4){
            $_SESSION['floor']++;
            $_SESSION['hero']->exp += 10;
        }
        $_SESSION['next'] = false;
        header('Location: ' . HOME_PATH . '/game/floor');
    }

    private function generateFloors() {

        $doors = array();
        $floors = array(array());
        for($i = 0; $i < 5; $i++) {

            for($j = 0; $j < 5; $j++) {
                $rand = rand(1, 100);
                if($rand <= 60) {
                    $doors[$j] = new door('monster');
                }
                elseif($rand <= 70) {
                    $doors[$j] = new door('exp');
                }
                elseif($rand <= 80) {
                    $doors[$j] = new door('heal');
                }
                else {
                    $doors[$j] = new door('hurt');
                }
            }

            $rand = rand(0, 4);
            $doors[$rand] = new door('boss');

            $floors[$i] = $doors;
        }

        $_SESSION['floors'] = $floors;
    }

    private function exp() : string {

        $messages = array(
            15 => "Vous avez trouvé qui était le l'étrangleur de Scranton ! Vous gagnez 15 exp.",
            20 => "Vous êtes assistant manager par interim ! Vous gagnez 20 exp.",
            40 => "Vous avez une bonne discution avec David Wallace CEO. Vous gagnez 40 exp."
        );
        $rand = rand(0, 100);
        if($rand <= 5) {
            $rand = 40;
        }
        elseif($rand <= 35) {
            $rand = 20;
        }
        elseif($rand <= 100) {
            $rand = 15;
        }
        $_SESSION['hero']->exp +=  $rand;
        return $messages[$rand];
    }

    private function heal() : string {

        $messages = array(
            10 => "Vous prenez une pause café, vous guérissez de 10 hp.",
            20 => "C'est le jour du bredzel! vous arrivez en premier dans la file et en magez un avec toutes les garnitures. +20hp",
            30 => "Belsnickel a déterminé que vous êtes admirable! Il pense vos plaies et vous guérit de 30 hp !"
        );
        $rand = rand(0, 100);
        if($rand <= 5) {
            $rand = 30;
        }
        elseif($rand <= 35) {
            $rand = 20;
        }
        elseif($rand <= 100) {
            $rand = 10;
        }

        if(($_SESSION['hero']->currenthp + $rand > $_SESSION['hero']->maxhp))
            $_SESSION['hero']->currenthp = $_SESSION['hero']->maxhp;
        else
            $_SESSION['hero']->currenthp += $rand;

        return $messages[$rand];
    }

    private function hurt() : string
    {
        $messages = array(
            5 => "Vous avez glissez sur le chili de Kevin sur le sol, vous perdez 5 hp",
            8 => "Vous devez assistez au dundy award, vous perdez 8 hp",
            10 => "Belsnickel a determiné que vous étiez malicieux... vous perdez 10 hp"
        );
        $rand = rand(0, 100);
        if ($rand <= 5) {
            $rand = 10;
        } elseif ($rand <= 35) {
            $rand = 8;
        } elseif ($rand <= 100) {
            $rand = 5;
        }

        if(($_SESSION['hero']->currenthp - $rand) < 0)
            $_SESSION['hero']->currenthp = 0;
        else
            $_SESSION['hero']->currenthp -= $rand;

        return $messages[$rand];
    }
}