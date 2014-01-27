<?php
	require_once ('lib/File.php');
	echo "page Delete ID ".$_GET['ID'];
	$file = new File();
	
	$file->deleteFile($_GET['filesName']);
	
?>