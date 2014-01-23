<?php
	require_once ('../lib/Control.php');
	require_once ('../lib/DB.php');
	$ctrl = new Control();
	$db = new DB();
	
	$by = $_GET["user"];
	$name = $_POST["upload_name"];
	$date = $_POST["upload_date"];
	$time = $_POST["upload_time"];
	$ctrl->uploadFile($_FILES["upload_file"]);
	$file = $ctrl->getName();
	
	$sql = "INSERT INTO fileupload VALUES 
			(NULL, '".$by."', '".$name."', '".$file."', '".$date."', '".$time."')";
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