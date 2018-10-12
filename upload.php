
<?php

$allowed = array('png', 'jpg');

$uploaddir = 'uploads/';
$uploadfile = $uploaddir . basename($_FILES['upl']['name']);

if(isset($_FILES['upl']) && $_FILES['upl']['error'] == 0){

	$extension = pathinfo($_FILES['upl']['name'], PATHINFO_EXTENSION);

	if(!in_array(strtolower($extension), $allowed)){
		echo '{"status":" Filetype not allowed, only JPG/PNG Images"}';
		exit;
	}
	if (move_uploaded_file($_FILES['upl']['tmp_name'], $uploadfile)) {
		echo "Image is valid, and was successfully uploaded.\n";
		} else {
		echo "Possible file upload attack!\n";
	}

}

?>
