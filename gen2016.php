<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Ingress Biocard Generator - by SmartGenius</title>

		<!-- Google web fonts -->
		<link href="http://fonts.googleapis.com/css?family=PT+Sans+Narrow:400,700" rel='stylesheet' />
		
		<link href="css/style.css" rel="stylesheet" />
	</head>
	
	<body>
		<div id='biocard'>
		<h1>Ingress Biocard Generator</h1>
		<a href="index.html"><h3>Create New Biocard</h3></a>
		<br><h3>Left clic on image and "Save As"</h3>
<?php 

$nickname = urlencode($_POST['nickname']);
$image = urlencode($_POST['selimage']);
$title = urlencode($_POST['title']);
$description = urlencode($_POST['desc']);
	
$frontcard = "?plantilla=".$_POST['plantilla']."&sello=true&nickname=".$nickname."&faction=".$_POST['faction']."&image=".$image;                
$backcard = "?plantilla=".$_POST['plantilla']."&nickname=".$nickname."&faction=".$_POST['faction']."&logo=".$_POST['logo']."&bgcolor=".$_POST['bgcolor']."&title=".$title."&desc=".$description;                                    

//echo "<br>";
//echo $frontcard;

echo "<div id='frontcard'>";
echo "		<img src='front.php".$frontcard."' width='360' >";
echo "</div>";
//echo $backcard;
echo "<div id='backcard'>";
echo "		<img src='back.php".$backcard."' width='360'>";
echo "</div>";
?>
			<div id="contact"><a href="http://telegram.me/smartgenius"><img  src="img/smartgenius.png"></a>
		</div>	
	</body>
</html>