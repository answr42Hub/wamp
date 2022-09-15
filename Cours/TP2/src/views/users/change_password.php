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
    <div class="mt-3 container d-flex justify-content-center flex-column align-items-center">
        <?php if(isset($errorMsg)) echo "<div class='alert alert-danger'>$errorMsg</div>"?>
        <?php if(isset($successMsg)) echo "<div class='alert alert-success'>$successMsg</div>"?>
        <form method="post" class="col-lg-6 <?= isset($successMsg) ? 'd-none' : '' ?>" >
            <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>"/>
            <h1>Entrez un nouveau mot de passe !</h1>
            <div class="mb-3">
                <label for="newpass" class="form-label">Ancien mot de passe</label>
                <input type="password" class="form-control" name="oldpass" id="oldpass" value=""/>
            </div>
            <div class="mb-3">
                <label for="newpass" class="form-label">Nouveau mot de passe</label>
                <input type="password" class="form-control" name="newpass" id="newpass" value="<?= isset($_POST['newpass']) ? $_POST['newpass'] : ''?>"/>
            </div>
            <div class="mb-3">
                <label for="newpassconf" class="form-label">Confirmer le nouveau mot de passe</label>
                <input type="password" class="form-control" name="newpassconf" id="newpassconf" value="<?= isset($_POST['newpassconf']) ? $_POST['newpassconf'] : ''?>"/>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
                <a href="<?= HOME_PATH ?>/users/profile" class="btn btn-secondary">Retour</a>
            </div>
        </form>
    </div>
    <div class="container">
        <a href="<?= HOME_PATH ?>/users/profile" class="mx-auto btn btn-secondary <?= isset($successMsg) ? 'd-block' : 'd-none' ?>">Retour</a>
    </div>
</main>
<?php include "src/views/components/footer.php" ?>
</body>
</html>