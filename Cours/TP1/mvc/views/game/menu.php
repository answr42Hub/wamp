<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <title>Game menu</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= HOME_PATH ?>/assets/css/style.css"/>
</head>
<body class="h-100">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <span class="navbar-brand fs-1 mx-3">Le jeu <i>The Office</i></span>
    <div class="collapse navbar-collapse" id="navbarNav">
        <a class="btn btn-warning ms-auto mx-3" href="<?= HOME_PATH ?>/users/disconnect">Déconnexion</a>
    </div>
</nav>
<div class="container-fluid content h-100 d-flex">

    <div class="container mt-5 mx-5 fs-2">
        <h1 class="">Bienvenue <?= $_SESSION['user']->username ?></h1>
        <h2><?= $_SESSION['user']->exp ?></h2>
        <h2 class="mb-5">Choisissez votre personnage :</h2>
        <form method="post">
            <input class="form-check-input" type="radio" name="radio" id="flexRadio1" value="michael" onchange="check()" checked>
            <label class="form-check-label" for="flexRadio1">
                Michael Scott
            </label>
            <br>
            <input class="form-check-input" type="radio" name="radio" id="flexRadio2" value="dwight"  onchange="check()">
            <label class="form-check-label" for="flexRadio2">
                Dwight Schrute
            </label>
            <br>
            <input class="form-check-input" type="radio" name="radio" id="flexRadio3" value="jim"  onchange="check()">
            <label class="form-check-label" for="flexRadio3">
                Jim Halpert
            </label>
            <br>
            <input class="form-check-input" type="radio" name="radio" id="flexRadio4" value="kevin"  onchange="check()">
            <label class="form-check-label" for="flexRadio4">
                Kevin Melone
            </label>
            <div class="mb-5">
                <button type="submit" class="btn btn-primary">Départ !</button>
            </div>
        </form>
    </div>

    <div id="1" class="container mt-5">
        <div class="card" style="width: 36rem;">
            <div class="card-body">
                <h5 class="card-title">Micheal Scott</h5>
                <div class="card-text">
                    Micheal est toujours prêt à attaquer avec une blague si mauvaise qu'elle fait des dommages.
                    <br>
                    <br>
                    Pouvoir spécial : Crie <i>THAT'S WHAT SHE SAID</i> et l'ennemi perd la moitié de sa vie actuelle.
                    Il ne peut l'utiliser qu'une seule fois.
                    <br>
                    <br>
                    Pouvoir passif : Michael prend un café et reprends du mieux !.
                </div>
            </div>
            <img src="<?= HOME_PATH ?>/assets/img/michael_scott.png" class="card-img-bottom" alt="...">
        </div>
    </div>

    <div id="2" class="container mt-5">
        <div class="card" style="width: 36rem;">
            <div class="card-body">
                <h5 class="card-title">Dwight Schrute</h5>
                <div class="card-text">
                    Dwight a toujours un panier bien rembli de betteraves près de lui qu'il a fièrement cueillit dans sa ferme familiale.
                    Il n'hésite pas à s'en servir pour défendre la fiertée de sa famille.
                    <br>
                    <br>
                    Pouvoir spécial : Se déguise en <i>Belsnickel</i> pendant 20 secondes et punit le malicieux ennemi en doublant son attaque.
                    <br>
                    <br>
                    Pouvoir passif : Se guérit en mageant une betterave.
                </div>
            </div>
            <img src="<?= HOME_PATH ?>/assets/img/dwight_schrute.png" class="card-img-bottom" alt="...">
        </div>
    </div>

    <div id="3" class="container mt-5">
        <div class="card" style="width: 36rem;">
            <div class="card-body">
                <h5 class="card-title">Jim Halpert</h5>
                <div class="card-text">
                    Jim n'ai pas les confrontation, mais il aime jouer des tours ce qui entaraîne des dommages collatéraux.
                    <br>
                    <br>
                    Pouvoir spécial : Il met les choses de son ennemi dans du <i>Jell-O</i> ce qui bloque trois attaques.
                    <br>
                    <br>
                    Pouvoir passsif : Jim a 90% de chance de fuir le combat et continuer sa route.
                </div>
            </div>
            <img src="<?= HOME_PATH ?>/assets/img/jim_halpert.png" class="card-img-bottom" alt="...">
        </div>
    </div>

    <div id="4" class="container mt-5">
        <div class="card" style="width: 36rem;">
            <div class="card-body">
                <h5 class="card-title">Kevin Melone</h5>
                <div class="card-text">
                    Kevin sécrète des substances nauséabonde par les pieds et l'odeur est tellemnt forte que l'ennemi perd de la vie.
                    <br>
                    <br>
                    Pouvoir spécial : Renverse le chaudron de sa recette spéciale de chili sur le sol, et tue instantanément l'ennemi. Sauf qu'il perd le 3/4 de sa vie actuelle...
                    <br>
                    <br>
                    Pouvoir passif : Mange des cookies et se guérit.
                </div>
            </div>
            <img src="<?= HOME_PATH ?>/assets/img/kevin_melone.png" class="card-img-bottom" alt="...">
        </div>
    </div>
</div>
<script>
    document.getElementById('flexRadio1').checked = true;
    check();
    function check() {
        if(document.getElementById('flexRadio1').checked) {
            document.getElementById('1').style.display = 'block';
        }else {
            document.getElementById('1').style.display = 'none';
        }
        if(document.getElementById('flexRadio2').checked) {
            document.getElementById('2').style.display = 'block';
        }else {
            document.getElementById('2').style.display = 'none';
        }
        if(document.getElementById('flexRadio3').checked) {
            document.getElementById('3').style.display = 'block';
        }else {
            document.getElementById('3').style.display = 'none';
        }
        if(document.getElementById('flexRadio4').checked) {
            document.getElementById('4').style.display = 'block';
        }else {
            document.getElementById('4').style.display = 'none';
        }
    }
</script>
</body>
</html>