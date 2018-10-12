<?php

header("Content-Type: image/png");

$im = imagecreatetruecolor(440, 50);

imagesavealpha ($im, true);

$alphacolor	= imagecolorallocatealpha($im, 0,0,0,127);
imagefill($im,0,0,$alphacolor);

$white = imagecolorallocate($im, 255, 255, 255);
$blue = imagecolorallocate($im, 0, 175, 240);
$black = imagecolorallocate($im, 0, 0, 0);

$text = $_GET['nick'];

$font = "plantillas/AmarilloUSAF.ttf";

// Sombra en el Texto
//imagettftext($im, $_GET['h'], 0, 1, 1, $grey, $font, $text);

// Add the text
imagettftext($im, $_GET['h'], 0, 1, 48, $blue, $font, $text);

// Using imagepng() results in clearer text compared with imagejpeg()
imagepng($im);
imagedestroy($im);
?>
