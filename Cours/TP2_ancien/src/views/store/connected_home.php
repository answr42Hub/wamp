<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= HOME_PATH ?>/src/assets/css/style.css"/>
</head>
<body class="d-flex h-100">
<?php include "src/views/components/connected_store_nav.php" ?>
<main class="flex-shrink-0">
    <div class="mt-3 container">
        <?php if(isset($errorMsg)) echo "<div class='alert alert-danger col-4'>$errorMsg</div>"?>
        <h1>Bienvenue ! Voici des cossins :</h1>
        <ul>
            <li>Un objet à vendre</li>
            <li>Un autre objet à vendre</li>
        </ul>
    </div>
</main>
<?php include "src/views/components/footer.php" ?>
</body>
</html>