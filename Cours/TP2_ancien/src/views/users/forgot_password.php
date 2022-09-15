<!DOCTYPE html>
<html lang="fr" class="h-100">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= HOME_PATH ?>/src/assets/css/style.css"/>
</head>
<body class="d-flex flex-column h-100">
<?php include "src/views/components/connected_store_nav.php" ?>
<main class="flex-shrink-0">
    <div class="mt-3 container d-flex justify-content-center">
         <form method="post" class="col-lg-6">
             <?php if(isset($errorMsg)) echo "<div class='alert alert-danger'>$errorMsg</div>"?>
             <?php if(isset($successMsg)) echo "<div class='alert alert-success'>$successMsg</div>"?>
             <h1>Entrez le e-mail lié à votre compte</h1>
            <div class="mb-3">
                <label for="username" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>"/>
            </div class="mb-3">
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>
</main>
<?php include "src/views/components/footer.php" ?>
</body>
</html>