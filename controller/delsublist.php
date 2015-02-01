<?php
	require_once ('../lib/DB.php');
	require_once ('../lib/FN.php');
	require_once ('../lib/File.php');
	
	$db = new DB();
	$db2 = new DB();
	$db3 = new DB();
	$db7 = new DB();
	
	$fn = new FN();
	$file = new File();
	
	$Sid = $_GET['Sid'];
	
	$db6 = new DB();
	$sql6 = "SELECT * FROM _files";
	$db6->query($sql6);
	$Data6 = $db6->fetch_array();
	
	$sql = "SELECT * FROM _sublist WHERE S_id = '$Sid'";
	$db->query($sql);
	foreach($db->fetch_array() as $rs){
		$Lid = $rs['L_id'];
		$Sorder = $rs['S_order'];
		$Sday = $rs['S_day'];
		$Stime = $rs['S_time'];
		$Status = $rs['S_status'];
	}
	
	$Max = $fn->findMax($Sday, $Stime, "../");
	
	$sql3 = "DELETE FROM _sublist WHERE S_id = '$Sid'";
	$db3->query($sql3);	
	
	foreach($Data6 as $d){
		if($Sid == $d['S_id'] && $Status == "Y"){
			$file->deleteFile($d['F_name'], $d['F_path']);
			
			$sql7 = "DELETE FROM _files WHERE S_id = '$Sid'";
			$db7->query($sql7);
		}
	}
	
	if($Sorder != $Max){
		$sql2 = "SELECT s.*
			FROM _sublist s
			WHERE s.S_day = '$Sday'
				AND s.S_time = '$Stime'
				AND s.S_order > '$Sorder'
			ORDER BY s.S_order ASC";
		$db2->query($sql2);
		
		$db5 = new DB();
		
		foreach($db2->fetch_array() as $rs){
			//UPDATE ORDER IN DATABASE _SUBLIST
			$Sid = $rs['S_id'];
			$Sorder = $rs['S_order']-1;
			$sql5 = "UPDATE _sublist SET S_order = '$Sorder' WHERE S_id='$Sid'";
			$db5->query($sql5);
			
			$Status = $rs['S_status'];
			foreach($Data6 as $d){
				if($Sid == $d['S_id'] && $Status == "Y"){
					$file->renameFile($Sid, $Sorder);
				}
			}
		}
	}

	
?>