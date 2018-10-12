<?php

header("Content-Type: image/png");

// Coded by SmartGenius
// 2018 - Resistencia Latinoamerica

//Variables de Control
$font1 = dirname(__FILE__) . '/plantillas/GeomGraphicSemibold.ttf';
$font2 = dirname(__FILE__) . '/plantillas/AmarilloUSAF.ttf';

if(!empty($_GET['nickname'])){
		$nickname=$_GET['nickname'];
	}
	else{
		$nickname="Nickname";
}
if(!empty($_GET['image'])){
		$image=$_GET['image'];
	}
	else{
		$image="plantillas/player_template.png";
}

if(!empty($_GET['version'])){
		if ($_GET['version'] == "1"){
			$version = "plantillas/ste17v1.png";
		} else {
			$version = "plantillas/ste17v2.png";
		}
		//$nickname=$_GET['nickname'];
	}
	else{
		$version = "plantillas/ste17v1.png";
}

//$borde="plantillas/avatar2.png";

//$target="generated/avatar_" . $_GET['nickname'] . ".png";

//////////////
//A function for pixel precise text Wrapping
function imageTextWrapped(&$img, $x, $y, $width, $font, $color, $text, $textSize, $align) {
    $y += $textSize;
    $dimensions = imagettfbbox($textSize, 0, $font, " ");
    $x -= $dimensions[4]-$dimensions[0];

    $text = str_replace ("\r", '', $text);
    $srcLines = explode ("\n", $text);
    $dstLines = Array();
    foreach ($srcLines as $currentL) {
        $line = '';
        $words = explode (" ", $currentL);
        foreach ($words as $word) {
            $dimensions = imagettfbbox($textSize, 0, $font, $line.$word);
            $lineWidth = $dimensions[4] - $dimensions[0];
            if ($lineWidth > $width && !empty($line) ) {
                $dstLines[] = ' '.trim($line);
                $line = '';
            }
            $line .= $word.' ';
        }
        $dstLines[] =  ' '.trim($line);
    }
    $dimensions = imagettfbbox($textSize, 0, $font, "MXQJPmxqjp123");
    $lineHeight = $dimensions[1] - $dimensions[5];

    $align = strtolower(substr($align,0,1));
    foreach ($dstLines as $nr => $line) {
        if ($align != "l") {
            $dimensions = imagettfbbox($textSize, 0, $font, $line);
            $lineWidth = $dimensions[4] - $dimensions[0];
            if ($align == "r") { 
                $locX = $x + $width - $lineWidth;
            } else { 
                $locX = $x + ($width/2) - ($lineWidth/2);
            }
        } else {
            $locX = $x;
        }
        $locY = $y + ($nr * $lineHeight);
        imagettftext($img, $textSize, 30, $locX, $locY, $color, $font, $line);
    }       
}
// Creamos el avatar
$smurf = imagecreatetruecolor(714, 1002);

// agregamos transparencia
imagesavealpha ($smurf, true);

// rellenar con transparencia
$alphacolor	= imagecolorallocatealpha($smurf, 0,0,0,127);
imagefill($smurf,0,0,$alphacolor);

// imagen del usuario
// modificar con imagen subida
$extension = strtolower (substr($image, -3));

if ($extension == "png"){
		$imgagente = imagecreatefrompng($image);
	}else{
		$imgagente = imagecreatefromjpeg($image);
	}
//$imgagente = imagecreatefromjpeg($image);

list($ancho, $alto) = getimagesize($image);

// copiar al contenedor
imagecopyresampled($smurf, $imgagente, 150, 260, 0, 0, 420, 420, $ancho, $alto);

// Plantilla
$template = imagecreatefrompng($version);

imagecopyresampled($smurf, $template, 0, 0, 0, 0, 714, 1002, 714, 1002);

/// NICKNAME
//$white = imagecolorallocate($avatar, 255, 255, 255);
//$blue = imagecolorallocate($avatar, 0, 175, 240);
//$green = imagecolorallocate($avatar, 0, 168, 90);

//imagettftext($avatar, 25, 30, 180, 270, $white, $font1, $nickname);

//imageTextWrapped($avatar, $topx, $topy, 300, $font1, $white, $nickname, 30, Center);

// mostrar la imagen
imagepng($smurf);
//imagedestroy($avatar);
?>