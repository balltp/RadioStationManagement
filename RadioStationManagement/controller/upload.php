<?php
	require_once ('../lib/File.php');
	require_once ('../lib/DB.php');
	include('../lib/GenListFile.php');
	
	$file = new File();
	$db = new DB();
	
	$Name = $_GET["user"];
	$DayWeek = $_POST["upload_date"];
	$DayTime = $_POST["upload_time"];
	$List = $_POST["upload_name"];
	
	//TOTAL FILE IN FOLDER
	//$sql = "SELECT * FROM user_upload WHERE DayWeek = '".$DayWeek."' AND DayTime = '".$DayTime."'";
	//$db->query($sql);
	
	//Another FileGen
	$total = $pushNum;
	
	$FilesPath = $file->pathFile($DayTime, $DayWeek);	
	$file->uploadFile($FilesPath, $_FILES["upload_file"], ($total));
	
	$FilesName = $file->getName();
	$Size = $_FILES["upload_file"]["size"];
	$ContentType = $_FILES["upload_file"]["type"];
	
	
	$sql = "INSERT INTO user_upload VALUES 
			(NULL, '".$Name."', '".$FilesName."', '".$Size."', '".$ContentType."', '".$DayWeek."', '".$DayTime."', '".$List."', '".$FilesPath."')";
	$db->query($sql);

?>

<script langauge="JavaScript">
	window.location='../index.php';
</script>