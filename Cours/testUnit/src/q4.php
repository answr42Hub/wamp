<?php
const SIZE = 200;
if(isset($_POST['submit']) && isset($_POST['txt'])) {
    // Nouveau: Validation PHP pour une image, parfois internet suggère getimagesize
    var_dump($_FILES);
    if (mime_content_type($_FILES['img']['tmp_name']) == 'image/jpeg' &&
        str_ends_with($_FILES['img']['name'], '.jpeg') ||
        mime_content_type($_FILES['img']['tmp_name']) == 'image/png' &&
        str_ends_with($_FILES['img']['name'], '.png')) {

        $files = glob(__DIR__ . '/img/*');

        foreach ($files as $file) {
            unlink($file);
        }
        move_uploaded_file($_FILES['img']['tmp_name'], __DIR__ . '/img/' . basename($_FILES['img']['tmp_name']));

        $img = @imagecreatefromjpg(__DIR__ . '/img/' . basename($_FILES['img']['tmp_name']));

        $width = imagesx($img);
        $height = imagesy($img);
        $newimg = imagecreatetruecolor(SIZE, SIZE);
        $offset = ($width - $height) / 2;

        imagecopyresized($newimg, $img, 0, 0, $offset, 0, SIZE, SIZE, $height, $height);
        $fontsize = 18;
        $font = __DIR__ . '/assets/img/Paul-le1V.ttf';
        $text = $_POST['text'];
        $offset = 100;
        list($x1, $y1, $x2, $y2) =
            imageftbbox($fontsize, 0, $font, $text);
        imagefttext($newimg, $fontsize, 0, SIZE - $x2 - $offset, $fontsize + $offset, 0, $font, $text);
        header('Content-type: image/jpeg');
        imagejpeg($newimg, __DIR__ . 'img/' . basename($_FILES['img']['tmp_name']), 90);

    }
}
$img = glob(__DIR__ . '/img/*')[0] ?? false;
if ($img) {
    $img = 'img/' . basename($img);
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini-test tests</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body>
<h1>Téléversement</h1>
<?php if ($img) { ?>
    <img src="<?= $img ?>" class="img-fluid"/>
<?php } ?>
<form method="post"  enctype="multipart/form-data">
    <div>
        <label for="img" class="form-label">Votre image</label>
        <input type="file" name="img" id="img"/>
    </div>
    <div>
        <label for="txt" class="form-label">Votre texte</label>
        <input type="text" name="txt" id="txt"/>
    </div>
    <div class="mt-3">
        <button class="btn btn-primary" name="submit">Mettre à jour</button>
    </div>
</form>
</body>
</html>
