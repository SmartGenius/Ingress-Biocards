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

$borde="plantillas/avatar2.png";

$target="generated/avatar_" . $_GET['nickname'] . ".png";

$nlen = strlen($nickname);

switch ($nlen) {
	case 1:
		$topx = 170;
		$topy = 200;
        break;
	case 2:
		$topx = 175;
		$topy = 205;
        break;
	case 3:
		$topx = 180;
		$topy = 210; 
        break;
	case 4:
		$topx = 185;
		$topy = 215;
        break;
	case 5:
		$topx = 185;
		$topy = 220;
        break;		
	case 6:
		$topx = 180;
		$topy = 230;
        break;	
	case 7:
		$topx = 175;
		$topy = 240;
        break;
	case 8:
		$topx = 170;
		$topy = 245;
        break;
	case 9:
		$topx = 170;
		$topy = 250;
        break;
	case 10:
		$topx = 170;
		$topy = 255;
        break;
	case 11:
		$topx = 170;
		$topy = 260;
        break;
	case 12:
		$topx = 170;
		$topy = 265;
        break;
	case 13:
		$topx = 170; 
		$topy = 270; 
        break;
	case 14:
		$topx = 170;
		$topy = 275;
        break;
	case 15:
		$topx = 170;
		$topy = 280;
        break;
	case 16:
		$topx = 170;
		$topy = 285;
        break;
	case 17:
		$topx = 170;
		$topy = 290;
        break;
	case 18:
		$topx = 170;
		$topy = 295;
        break;
}

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
$avatar = imagecreatetruecolor(900, 900);

// agregamos transparencia
imagesavealpha ($avatar, true);

// rellenar con transparencia
$alphacolor	= imagecolorallocatealpha($avatar, 0,0,0,127);
imagefill($avatar,0,0,$alphacolor);

// imagen del usuario
// modificar con imagen subida
$imgagente = imagecreatefromjpeg($image);

list($ancho, $alto) = getimagesize($image);

// copiar al contenedor
imagecopyresampled($avatar, $imgagente, 140, 145, 0, 0, 620, 620, $ancho, $alto);

// Plantilla
$template = imagecreatefrompng($borde);

imagecopyresampled($avatar, $template, 0, 0, 0, 0, 900, 900, 900, 900);

/// NICKNAME
$white = imagecolorallocate($avatar, 255, 255, 255);
$blue = imagecolorallocate($avatar, 0, 175, 240);
$green = imagecolorallocate($avatar, 0, 168, 90);

//imagettftext($avatar, 25, 30, 180, 270, $white, $font1, $nickname);
imageTextWrapped($avatar, $topx, $topy, 300, $font1, $white, $nickname, 30, "Center");

// mostrar la imagen
imagepng($avatar);
//imagedestroy($avatar);
?>