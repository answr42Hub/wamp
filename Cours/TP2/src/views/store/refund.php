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
        <form method="post" class="col-6" enctype="multipart/form-data">
            <?php if(isset($errorMsg)) echo "<div class='alert alert-danger'>$errorMsg</div>"?>
            <?php if(isset($successMsg)) echo "<div class='alert alert-success'>$successMsg</div>"?>
            <h1>Êtes-vous sûr de vouloir vous débarasser de cette percussion ?</h1>
            <div class="d-flex border-2 border-dark">
                <img src="<?= HOME_PATH ?>/src/assets/img/<?= isset($article) ? $article->image : 'meme.jpg' ?>" class="me-3 w-25 h-25" alt="Image produit"/>
                <div>
                    <h2><b>Article : </b><?= isset($article) ? $article->name : '' ?></h2>
                    <h3><b>Total à rembourser : </b><?= isset($article) ? number_format(($article->price)*1.14975, 2, ',') : '' ?></h3>
                </div>
            </div>
            <div class="<?= isset($successMsg) ? 'd-none' : '' ?>">
                <input type="hidden" name="csrf" id="csrf" value="<?= $_SESSION['csrf'] ?>">
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Rembourser</button>
                        <a href="<?= HOME_PATH ?>/users/profile" class="btn btn-secondary">Annuler</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<?php include "src/views/components/footer.php" ?>
</body>
</html>