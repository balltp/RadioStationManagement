<?php
	require_once ('../lib/File.php');
	require_once ('../lib/DB.php');
	include('../lib/GenListFile.php');
	require_once '../lib/FN.php';
	
	$file = new File();
	$db = new DB();
	$db2 = new DB();
	$db3 = new DB();
	$fn = new FN();
	
	$Name = $_GET["user"];
	$Day = explode(":", $_POST["upload_date"]);
	$DayWeek = $Day[0];
	$DayTime = $Day[1];
	$List = $_POST["upload_name"];
		
	//ORDER FILE FROM DATABASE
	$sql2 = "SELECT * FROM radio_sublist WHERE Lid='".$List."' AND day='".$DayWeek."' AND time='".$DayTime."'";
	$db2->query($sql2);
	$Data2 = $db2->fetch_array();
	$total = $Data2[0]['order'];
	
	//UPLOAD FILE TO SERVER
	$FilesPath = $file->pathFile($DayTime, $DayWeek);	
	$file->uploadFile($FilesPath, $_FILES["upload_file"], ($total));
	
	$FilesName = $file->getName();
	$Size = $_FILES["upload_file"]["size"];
	$ContentType = $_FILES["upload_file"]["type"];
	
	//SAVE DATA TO DATABASE
	$sql = "INSERT INTO user_upload VALUES 
			(NULL, '".$Name."', '".$FilesName."', '".$Size."', '".$ContentType."', '".$DayWeek."', '".$DayTime."', '".$List."', '".$FilesPath."')";
	$db->query($sql);
	
	//CHANGE STATUS FROM N => Y IN DATABASE
	$sql3 = "UPDATE radio_sublist 
		SET status='Y'
		WHERE Lid='".$List."'
			AND day='".$DayWeek."'
			AND time='".$DayTime."'";
	$db3->query($sql3);

?>
