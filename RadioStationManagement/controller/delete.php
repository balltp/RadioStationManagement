<?php
	require_once ('../lib/File.php');
	require_once ('../lib/DB.php');
	$file = new File();
	$db = new DB();
	
	$sql = "SELECT * FROM user_upload WHERE FilesID = '".$_GET['ID']."'";
	$db->query($sql);
	foreach($db->fetch_array() as $rs){
		$file_name = $rs['FilesName'];	
		$file_path = $rs['FilesPath'];
	}
	
	//delete data in database
	$sql = "DELETE FROM user_upload WHERE FilesID = '".$_GET['ID']."'";
	$db->query($sql);
	//delete file in server
	$file->deleteFile($file_name, $file_path);
	
?>

<!-- Alert Box and Goto List View -->
<script>
	alert('Delete Success');
	window.location='../index.php?v=List';
</script>
<!-- End Alert Box and Goto List View -->