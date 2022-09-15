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
    <div class="mt-3 container d-flex justify-content-center">
        <form method="post" class="col-lg-6" enctype="multipart/form-data">
            <input type="hidden" name="csrf" id="csrf" value="<?= $_SESSION['csrf'] ?>">
            <?php if(isset($errorMsg)) echo "<div class='alert alert-danger'>$errorMsg</div>"?>
            <?php if(isset($successMsg)) echo "<div class='alert alert-success'>$successMsg</div>"?>
            <h1>Entrez les informations de l'article :</h1>
            <div class="mb-3">
                <label for="name" class="form-label">Nom de l'article</label>
                <input type="text" class="form-control" name="name" id="name" value="<?= (isset($_POST['name'])) ? $_POST['name'] : (isset($article) ? $article->name : '') ?>"/>
            </div class="mb-3">
            <div class="mb-3">
                <label for="desc" class="form-label">Description</label>
                <textarea type="text" class="form-control" name="desc" id="desc"><?= (isset($_POST['desc'])) ? $_POST['desc'] : (isset($article) ? $article->desc : '') ?></textarea>
            </div class="mb-3">
            <div class="mb-3">
                <label for="price" class="form-label">Prix</label>
                <input type="number" step="any" class="form-control" name="price" id="price" value="<?= (isset($_POST['price'])) ? $_POST['price'] : (isset($article) ? $article->price : '2.00') ?>"/>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Image</label>
                <input type="file" class="form-control" name="img" id="img"/>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Enregistrer Modifications</button>
                <a href="<?= HOME_PATH ?>/store/profile" class="btn btn-secondary">Retour au profile</a>
            </div>
        </form>
    </div>
</main>
<?php include "src/views/components/footer.php" ?>
</body>
</html>