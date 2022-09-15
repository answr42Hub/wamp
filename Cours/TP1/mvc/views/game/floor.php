<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <title>Étages</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= HOME_PATH ?>/assets/css/style.css"/>
</head>
<body class="h-100 content">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <span class="navbar-brand fs-1 mx-3">Le jeu <i>The Office</i></span>
    <div class="collapse navbar-collapse" id="navbarNav">
        <a class="btn btn-warning ms-auto mx-3" href="<?= HOME_PATH ?>/users/disconnect">Déconnexion</a>
    </div>
</nav>

<div class="container pt-5">
    <h1 class="fs-lg-1 text-center">Étage <?= $_SESSION['floor']+1 ?></h1>
    <div class="d-flex justify-content-center">
        <?php
            for($i = 0; $i < 5; $i++) {
                $door = $_SESSION['floors'][$_SESSION['floor']][$i];
                if($door->visited)
                    echo "<a href=" . HOME_PATH . "/game/floor?door=" . $i . " class='btn btn-primary mx-2 fs-1 disabled'>Porte " . $i+1 . "</a>";
                else
                    echo "<a href=" . HOME_PATH . "/game/floor?door=" . $i . " class='btn btn-primary fs-1 mx-2'>Porte " . $i+1 . "</a>";
            }
        ?>
    </div>
    <?= (isset($message)) ? "<div class='alert-warning fs-2 mt-5 text-center'>" . $message . "</div>" : '' ?>
    <div class="<?= ($_SESSION['victory']) ? 'd-flex' : 'd-none' ?> justify-content-end">
        <a href="<?= HOME_PATH ?>/game/summery" class="btn btn-primary fs-2 mt-5">Fin de partie</a>
    </div>
    <div class="<?= (isset($_SESSION['next']) && $_SESSION['next']) ? 'd-flex' : 'd-none' ?> justify-content-end">
        <a href="<?= HOME_PATH ?>/game/next" class="btn btn-primary fs-2 mt-5">Prochain étage</a>
    </div>
</div>
</body>
</html>
