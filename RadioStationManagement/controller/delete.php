<?php
	require_once ('../lib/File.php');
	require_once ('../lib/DB.php');
	$file = new File();
	$db = new DB();
	
	//delete data in database
	$sql = "DELETE FROM user_upload WHERE FilesID = '".$_GET['ID']."'";
	$db->query($sql);
	//delete file in server
	$file->deleteFile($_GET['File']);
	//Alert Box and Goto List View
	echo "<script>alert('Delete Success');window.location='../index.php?v=List';</script>";
?>