<!DOCTYPE html>
<html lang='fr' class='h-100'>
<head>
    <meta charset='UTF-8'>
    <title>EVERYTHING'S A DRUM</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1' crossorigin='anonymous'>
    <link rel='stylesheet' href='<?= HOME_PATH ?>/src/assets/css/style.css'/>
</head>
<body class="d-flex flex-column h-100">
<?php include "src/views/components/connected_store_nav.php" ?>
<main class="flex-shrink-0">
    <div class="mt-3 container d-block">
        <h1>Bonjour <b><?= $_SESSION['user']->username ?></b> !</h1>
        <div class="mb-3">
            <a href="<?= HOME_PATH ?>/users/changepass" class="btn btn-warning">Changer le mot de passe</a>
            <a href="<?= HOME_PATH ?>/store/home" class="btn btn-secondary">Accueil</a>
        </div>
        <div class="mb-3 btn-group">
            <a href="<?= HOME_PATH ?>/store/add" class="btn btn-primary">Ajouter un article</a>
        </div>

        <!-- list of items to sale of the user-->
        <h2><b>Mes produits à vendre :</b></h2>
        <div class="d-flex flex-row flex-wrap">
            <?php include "src/views/components/articles.php"?>
        </div>
        <h2><b>Mes ventes :</b></h2>
        <div class="d-flex flex-row flex-wrap">
            <?php include "src/views/components/mysales.php" ?>
        </div>
        <h2><b>Mes achats :</b></h2>
        <div class="d-flex flex-row flex-wrap">
            <?php include "src/views/components/mypurchases.php" ?>
        </div>
    </div>
</main>
<?php include "src/views/components/footer.php" ?>
</body>
</html>