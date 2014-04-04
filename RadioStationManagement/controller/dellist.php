<?php
	require_once '../lib/DB.php';
	
	$db = new DB();
	$db2 = new DB();
	
	$sql = "DELETE FROM _list WHERE L_id='".$_GET['Lid']."'";
	$db->query($sql);
	
	$sql2 = "DELETE FROM _sublist WHERE L_id='".$_GET['Lid']."'";
	$db2->query($sql2);
?>
<script>
	window.location = '../index.php?v=ManageList';
</script>