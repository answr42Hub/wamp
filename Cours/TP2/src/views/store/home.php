<!DOCTYPE html>
<html lang='fr' class='h-100'>
<head>
    <meta charset='UTF-8'>
    <title>EVERYTHING'S A DRUM</title>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1' crossorigin='anonymous'>
    <link rel='stylesheet' href='<?= HOME_PATH ?>/src/assets/css/style.css'/>
</head>
<body class="d-flex h-100">
<?php include "src/views/components/store_nav.php" ?>
<main class="flex-shrink-0">
    <div class="mt-3 container col-12">
        <?php if(isset($errorMsg)) echo "<div class='alert alert-danger col-4'>$errorMsg</div>"?>
        <h1>Bienvenue à <b>Tout est une Percussions ! ©</b></h1>
        <p><b>Choisissez vos percussions :</b></p>
        <div class="d-flex flex-row flex-wrap">
            <?php include "src/views/components/articles.php"?>
        </div>
    </div>
</main>
<?php include "src/views/components/footer.php" ?>
</body>
</html>
