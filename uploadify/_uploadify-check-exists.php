<?php
/*
Uploadify v3.0.0
Copyright (c) 2010 Ronnie Garcia

Return true if the file exists
*/
$targetPath = "C:/projects/hybeen/formationhouse/uploads/projects/temp/";
if (file_exists($targetPath . $_POST['filename'])) {
	echo 1;
} else {
	echo 0;
}
?>