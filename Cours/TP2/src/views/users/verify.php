<!DOCTYPE html>
<html lang='fr' class='h-100'>
<head>
    <meta charset='UTF-8'>
    <title>EVERYTHING'S A DRUM</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1' crossorigin='anonymous'>
    <link rel='stylesheet' href='<?= HOME_PATH ?>/src/assets/css/style.css'/>
</head>
<body class="h-100">
<?php include "src/views/components/login_nav.php" ?>
<main>
    <div class="mt-3 container d-block mx-auto">
        <?php if(isset($errorMsg)) echo "<div class='alert alert-danger'>$errorMsg</div>
            <div>
                <a href='" . HOME_PATH . "/users/forgot' class='btn btn-secondary'>Renvoyer</a>
            </div>
        "?>
        <?php if(isset($successMsg)) echo "<div class='alert alert-success'>$successMsg</div>"?>
        <a class="btn btn-secondary" href="<?= HOME_PATH ?>/users/login">Retour au login.</a>
    </div>
</main>
<?php include "src/views/components/footer.php" ?>
</body>
</html>