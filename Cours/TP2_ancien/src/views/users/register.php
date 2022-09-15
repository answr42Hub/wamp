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
<?php include "src/views/components/login_nav.php" ?>
<main class="flex-shrink-0">
    <div class="mt-3 container d-flex justify-content-center">
        <form method="post" class="col-lg-6">
            <input type="hidden" name="csrf" value="<?= $_SESSION['csrf'] ?>">
            <?php if(isset($errorMsg)) echo "<div class='alert alert-danger'>$errorMsg</div>"?>
            <?php if(isset($successMsg)) echo "<div class='alert alert-success'>$successMsg</div>"?>
            <h1>Entrez vos informations</h1>
            <div class="mb-3">
                <label for="username" class="form-label">Nom d'utilisateur</label>
                <input type="text" class="form-control" name="username" id="username" value="<?= (isset($_POST['username'])) ? $_POST['username'] : '' ?>"/>
            </div class="mb-3">
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" name="email" id="email" value="<?= (isset($_POST['email'])) ? $_POST['email'] : '' ?>"/>
            </div class="mb-3">
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="password" id="password" value=""/>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Confirmer Mot de passe</label>
                <input type="password" class="form-control" name="passconf" id="password" value=""/>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</main>
<?php include "src/views/components/footer.php" ?>
</body>
</html>