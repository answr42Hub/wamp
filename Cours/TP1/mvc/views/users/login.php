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
    <a class="btn btn-warning ms-auto mx-3" href="<?= HOME_PATH ?>/users/register">S'inscrire</a>
</nav>
<div class="mh-100">
    <div class="container-fluid">
        <div class="mx-3 mt-3">
            <?php if(isset($errorMsg)) echo "<div class='alert alert-danger col-4'>$errorMsg</div>"?>

            <form method="post" class="col-lg-6">
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" class="form-control" name="username" id="username" value="<?= (isset($_POST['username'])) ? $_POST['username'] : '' ?>"/>
                </div class="mb-3">
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" id="password" value="<?= (isset($_POST['password'])) ? $_POST['username'] : '' ?>"/>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Connecter</button>
                </div>
            </form>
            <img id="bg" class="img-fluid fixed-bottom text-center" src="<?= HOME_PATH ?>/assets/img/the_office_bg.png" alt="...">
        </div>
    </div>
</div>
</body>
</html>
