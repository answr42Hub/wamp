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
            <h1>Informations du produits</h1>
            <div class="d-flex border-2 border-dark">
                <img src="<?= HOME_PATH ?>/src/assets/img/<?= isset($article) ? $article->image : 'meme.jpg' ?>" class="me-3 w-25 h-25" alt="Image produit"/>
                <div>
                    <h2><b>Article : </b><?= isset($article) ? $article->name : '' ?></h2>
                    <h3><b>Prix de base : </b><?= isset($article) ? number_format($article->price, 2, ',') : '' ?></h3>
                    <h3><b>TPS : </b><?= isset($article) ? number_format(($article->price)*0.05, 2, ',') : '' ?></h3>
                    <h3><b>TVQ : </b><?= isset($article) ? number_format(($article->price)*0.09975, 2, ',') : '' ?></h3>
                    <h3><b>Total à payer : </b><?= isset($article) ? number_format(($article->price)*1.14975, 2, ',') : '' ?></h3>
                </div>
            </div>
            <div class="<?= isset($successMsg) ? 'd-none' : '' ?>">
                <input type="hidden" name="csrf" id="csrf" value="<?= $_SESSION['csrf'] ?>">
                <h1>Entrez vos informations d'achat :</h1>
                <div class="border border-dark rounded mb-2 p-1">
                    <h2>Acheteur et adresse de livraison</h2>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nom et prénom</label>
                        <input type="text" class="form-control" name="name" id="name" value="<?= (isset($_POST['name'])) ? $_POST['name'] : '' ?>"/>
                    </div class="mb-3">
                    <div class="mb-3">
                        <label for="adress" class="form-label">Adresse</label>
                        <input type="text" class="form-control" name="adress" id="adress" value="<?= (isset($_POST['adress'])) ? $_POST['adress'] : '' ?>"/>
                    </div class="mb-3">
                    <div class="mb-3">
                        <label for="city" class="form-label">Ville</label>
                        <input type="text" class="form-control" name="city" id="city" value="<?= (isset($_POST['city'])) ? $_POST['city'] : '' ?>"/>
                        <label for="zipcode" class="form-label">Code postal</label>
                        <input type="text" class="form-control" name="zipcode" id="zipcode" value="<?= (isset($_POST['zipcode'])) ? $_POST['zipcode'] : '' ?>"/>
                        <label for="country" class="form-label">Pays</label>
                        <input type="text" class="form-control" name="country" id="country" value="<?= (isset($_POST['country'])) ? $_POST['country'] : '' ?>"/>
                    </div>
                </div>
                <div class="border border-dark rounded mb-2 p-1">
                    <h2>information de paiement :</h2>
                    <div class="mb-3">
                        <label for="cardnum" class="form-label">Numéro de carte de crédit</label>
                        <input type="number" class="form-control" name="cardnum" id="cardnum" value="<?= (isset($_POST['cardnum'])) ? $_POST['cardnum'] : '' ?>"/>
                    </div>
                    <div class="mb-3">
                        <label for="mthexp" class="form-label">Mois d'expiartion</label>
                        <input type="number" class="form-control" name="mthexp" id="mthexp" value="<?= (isset($_POST['mthexp'])) ? $_POST['mthexp'] : '' ?>"/>
                        <label for="yrexp" class="form-label">Année d'expiartion</label>
                        <input type="number" class="form-control" name="yrexp" id="yrexp" value="<?= (isset($_POST['yrexp'])) ? $_POST['yrexp'] : '' ?>"/>
                        <label for="cvv" class="form-label">Code cvv</label>
                        <input type="number" class="form-control" name="cvv" id="cvv" value="<?= (isset($_POST['cvv'])) ? $_POST['cvv'] : '' ?>"/>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Procéder à l'achat</button>
                        <a href="<?= HOME_PATH ?>/store/home" class="btn btn-secondary">Annuler</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</main>
<?php include "src/views/components/footer.php" ?>
</body>
</html>