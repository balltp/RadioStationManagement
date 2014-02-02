<?php
	require_once ('../lib/DB.php');
	$db = new DB();
	
	$sql = "DELETE FROM member WHERE id = '".$_GET['UserID']."'";
	$db->query($sql);
?>

<script>
	window.location = '../index.php?v=DeleteUser';
</script>

