<?php

$bd = new PDO('mysql:dbname=test;host=172.26.0.2;port=3306',
    'root', 'root');
//$result = $bd->query("SHOW TABLES LIKE 'couleurs'");
/*
if(!$result->rowCount()) {
    $bd->query("TABLE `test`.`couleurs` ( `id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `nom` VARCHAR(255) NOT NULL , `couleur` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB");
    $bd->query("INSERT INTO couleurs (nom, couleur) VALUES ('Rouge', 'FF0000')");
    $bd->query("INSERT INTO couleurs (nom, couleur) VALUES ('Vert', '00FF00')");
    $bd->query("INSERT INTO couleurs (nom, couleur) VALUES ('Bleu', '0000FF')");
}
*/
$couleurs = $bd->query("SELECT * FROM couleurs");
$couleurs->execute();

if(isset($_GET['id'])) {
    $couleur = $bd->query("SELECT couleur FROM couleurs WHERE id = " . $_GET['id']);
    $couleur->execute();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Numero 3</title>
</head>
<body onload="draw()">
<div>
    <h1>Numéro 3</h1>
    <canvas id="circle" width="150" height="150"></canvas>
    <ul>
        <?php

        foreach ($couleurs as $couleur) {
            echo "<li><a href='/index2.php?id=" . $couleur['id'] . "'>" . $couleur['nom'] . "</a></li>";
        }

        ?>
    </ul>

</div>
</body>
<script>
    function draw()
    {
        var canvas = document.getElementById('circle');
        if (canvas.getContext)
        {
            var ctx = canvas.getContext('2d');
            var X = canvas.width / 2;
            var Y = canvas.height / 2;
            var R = 45;
            ctx.beginPath();
            ctx.arc(X, Y, R, 0, 2 * Math.PI, false);
            ctx.fillStyle = "#<?= $couleur['couleur'] ?>";
            ctx.fill();
            ctx.stroke();
        }
    }
</script>
</html>
