<?php
	require_once ('../lib/File.php');
	require_once ('../lib/DB.php');
	$file = new File();
	$db = new DB();
	$db2 = new DB();
	
	$sql = "SELECT * FROM _files WHERE F_id = '".$_GET['ID']."'";
	$db->query($sql);
	foreach($db->fetch_array() as $rs){
		$file_name = $rs['F_name'];	
		$file_path = $rs['F_path'];
		$List = $rs['L_id'];
		$DayWeek = $rs['DayWeek'];
		$DayTime = $rs['DayTime'];
		$Sid = $rs['S_id'];
	}
	
	//delete data in database
	$sql = "DELETE FROM _files WHERE F_id = '".$_GET['ID']."'";
	$db->query($sql);
	
	//delete file in server
	$file->deleteFile($file_name, $file_path);
	
	//CHANGE STATUS FROM Y => N IN DATABASE
	$sql2 = "UPDATE _sublist
	SET status='N'
	WHERE S_id='$Sid'";
	$db2->query($sql2);
	
?>

<!-- Alert Box and Goto List View -->
<script>
	alert('Delete Success');
	window.location='../index.php?v=List';
</script>
<!-- End Alert Box and Goto List View -->