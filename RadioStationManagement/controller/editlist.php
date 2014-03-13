<?php
	require_once '../lib/DB.php';
	
	$db = new DB();
	$sql = "UPDATE radio_list SET title='".$_POST['title']."',
		title_en='".$_POST['title_en']."' WHERE Lid='".$_POST['Lid']."'";
	$db->query($sql);
?>
<script>
	alert('แก้ไขเรียบร้อย');
	window.location = '../index.php?v=ManageList';
</script>