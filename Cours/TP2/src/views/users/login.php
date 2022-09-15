<!DOCTYPE html>
<html lang='fr' class='h-100'>
<head>
    <meta charset='UTF-8'>
    <title>EVERYTHING'S A DRUM</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1' crossorigin='anonymous'>
    <link rel='stylesheet' href='<?= HOME_PATH ?>/src/assets/css/style.css'/>
</head>
<body class="d-flex flex-column h-100 flex-column">
<?php include "src/views/components/login_nav.php" ?>
<main class="flex-shrink-0 ">
    <div class="mt-3 container d-flex justify-content-center">
        <form method="post" class="col-lg-6">
            <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
            <?php if(isset($errorMsg)) echo "<div class='alert alert-danger'>$errorMsg</div>"?>
            <?php if(isset($_SESSION['msg'])) echo "<div class='alert alert-success'>" . $_SESSION['msg'] . "</div>";
            unset($_SESSION['msg']);
            ?>
            <h1>Entrez vos informations</h1>
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur ou e-mail</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= (isset($_POST['username'])) ? $_POST['username'] : '' ?>"/>
            </div class="mb-3">
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" value=""/>
                <a href="<?= HOME_PATH ?>/users/forgot">Mot de passe oublié ?</a>
            </div>
            <div class="checkbox mb-3">

                <label>
                    <input type="checkbox" name="remember" value="remember">Se souvenir de moi.
                </label>
            </div>
            <div class='btn-group ms-auto me-3'>
                <button type="submit" class="btn btn-primary">Connecter</button>
                <a class='btn btn-warning' href= '<?= HOME_PATH ?>/users/register'>S'enregistrer</a>
            </div>
        </form>
    </div>
</main>
<?php include "src/views/components/footer.php" ?>
</body>
</html>
