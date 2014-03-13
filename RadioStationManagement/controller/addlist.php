<?php
	require_once ('../lib/DB.php');
	$db = new DB();
	
	$sql = "INSERT INTO radio_list VALUES(NULL, '".$_POST['title']."', '".$_POST['title_en']."')";
	$db->query($sql);
?>
