<?php
//$files = array();

//$dir = opendir('.');
// ($file = readdir($dir)) {
//    if ($file == '.' || $file == '..') {
//        continue;
 //   }
//
//    $files[] = $file;
//}

header('Content-type: application/json');
//echo json_encode($files);
echo json_encode(glob("*.{png}", GLOB_BRACE));
?>