<?php

header("Content-Type: image/png");

// Coded by SmartGenius
// 2018 - v3, Resistencia Latinoamerica

//Variables de Control
//putenv('GDFONTPATH=' . realpath('.'));

$font1 = dirname(__FILE__) . '/plantillas/GeomGraphicSemibold.ttf';
$font2 = dirname(__FILE__) . '/plantillas/AmarilloUSAF.ttf';

if(!empty($_GET['plantilla'])){
		$plantilla=$_GET['plantilla'];
	}
	else{
		$plantilla="negro";
}
if(!empty($_GET['sello'])){
		$sello=$_GET['sello'];
	}
	else{
		$sello="false";
}
if(!empty($_GET['nickname'])){
		$nickname=$_GET['nickname'];
	}
	else{
		$nickname="Nickname";
}
if(!empty($_GET['faction'])){
		$faction=$_GET['faction'];
	}
	else{
		$faction="flyer";
}

if($plantilla == "negro" ){
			if($faction == "res" ){
						if(!empty($_GET['bgcolor'])){
							$borde="plantillas/backt_negro_res.png";
							$bgcolor=$_GET['bgcolor'];
						}
						else{
							$borde="plantillas/back_negro_res.png";
							$bgcolor="00AFEF";
						}
					}
					else{
						if(!empty($_GET['bgcolor'])){
							$borde="plantillas/backt_negro_enl.png";
							$bgcolor=$_GET['bgcolor'];
						}
						else{
							$borde="plantillas/back_negro_enl.png";
							$bgcolor="00A859";
						}
					}
			}
			else{
			if($faction == "res" ){
						if(!empty($_GET['bgcolor'])){
							$borde="plantillas/backt_gris_res.png";
							$bgcolor=$_GET['bgcolor'];
						}
						else{
							$borde="plantillas/back_gris_res.png";
							$bgcolor="00AFEF";
						}
					}
					else{
						if(!empty($_GET['bgcolor'])){
							$borde="plantillas/backt_gris_enl.png";
							$bgcolor=$_GET['bgcolor'];
						}
						else{
							$borde="plantillas/back_gris_enl.png";
							$bgcolor="00A859";
						}
					}
			}

if(!empty($_GET['logo'])){
		//$logo=$_GET['logo'];
		$logo="logos/logo_" . $_GET['logo'] . ".png";
	}
	else{
		$logo="logos/logo_default.png";
		//$logo="default";
}
if(!empty($_GET['title'])){
		$title=$_GET['title'];
	}
	else{
		$title="YOUR TITLE HERE";
}

if(!empty($_GET['desc'])){
		$description=$_GET['desc'];
	}
	else{
		$description="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec consequat lorem et tincidunt suscipit.";
}

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


//$logo="logos/logo_" . $_GET['logo'] . ".png";
//echo $logo;
$logob = imagecreatefrompng($logo);

// Creamos la Biocard
$biocard = imagecreatetruecolor(756, 1064);

// agregamos transparencia
imagesavealpha ($biocard, true);

// rellenar con transparencia
$alphacolor	= imagecolorallocatealpha($biocard, 0,0,0,127);
imagefill($biocard,0,0,$alphacolor);


// si se define color de fondo
$color = hexColorAllocate($biocard, $bgcolor);
imagefill($biocard, 0, 0, $color);  


// Plantilla
$template = imagecreatefrompng($borde);

imagecopyresampled($biocard, $template, 0, 0, 1, 1, 756, 1064, 756, 1064);

// Aplicar logo
imagecopyresampled($biocard, $logob, 100, 15, 0, 0, 209, 196, 209, 196);

/// NICKNAME
$white = imagecolorallocate($biocard, 255, 255, 255);
$blue = imagecolorallocate($biocard, 0, 175, 240);
$green = imagecolorallocate($biocard, 0, 168, 90);

//Texto del Titulo
//$title1 = "FOR EVER IN FRIENDZONE";
//$title2 = "HONORIFIC MEMBER";

// Imprimir el titulo sin alineacion
//imagettftext($biocard, 25, 0, 65, 325, $white, $font2, $title1);
//imagettftext($biocard, 25, 0, 65, 370, $white, $font2, $title2);

// Imprimir el titulo Centrado
imageTextWrapped($biocard, 65, 300, 640, $font2, $white, $title, 25, "Center");
//imageTextWrapped($biocard, 65, 340, 640, $font2, $white, $title2, 25, Center);

// Imprimir la  Descripcion justificada y centrada
imageTextWrapped($biocard, 65, 560, 640, $font1, $white, $description, 25, "Center");


// color del texto segun faccion
if(!empty($_GET['faction'])){
		$faction=$_GET['faction'];
		if($faction == "res" ){
			imagettftext($biocard, 50, 0, 325, 135, $blue, $font2, $nickname);
		}
		else{
			imagettftext($biocard, 50, 0, 325, 135, $green, $font2, $nickname);
		}
	}
	else{
		$faction="flyer";
		imagettftext($biocard, 50, 0, 325, 135, $white, $font2, $nickname);
}

// mostrar la imagen
imagepng($biocard);
?>