<?php
//php.net for more information
$games = ["Diablo 2", "Portal 2", "Half Life 2", "Minecraft", "It Takes Two", "Call Of Duty", "The Last Of Us Prat II", "Among Us"];
sort($games);
if (isset($_GET['s'])) {
    $games = array_filter($games, function($s) {
        return str_contains($s, $_GET['s']);
    });
}

function PGCD(int $nb1, int $nb2): int {
    $greatest = max($nb1, $nb2);
    $lowest = min($nb2, $nb1);
    $div = $lowest;
    while ($div) {
        if (!($lowest % $div) && !($greatest % $div)) {
            return $div;
        } else {
            $div--;
        }
    }
    return 0;
}
function PPCM(int $nb1, int $nb2): int {
    $m1 = 1;
    $m2 = 1;
    while($nb1*$m1 != $nb2*$m2) {
        if($nb1*$m1 < $nb2*$m2)
            $m1++;
        else
            $m2++;
    }
    return $nb1*$m1;
}

$nb1 = "";
$nb2 = "";
$ppcm = "";
$pgcd = "";


if (isset($_GET['nb1']) && isset($_GET['nb2'])) {
    $nb1 = $_GET['nb1'];
    $nb2 = $_GET['nb2'];
    $ppcm = PPCM($nb1, $nb2);
    $pgcd = PGCD($nb1, $nb2);
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title>Atelier 1.2</title>
</head>
<body class="px-3">
<h1 class="mb-3">Numéro 1</h1>
<form>
    <div class="form-group mb-3">
        <label for="s" class="mb-3">Filtre</label>
        <input class="form-control"
               type="text"
               id="s"
               name="s">
    </div>
    <button type="submit" class="btn btn-primary mb-3">Filtrer</button>
</form>
<ul class="list-group mb-3">
    <?php foreach ($games as $game) {
    echo "<li class='list-group-item'>$game</li>";
    }?>
</ul>

<h1 class="mb-3">Numéro 2</h1>
<h2 class="mb-3">Calcul PPCM et PGCD</h2>
<form>
    <div class="form-group mb-3">
        <label for="nb1" class="mb-3">Numero 1</label>
        <input class="form-control"
               value="<?php echo $nb1?>"
               type="text"
               id="nb1"
               name="nb1">
    </div>
    <div class="form-group mb-3">
        <label for="nb2" class="mb-3">Numero 2</label>
        <input class="form-control"
               value="<?php echo $nb2?>"
               type="text"
               id="nb2"
               name="nb2">
    </div>
    <div class="form-group mb-3">
        <label for="ppcm" class="mb-3">PPCM</label>
        <input class="form-control"
               value="<?php echo $ppcm ?>"
               readonly
               type="text"
               id="ppcm"
               name="ppcm">
    </div>
    <div class="form-group mb-3">
        <label for="pgcd" class="mb-3">PGCD</label>
        <input class="form-control"
               value="<?php echo $pgcd ?>"
               readonly
               type="text"
               id="pgcd"
               name="pgcd">
    </div>
    <button type="submit" class="btn btn-primary mb-3">Calculer</button>
</form>
<h1 class="mb-3">Numéro 3</h1>
<h2 class="mb-3">Trouvez votre nom</h2>
<p class="mb-3">La réponse vous étonnera !</p>
<form method="post" action="index2.php">
    <div class="form-group mb-3">
        <label for="prenom" class="mb-3">Prénom</label>
        <input class="form-control"
               value=""
               type="text"
               id="prenom"
               name="prenom">
    </div>
    <div class="form-group mb-3">
        <label for="nom" class="mb-3">Nom</label>
        <input class="form-control"
               value=""
               type="text"
               id="nom"
               name="nom">
    </div>
    <button type="submit" class="btn btn-primary mb-3">Combiner</button>
</form>
</body>
</html>
