<?php
	require_once '../lib/DB.php';
	
	$Sid = $_GET['Sid'];
	$pSid = $_GET['pSid'];
	$Sorder = $_GET['Sorder'];
	$Mode = $_GET['Mode'];
	$Day = $_GET['Day'];
	$Time = $_GET['Time'];
	
	if($Mode == "Up"){
		$newOrder = $Sorder-1;
		$db = new DB();
		$sql = "UPDATE _sublist SET S_order = '$newOrder' WHERE S_id='$Sid'";
		$db->query($sql);
		
		$db2 = new DB();
		$sql2 = "UPDATE _sublist SET S_order = '$Sorder' WHERE S_id='$pSid'";
		$db2->query($sql2);
	}else{
		$db3 = new DB();
		$sql3 = "SELECT *
			FROM _sublist
			WHERE S_day = '$Day'
				AND S_time = '$Time'
			ORDER BY S_order DESC";
		$db3->query($sql3);
		$Data = $db3->fetch_array();
		
		for($i=0; $i<COUNT($Data); $i++){
			if($Sid == $Data[$i]['S_id']){
				$pSid = $Data[$i-1]['S_id'];
			}
		}
		
		$newOrder = $Sorder+1;
		$db4 = new DB();
		$sql4 = "UPDATE _sublist SET S_order = '$newOrder' WHERE S_id='$Sid'";
		$db4->query($sql4);
		
		$db5 = new DB();
		$sql5 = "UPDATE _sublist SET S_order = '$Sorder' WHERE S_id='$pSid'";
		$db5->query($sql5);
	}
?>