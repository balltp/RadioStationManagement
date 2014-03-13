<?php
	require_once ('../lib/File.php');
	require_once ('../lib/DB.php');
	$file = new File();
	$db = new DB();
	$db2 = new DB();
	
	$sql = "SELECT * FROM user_upload WHERE FilesID = '".$_GET['ID']."'";
	$db->query($sql);
	foreach($db->fetch_array() as $rs){
		$file_name = $rs['FilesName'];	
		$file_path = $rs['FilesPath'];
		$List = $rs['List'];
		$DayWeek = $rs['DayWeek'];
		$DayTime = $rs['DayTime'];
	}
	
	//delete data in database
	$sql = "DELETE FROM user_upload WHERE FilesID = '".$_GET['ID']."'";
	$db->query($sql);
	//delete file in server
	$file->deleteFile($file_name, $file_path);
	
	//CHANGE STATUS FROM Y => N IN DATABASE
	$sql2 = "UPDATE radio_sublist
	SET status='N'
	WHERE Lid='".$List."'
	AND day='".$DayWeek."'
	AND time='".$DayTime."'";
	$db2->query($sql2);
	
?>

<!-- Alert Box and Goto List View -->
<script>
	alert('Delete Success');
	window.location='../index.php?v=List';
</script>
<!-- End Alert Box and Goto List View -->