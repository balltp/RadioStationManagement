<?php
	require_once ('../lib/DB.php');
	require_once ('../lib/FN.php');
	$db = new DB();
	$fn = new FN();
	
	foreach($_POST['d'] as $d){
		$d = $fn->dateToEN($d);
		$sql = "INSERT INTO radio_sublist VALUES ";
		$sql .= "(NULL, '".$_POST['List']."', '$d', '".$_POST['Time']."', '".$_POST['order']."', 'N')";
		$db->query($sql);
	}
?>