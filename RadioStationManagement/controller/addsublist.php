<?php
	require_once ('../lib/DB.php');
	require_once ('../lib/FN.php');
	$db2 = new DB();
	$fn = new FN();

	foreach($_POST['d'] as $d){
		$d = $fn->dateToEN($d);
		$order = $fn->findMax($d, $_POST['Time'], "../") + 1;

		$sql2 = "INSERT INTO _sublist VALUES ";
		$sql2 .= "(NULL, '".$_GET['Lid']."', '$d', '".$_POST['Time']."', '$order', 'N')";
		$db2->query($sql2);
	}
?>