<?php
	require_once ('../lib/DB.php');
	$db = new DB();
	$s = $_POST['an_text'];
	$sql = "UPDATE _announce SET an_text='$s' WHERE an_id = 000";
	$db->query($sql);
?>

<script>
	alert('บันทึกสำเร็จ');
	window.location='../index.php?v=Announce';
</script>