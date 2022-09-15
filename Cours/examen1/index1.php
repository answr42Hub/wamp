<?php


if(isset($_POST['password'])) {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Numero 2</title>
</head>
<body>
<form method="post">
    <div class="mb-3">
        <label for="num1" class="form-label">Mot de passe</label>
        <input type="text" name="password" class="form-control" id="num1" value="<?= (isset($num1) ? $num1 : '')  ?>">
    </div>
    <button type="submit" class="btn btn-primary">Hasher</button>
</form>

</body>
<script>
    function passwordIsOk() {

        let password = document.querySelector('#').value;
        let data = new FormData();
        data.append('password', password);
        fetch('/exemen1/index1.php/action=passwordIsOk', {
            method: 'post',
            body: data
        })
            .then(reponse => {
                if(reponse.ok) {
                    return reponse.json();
                }
                else {

                }
            })
    }
    document.querySelector('#username').addEventListener('blur', usernameExist);
</script>
</html>
