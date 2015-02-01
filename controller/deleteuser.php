<?php
	require_once ('../lib/DB.php');
	$db = new DB();
	
	$sql = "DELETE FROM _member WHERE M_id = '".$_GET['UserID']."'";
	$db->query($sql);
?>

<script>
	window.location = '../index.php?v=DeleteUser';
</script>

