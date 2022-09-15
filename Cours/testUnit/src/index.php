<?php
require_once '../vendor/autoload.php';
$error = null;
$success = null;
if (isset($_POST['number'])) {
    $detector = new NumberDetector();
    if (intval($_POST['number']) != $_POST['number']) {
        $error = "Veuillez entrer un nombre valide";
    }
    elseif (!$detector->addIfNotExist($_POST['number'])) {
        $error = "Le nombre " . intval($_POST['number']) . " existe déjà";
    }
    else {
        $success = "Le nombre " . intval($_POST['number']) . " a bien été ajouté";
    }
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini-test tests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Mini-test tests</h1>
    <p>Ajoutez des nombres dans un tableau, ça sert à rien mais on a du plaisir!</p>
    <?php if ($error) { ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php } ?>
    <?php if ($success) { ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php } ?>
    <form method="post">
        <label for="number">Nombre</label>
        <input type="number" name="number" id="number" required>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    <?php /* ?>
    <p>Les nombres présents:</p>
    <pre>
        <?php
        $repo = new NumberRepository();
        print_r($repo->get());
        ?>
    </pre>
    <?php */ ?>
</div>
</body>
</html>