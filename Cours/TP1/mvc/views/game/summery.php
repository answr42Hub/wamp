<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= HOME_PATH ?>/assets/css/style.css"/>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <span class="navbar-brand fs-1 mx-3">Le jeu <i>The Office</i></span>
    <a class="btn btn-warning ms-auto mx-3" href="<?= HOME_PATH ?>/users/disconnect">Déconnexion</a>
</nav>
<div class="mh-100">
    <div class="text-center">
        <h1>Aventure terminée !</h1>
        <div class="<?= ($_SESSION['victory'])? 'd-block' : 'd-none' ?>">
            <p><b>Félicitation, vous avez terminé l'aventure !</b></p>
            <br>
            <br>
            <p>Votre EXP est passé à <?= $_SESSION['hero']->exp ?> !</p>
        </div>
        <div class="<?= ($_SESSION['victory'])? 'd-none' : 'd-block' ?>">
            <p><b>Domage, vous êtes mort avant la fin...</b></p>
            <br>
            <br>
            <p>Mais votre EXP est passé à <?= $_SESSION['hero']->exp ?>, et vous vous êtes rendu au <?= $_SESSION['floor']+1 ?>e étage !</p>
        </div>
        <a href="<?= HOME_PATH ?>/game/menu" class="btn btn-danger">Nouvelle partie !</a>
    </div>
</div>
</body>
</html>
