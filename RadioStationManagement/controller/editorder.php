<?php
	require_once '../lib/DB.php';
	require_once '../lib/File.php';
	
	$file = new File();
	
	$Sid = $_GET['Sid'];
	$Sorder = $_GET['Sorder'];
	$Mode = $_GET['Mode'];
	$Day = $_GET['Day'];
	$Time = $_GET['Time'];
	$Status = $_GET['Status'];
	
	if($Mode == "Up"){
		$pSid = $_GET['pSid'];
		$newOrder = $Sorder-1;
		
		//QUERY STATUS FROM PREVIOUS S_ID
		$db6 = new DB();
		$sql6 = "SELECT S_status FROM _sublist WHERE S_id = '$pSid'";
		$db6->query($sql6);
		$Data6 = $db6->fetch_array();
		$pStatus = $Data6[0]['S_status'];
		
		//CURRENT HAVE FILE UPLOAD
		if($Status=="Y"){
			$file->renameFile($Sid, $newOrder);
		}
		
		//PREVIOUS HAVE FILE UPLOAD
		if($pStatus=="Y"){
			$file->renameFile($pSid, $Sorder);
		}

		//CHANGE ORDER IN CURRENT
		$db = new DB();
		$sql = "UPDATE _sublist SET S_order = '$newOrder' WHERE S_id='$Sid'";
		$db->query($sql);
		
		//CHANGE ORDER IN PREVIOUS
		$db2 = new DB();
		$sql2 = "UPDATE _sublist SET S_order = '$Sorder' WHERE S_id='$pSid'";
		$db2->query($sql2);

	}else{
		//FIND NEXT S_ID
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
		
		//QUERY STATUS FROM NEXT S_ID
		$db7 = new DB();
		$sql7 = "SELECT S_status FROM _sublist WHERE S_id = '$pSid'";
		$db7->query($sql7);
		$Data7 = $db7->fetch_array();
		$pStatus = $Data7[0]['S_status'];
		
		$newOrder = $Sorder+1;
		
		//CURRENT HAVE FILE UPLOAD
		if($Status=="Y"){
			$file->renameFile($Sid, $newOrder);
		}
		
		//NEXT HAVE FILE UPLOAD
		if($pStatus=="Y"){
			$file->renameFile($pSid, $Sorder);
		}
		
		//CHANGE ORDER IN CURRENT
		$db4 = new DB();
		$sql4 = "UPDATE _sublist SET S_order = '$newOrder' WHERE S_id='$Sid'";
		$db4->query($sql4);
		
		//CHANGE ORDER IN NEXT
		$db5 = new DB();
		$sql5 = "UPDATE _sublist SET S_order = '$Sorder' WHERE S_id='$pSid'";
		$db5->query($sql5);
	}
?>