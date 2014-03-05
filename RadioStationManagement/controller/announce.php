<?php
	require_once ('../lib/DB.php');
	$db = new DB();
	$sql = "SELECT * FROM announce WHERE an_id = 000";
	$sql = "DELETE FROM announce WHERE an_id = 000";
		$sql = "INSERT INTO announce VALUES (0, '".$_POST["an_text"]."')";
		$db->query($sql);
		header("location:../index.php");
?>