<?php
$error = null;
$success = null;
if (isset($_POST['nb1']) && isset($_POST['nb2'])) {
    if ($_POST['nb2'] == 0) {
        $error = "Vous ne pouvez pas diviser par zéro";
    }
    else {
        $nb1 = intval($_POST['nb1']);
        $nb2 = intval($_POST['nb2']);
        $result = $nb1 / $nb2;
        $success = "Résultat de la division: $nb1 / $nb2 = $result";
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Cours test acceptation</title>
</head>
<body>
<div class="container">
    <h1>Test d'acceptation</h1>
    <h2>Super diviseur</h2>
    <?php
    if (!is_null($error)) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
    elseif (!is_null($success)) {
        echo "<div class='alert alert-success'>$success</div>";
    }
    ?>
    <form method="post">
        <div class="mb-3">
            <label class="form-label" for="nb1">Dividende</label>
            <input class="form-control" name="nb1" id="nb1" type="number">
        </div>
        <div class="mb-3">
            <label class="form-label" for="nb2">Diviseur</label>
            <input class="form-control" name="nb2" id="nb2" type="number">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Calculer</button>
        </div>
    </form>
</div>
</body>
</html>