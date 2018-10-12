<?php

header("Content-Type: image/png");

// Coded by SmartGenius
// 2018 - Resistencia Latinoamerica

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
if(!empty($_GET['image'])){
		$image=$_GET['image'];
	}
	else{
		$image="plantillas/player_template.png";
}
if($plantilla == "negro" ){
			if($sello == "true" ){
						$borde="plantillas/plantilla_negro_sello.png";
					}
					else{
						$borde="plantillas/plantilla_negro_sinsello.png";
					}
			}
		else{
			if($sello == "true" ){
						$borde="plantillas/plantilla_gris_sello.png";
					}
					else{
						$borde="plantillas/plantilla_gris_sinsello.png";
					}
			}



// Creamos la Biocard
$biocard = imagecreatetruecolor(756, 1064);

// agregamos transparencia
imagesavealpha ($biocard, true);

// rellenar con transparencia
$alphacolor	= imagecolorallocatealpha($biocard, 0,0,0,127);
imagefill($biocard,0,0,$alphacolor);

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
imagecopyresampled($biocard, $imgagente, 0, 70, 0, 0, 756, 934, $ancho, $alto);


// Plantilla
$template = imagecreatefrompng($borde);

imagecopyresampled($biocard, $template, 0, 0, 1, 1, 756, 1064, 756, 1064);

/// NICKNAME
$white = imagecolorallocate($biocard, 255, 255, 255);
$blue = imagecolorallocate($biocard, 0, 175, 240);
$green = imagecolorallocate($biocard, 0, 168, 90);

imagettftext($biocard, 25, 0, 65, 930, $white, $font1, "Agent");

// color del texto segun faccion
if(!empty($_GET['faction'])){
		$faction=$_GET['faction'];
		if($faction == "res" ){
			imagettftext($biocard, 45, 0, 65, 985, $blue, $font2, $nickname);
		}
		else{
			imagettftext($biocard, 45, 0, 65, 985, $green, $font2, $nickname);
		}
	}
	else{
		$faction="flyer";
		imagettftext($biocard, 45, 0, 65, 985, $white, $font2, $nickname);
}

// mostrar la imagen
imagepng($biocard);
?>