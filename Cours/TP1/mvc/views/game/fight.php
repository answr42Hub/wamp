<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <title>Combat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= HOME_PATH ?>/assets/css/style.css"/>

</head>
<body id="hero" class="h-100 content">
<div class="mh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <span class="navbar-brand fs-1 mx-3">Le jeu <i>The Office</i></span>
        <a class="btn btn-warning ms-auto mx-3" href="<?= HOME_PATH ?>/users/disconnect">Déconnexion</a>
    </nav>
    <h1 class="fs-1 text-center">Combats</h1>
    <div class="container-fluid d-xl-flex">
        <div class="container ms-auto">
            <div class="card my-5" style="width: 35rem;">
                <img class="card-img-top" src="<?= HOME_PATH ?>/assets/img/<?= $_SESSION['hero']->img ?>" alt="image de <?= $_SESSION['hero']->name ?>">
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION['hero']->name?></h5>
                    <p class="card-text"><b>HP: </b><span id="herohp"><?= $_SESSION['hero']->currenthp ?></span>/<?= $_SESSION['hero']->maxhp ?></p>
                    <p class="card-text"><b>Force: </b><?= $_SESSION['hero']->force ?></p>
                    <p class="card-text"><b>Défense: </b><?= $_SESSION['hero']->def ?></p>
                    <div class="btn-group ms-auto">
                        <button id="attack" class="btn btn-primary">Attaquer</button href="#">
                        <button id="special" class="btn btn-warning">Spécial</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid col-2 mt-5 overflow-auto" id="events">
            <!- some events ->
            <div id="winner" class="d-none">
                <a class="btn btn-primary" href="<?= HOME_PATH ?>/game/floor">Retour à l'étage</a>
            </div>
            <div id="loser" class="d-none">
                <a class="btn btn-danger" href="<?= HOME_PATH ?>/game/summery">Fin de partie</a>
            </div>
        </div>
        <div class="container">
            <div class="card mx-5 my-5" style="width: 35rem;">
                <img class="card-img-top" src="<?= HOME_PATH ?>/assets/img/<?= $_SESSION['enemy']->img ?>" alt="image de <?= $_SESSION['enemy']->name ?>">
                <div class="card-body">
                    <h5 class="card-title"><?=$_SESSION['enemy']->name?></h5>
                    <p class="card-text"><b>HP: </b><span id="enemyhp"><?= $_SESSION['enemy']->currenthp ?></span>/<?= $_SESSION['enemy']->maxhp ?></p>
                    <p class="card-text"><b>Force: </b><?= $_SESSION['enemy']->force ?></p>
                    <p class="card-text"><b>Défense: </b><?= $_SESSION['enemy']->def ?></p>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="<?= HOME_PATH ?>/assets/js/api.js"></script>
</body>
</html>
