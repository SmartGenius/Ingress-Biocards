<?php
if ($handle = opendir('.')) {
    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != "..") {
           // echo "$entry\n";
			Echo "<a href='$entry'>$entry</a><br>";
        }
    }
    closedir($handle);
}
?>
