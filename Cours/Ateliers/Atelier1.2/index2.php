<?php
if(isset($_POST['prenom']) && isset($_POST['nom'])) {
    $prenom = $_POST['prenom'];
    $nom = $_POST['nom'];
    $fullName = $prenom . " " . $nom;
}
else {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <h1>Votre nom</h1>
    <?php echo $fullName;?>
    <br>
    <br>
    <a href="index.php">Retour au formulaire</a>
</body>
</html>
