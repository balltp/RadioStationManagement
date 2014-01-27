<?php
	require_once ('../lib/File.php');
	require_once ('../lib/DB.php');
	
	$file = new File();
	$db = new DB();
	
	$Name = $_GET["user"];	
	$file->uploadFile($_FILES["upload_file"]);
	$FilesName = $file->getName();
	$Size = $_FILES["upload_file"]["size"];
	$ContentType = $_FILES["upload_file"]["type"];
	$DayWeek = $_POST["upload_date"];
	$DayTime = $_POST["upload_time"];
	$List = $_POST["upload_name"];
	$FilesPath = "/files/";
	
	$sql = "INSERT INTO user_upload VALUES 
			(NULL, '".$Name."', '".$FilesName."', '".$Size."', '".$ContentType."', '".$DayWeek."', '".$DayTime."', '".$List."', '".$FilesPath."')";
	$db->query($sql);

?>

<html>
<head>

</head>
<body>
<script langauge="JavaScript">
	window.location='../index.php';
</script>
</body>
</html>