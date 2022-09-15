<?php
declare(strict_types=1);

echo "<h1>Numero 1</h1>";

echo "<h2>Point 1</h2>";
$unNom = 'Joel';
$unPrenom = 'Billy';

NomComplet($unNom, $unPrenom);

function NomComplet($nom, $prenom) {
    echo $prenom . ' ' . $nom;
}

echo "<h2>Point 2</h2>";

$monAge = rand(-56, 99);

echo $monAge . " ans :";
echo "<br>";

echo EstMajeur($monAge) ? "Tu es majeur !" : "Tu n'est pas majeur";

function EstMajeur($age): ?bool{
    return ($age < 0) ? null : ($age > 17);
}

echo "<h2>Point 3</h2>";

echo PlusGrand(5000000, 6, 19, 17, 34, 2, 100033, 45, 1000000);

function PlusGrand(int $nb1, int $nb2,int ...$tab): ?int {
    if(!count($tab))
        return null;
    $plsGrd = max($nb1, $nb2);
    foreach($tab as $int) {
        if($int > $plsGrd)
            $plsGrd = $int;
    }
    return $plsGrd;
}

echo "<h1>Numero 2</h1>";

$num1 = rand(1, 100);
$num2 = rand(1, 100);

echo PPCM($num1, $num2) . " et " . PGCD($num1, $num2);

function PGCD(int $nb1, int $nb2): string {
    $greatest = max($nb1, $nb2);
    $lowest = min($nb2, $nb1);
    $div = $lowest;
    while ($div) {
        if (!($lowest % $div) && !($greatest % $div)) {
            return "Le PGCD de " . $nb1 . " et " . $nb2 . " est : " . $div;
        } else {
            $div--;
        }
    }
    return "";
}
function PPCM(int $nb1, int $nb2): string {
    $m1 = 1;
    $m2 = 1;
    while($nb1*$m1 != $nb2*$m2) {
        if($nb1*$m1 < $nb2*$m2)
            $m1++;
        else
            $m2++;
    }
    return "Le PPCM de " . $nb1 . " et " . $nb2 . " est : " . $nb1*$m1;
}

echo "<h1>Numero 3</h1>";

$randNum = rand(-10, 10);
echo $randNum;
?>
<link rel="stylesheet" href="style.css">
<?php if ($randNum < 0){ ?>
    <div class="alert alert-danger" role="alert">
    Ce nombre n'est pas valide !
    </div>
<?php } elseif ($randNum && $randNum%2){ ?>
    <div class="alert alert-success" role="alert">
    Ce nombre est valide et impair!
    </div>
<?php } elseif ($randNum) { ?>
    <div class="alert alert-success" role="alert">
        Ce nombre est valide et pair!
    </div>
<?php } ?>

