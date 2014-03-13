<?php
	require_once '../lib/DB.php';
	
	$db = new DB();
	
	$sql = "DELETE FROM radio_list WHERE Lid='".$_GET['Lid']."'";
	$db->query($sql);
?>
<script>
	window.location = '../index.php?v=ManageList';
</script>