<?php
	require_once ('../lib/DB.php');
	$db = new DB();
	
	//DELETE SUBLIST IN DATABASE
	$sql = "DELETE FROM radio_sublist WHERE Sid = '".$_GET['Sid']."'";
	$db->query($sql);	
?>
<script>
	window.location='../index.php?v=ManageSubList';
</script>