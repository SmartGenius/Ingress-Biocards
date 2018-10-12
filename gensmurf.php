<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Smurf The Earth Card Generator - by SmartGenius</title>

		<!-- Google web fonts -->
		<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
		
		<link href="css/style.css" rel="stylesheet" />
	</head>
	
	<body>
		<div id='biocard'>
		<h1>Smurf The Earth Card Generator</h1>
		<a href="index.html"><h3>Create New Biocard or StE Card</h3></a>
		<br><h3>Left clic on image and "Save As"</h3>
<?php 

//$nickname = urlencode($_POST['nickname']);
$image = urlencode($_POST['selimage']);
$version = urlencode($_POST['version']);
	
$stecard = "?version=".$version."&image=".$image;

echo "<div id='frontcard'>";
echo "		<img src='smurfme.php".$stecard."' width='350' >";
echo "</div>";

?>
			<div id="contact"><a href="http://telegram.me/smartgenius"><img  src="img/smartgenius.png"></a>
		</div>	
	</body>
</html>