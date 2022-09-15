<?php
$results = null;
$nb = null;
if (isset($_POST['number'])) {
    if (!is_numeric($_POST['number'])) {
        $results = [false, false, false];
    }
    else {
        $nb = intval($_POST['number']);
        $results = [];
        $results[] = $nb > 0;
        $results[] = $nb % 5 == 0;
        $results[] = $nb == 42;
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <title>Mini-test Tests</title>
</head>
<body>
<div class="container">
    <h1>Examen - Test d'acceptation</h1>
    <?php
    if (!is_null($results)) {
        echo '<h2>Résultats</h2>';
        echo '<ul>';
        echo '<li>' . ($nb ? "Le nombre $nb" : 'Vous n\'avez pas mis un nombre') . ':</li>';
        echo '<li>Est ' . ($results[0] ? 'positif' : 'négatif ou null') . '</li>';
        echo '<li>' . ($results[1] ? 'Est' : 'N\'est pas') . ' un multiple de 5</li>';
        echo '<li>' . ($results[2] ? 'La réponse à la grande question sur la vie, l\'univers et le reste' : 'Bof') . '</li>';
        echo '</ul>';
    }
    ?>
    <form method="post">
        <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input class="form-control" name="number">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Faire les tests</button>
        </div>
    </form>
</div>
</body>
</html>