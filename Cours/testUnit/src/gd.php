<?php
$img = @imagecreatefromjpeg(__DIR__ . '/assets/img/background.jpg');
if(!$img) {
    die('Image non valide');
}
//list($width, $height) = getimagesize(__DIR__ . 'assets/image/background.jpg'); pas bon

//bon :
const SIZE = 1000;
$width = imagesx($img);
$height = imagesy($img);
$newimg = imagecreatetruecolor(SIZE, SIZE);
$offset = ($width - $height) / 2;
imagecopyresized($newimg, $img, 0, 0, $offset, 0, SIZE, SIZE, $height, $height);

//logo
$logo = imagecreatefromjpeg(__DIR__ . '/assets/img/logo.jpg');
$wlogo = imagesx($logo);
$hlogo = imagesy($logo);
const LOGO_SIZE = 100;

$newlogo = imagecreatetruecolor(LOGO_SIZE, LOGO_SIZE);
imagecopyresized($newlogo, $logo, 0, 0, 0, 0, LOGO_SIZE, LOGO_SIZE, $wlogo, $hlogo);

$topleftpixel = imagecolorat($newlogo, 0, 0);
imagecolortransparent($newlogo, $topleftpixel);
imagecopymerge($newimg, $newlogo, 10, 10, 0, 0, LOGO_SIZE, LOGO_SIZE, 100);

// Texte
$fontsize = 40;
$font = __DIR__ . '/assets/img/Paul-le1V.ttf';
$text = $_GET['text'];
$offset = 10;
list($x1, $y1, $x2, $y2) =
    imageftbbox($fontsize, 0, $font, $text);
imagefttext($newimg, $fontsize, 0, SIZE - $x2 - $offset, $fontsize + $offset, 0, $font, $text);

//generer
header('Content-type: image/jpeg');
imagejpeg($newimg, null, 90);
//imagejpeg($newimg, __DIR__ . '/assets/img/final2.jpeg', 90);