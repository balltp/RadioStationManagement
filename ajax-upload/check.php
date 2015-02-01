<?php
	require_once '../lib/DB.php';
	
	$Lid = $_GET['Lid'];
	$Day = $_GET['Day'];
	$Time = $_GET['Time'];
	$Date = $_GET['Date'];
	
	$db = new DB();
	$sql = "SELECT S_id
		FROM _sublist
		WHERE L_id = '$Lid'
			AND S_day = '$Day'
			AND S_time = '$Time'";
	$db->query($sql);
	$Data = $db->fetch_array();
	$Sid = $Data[0]['S_id'];
	
	$db2 = new DB();
	$sql2 = "SELECT *
		FROM _files
		WHERE S_id = '$Sid'
			AND L_id = '$Lid'
			AND F_date = '$Date'";
	$db2->query($sql2);
	$Data2 = $db2->fetch_array();
	
	$User = $Data2[0]['M_user'];
	if(!empty($Data2)){
		echo "N-".$User;
	}else{
		echo "P-ว่าง";
	}
	
	
?>