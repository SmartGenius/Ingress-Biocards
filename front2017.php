<?php

header("Content-Type: image/png");

// Coded by SmartGenius
// 2018 - v3 Resistencia Latinoamerica

//Variables de Control
$font1 = dirname(__FILE__) . '/plantillas/GeomGraphicSemibold.ttf';
$font2 = dirname(__FILE__) . '/plantillas/AmarilloUSAF.ttf';
$plantilla="plantillas/template2017.png";

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
if(!empty($_GET['logo'])){
		//$logo=$_GET['logo'];
		$logo="logos/logo_" . $_GET['logo'] . ".png";
	}
	else{
		$logo="logos/logo_default.png";
		//$logo="default";
}
if(!empty($_GET['bgcolor'])){
							$bgcolor=$_GET['bgcolor'];
						}
						else{
							$bgcolor="FFFFFF";
}

///// Funciones especiales
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
            if ($align == "r") { //If the align is Right
                $locX = $x + $width - $lineWidth;
            } else { //If the align is Center
                $locX = $x + ($width/2) - ($lineWidth/2);
            }
        } else { //if the align is Left
            $locX = $x;
        }
        $locY = $y + ($nr * $lineHeight);
        imagettftext($img, $textSize, 0, $locX, $locY, $color, $font, $line);
    }       
}

function hexColorAllocate($image,$hex){
    $hex = ltrim($hex,'#');
    $a = hexdec(substr($hex,0,2));
    $b = hexdec(substr($hex,2,2));
    $c = hexdec(substr($hex,4,2));
    return imagecolorallocate($image, $a, $b, $c); 
}


// Creamos la Biocard
$biocard = imagecreatetruecolor(750, 1050);

// agregamos transparencia
imagesavealpha ($biocard, true);

// rellenar con transparencia
$alphacolor	= imagecolorallocatealpha($biocard, 0,0,0,127);
imagefill($biocard,0,0,$alphacolor);

$color = hexColorAllocate($biocard, $bgcolor);

// imagen del usuario
// modificar con imagen subida
$extension = strtolower (substr($image, -3));

if ($extension == "png"){
		$imgagente = imagecreatefrompng($image);
	}else{
	$imgagente = imagecreatefromjpeg($image);
	}

list($ancho, $alto) = getimagesize($image);
	
// copiar al contenedor
imagecopyresampled($biocard, $imgagente, 0, 65, 0, 0, 750, 934, $ancho, $alto);

//Poligonos de Fondo

$polygon1 = array(
            22,  119,  // Point 1 (x, y)
            347,  119, // Point 2 (x, y)
            347,  22,  // Point 3 (x, y)
            19, 22,  // Point 4 (x, y)
            );
			
$polygon2 = array(
            323,  18,  // Point 1 (x, y)
            490,  0, // Point 2 (x, y)
            750,  0,  // Point 3 (x, y)
			750, 129,  // Point 4 (x, y)
			731, 906,  // Point 5 (x, y)
			22, 906,  // Point 6 (x, y)
			14, 102,  // Point 7 (x, y)
			52, 102,  // Point 8 (x, y)
			52, 866,  // Point 9 (x, y)
			700, 866,  // Point 10 (x, y)
			694, 136,  // Point 11 (x, y)
			599, 57,  // Point 12 (x, y)
			323, 57,  // Point 13 (x, y)
			323, 21,  // Point 14 (x, y)
            );
			

imagefilledpolygon($biocard, $polygon1, 4, $color);
imagefilledpolygon($biocard, $polygon2, 14, $color);

// Plantilla
$template = imagecreatefrompng($plantilla);

list($ancho, $alto) = getimagesize($image);

imagecopyresampled($biocard, $template, 0, 0, 1, 1, 750, 1050, 750, 1050);

imageTextWrapped($biocard, 40, 940, 450, $font2, $color, $nickname, 45, "Left");

//Logo
$logob = imagecreatefrompng($logo);
imagecopyresampled($biocard, $logob, 525, 917, 0, 0, 115, 106, 209, 196);


// mostrar la imagen
imagepng($biocard);
?>