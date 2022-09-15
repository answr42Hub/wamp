<!DOCTYPE html>
<html lang="fr">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<div class="container">
    <h1 class="mb-3">Calcul PPCM et PGCD</h1>
    <form>
        <div class="form-group mb-3">
            <label for="nb1" class="mb-3">Numero 1</label>
            <input class="form-control"
                   type="number"
                   id="nb1"
                   name="nb1">
        </div>
        <div class="form-group mb-3">
            <label for="nb2" class="mb-3">Numero 2</label>
            <input class="form-control"
                   type="number"
                   id="nb2"
                   name="nb2">
        </div>
        <div class="form-group mb-3">
            <label for="ppcm" class="mb-3">PPCM</label>
            <input class="form-control"
                   readonly
                   type="number"
                   id="ppcm"
                   name="ppcm">
        </div>
        <div class="form-group mb-3">
            <label for="pgcd" class="mb-3">PGCD</label>
            <input class="form-control"
                   readonly
                   type="number"
                   id="pgcd"
                   name="pgcd">
        </div>
        <button type="submit" class="btn btn-primary mb-3">Calculer</button>
    </form>
</div>
<script src="script.js"></script>
</body>
</html>