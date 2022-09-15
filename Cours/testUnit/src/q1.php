<?php
const DB_HOST = '172.19.0.4';
const DB_PORT = 3306;
const DB_DATABASE = 'test';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'root';

header("Content-Security-Policy: default-src 'self';");

$error = null;
$success = false;
if(isset($_POST['csrf']) && isset($_SESSION['csrf'])) {
    if (isset($_POST['name']) && isset($_POST['age']) && $_POST['csrf'] == $_SESSION['csrf']) {
        $name = $_POST['name'];
        $age = $_POST['age'];
        if (strlen($name) == 0 || !is_numeric($age)) {
            $error = "Nom ou âge invalide";
        }
        else {
            $db = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
            $query = $db->prepare("INSERT INTO info (name, age) VALUES (?, ?)");
            $query->bindValue(1, $name);
            $query->bindValue(2, $age);
            $query->execute();
            $success = true;
        }
    }
}
$_SESSION['csrf'] = hash('sha256', random_bytes(16));
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Examen final - no1</title>
</head>
<body>
<div class="container">
    <h1>Numéro 1</h1>
    <p>Écrivez votre nom et votre âge, vous serez étonnés du résultat!</p>
    <?php if ($error) { ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php } ?>
    <?php if ($success) { ?>
        <div class="alert alert-success">Votre nom est <?= $name ?> et votre âge <?= $age ?>, étonnant non?</div>
    <?php } ?>
    <form method="post">
        <input type="hidden" value="<?= $_SESSION['csrf'] ?>">
        <div class="mb-3">
            <label for="name">Nom</label>
            <input type="text" id="name" name="name" required class="form-control">
        </div>
        <div class="mb-3">
            <label for="age">Âge</label>
            <input type="number" step="1" min="1" id="age" name="age" required class="form-control">
        </div>
        <div>
            <button class="btn btn-primary">Envoyer</button>
        </div>
    </form>
</div>
</body>
</html>