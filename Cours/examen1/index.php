<?php

if(isset($_POST['num1']) && isset($_POST['num2'])) {
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    if(is_numeric($num1)) {
        if(is_numeric($num2)){
            if($num2 == 0) {
                $message = 'Veuillez entrer un un nombre plus grand que 0 !';
            }else
                $reponse = $num1/$num2;
        }
        else {
            $message = "Le diviseur " . $num2 . " n'est pas un nombre !";
        }
    }
    else {
        $message = "Le dividende " . $num1 . " n'est pas un nombre !";
    }
}
else {
    $message = "Veuillez entrer un dividende et un diviseur !";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Numero 1</title>
</head>
<body>
   <?= (isset($message) ? "<div class='alert-danger'>" . $message . "</div>" : '') ?>
   <form method="post">
       <div class="mb-3">
           <label for="num1" class="form-label">Dividende</label>
           <input type="number" name="num1" class="form-control" id="num1" value="<?= (isset($num1) ? $num1 : '')  ?>">
       </div>
       <div class="mb-3">
           <label for="num2" class="form-label">Diviseur</label>
           <input type="number" name="num2" class="form-control" id="num2"  value="<?= (isset($num2) ? $num2 : '')  ?>">
       </div>
       <label for="disabledTextInput" class="form-label">Réponse</label>
       <input type="number" id="disabledTextInput" class="form-control" placeholder="Disabled input" value="<?= (isset($reponse)) ? $reponse : '' ?>">
       <button type="submit" class="btn btn-primary">Calculer</button>
   </form>
</body>
</html>
