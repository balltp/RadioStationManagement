<?php
	require_once ('../lib/DB.php');
	require_once ('../lib/FN.php');
	require_once ('../lib/File.php');
	
	$file = new File();
	$fn = new FN();
	
	$db = new DB();
	$db2 = new DB();
	$db3 = new DB();
	$db4 = new DB();
	
	$db5 = new DB();
	
	
	$db8 = new DB();
	
	$Lid = $_GET['Lid'];
	
	$sql4 = "SELECT * FROM _sublist WHERE L_id = '$Lid'";
	$db4->query($sql4);
	$Data4 = $db4->fetch_array();

	foreach ($Data4 as $d4){
		$Sid = $d4['S_id'];
		
		$db6 = new DB();
		$sql6 = "SELECT * FROM _sublist WHERE S_id = '$Sid'";
		$db6->query($sql6);
		foreach($db6->fetch_array() as $rs){
			$Lid = $rs['L_id'];
			$Sorder = $rs['S_order'];
			$Sday = $rs['S_day'];
			$Stime = $rs['S_time'];
			$Status = $rs['S_status'];
		}

		$Max = $fn->findMax($Sday, $Stime, "../");

		if($Sorder != $Max){
			$db7 = new DB();
			$sql7 = "SELECT s.*
				FROM _sublist s
				WHERE s.S_day = '$Sday'
					AND s.S_time = '$Stime'
					AND s.S_order > '$Sorder'
				ORDER BY s.S_order ASC";
			$db7->query($sql7);

			foreach($db7->fetch_array() as $rs){
				//UPDATE ORDER IN DATABASE _SUBLIST
				$Sid = $rs['S_id'];
				$Sorder = $rs['S_order']-1;
			
				$sql5 = "UPDATE _sublist SET S_order = '$Sorder' WHERE S_id='$Sid'";
				$db5->query($sql5);
			}
		}
	}
	
	//DELETE FROM DB _LIST
	$sql = "DELETE FROM _list WHERE L_id='$Lid'";
	$db->query($sql);
	
	//DELETE FROM DB _SUBLIST
	$sql2 = "DELETE FROM _sublist WHERE L_id='$Lid'";
	$db2->query($sql2);
	
	//DELETE FILE ON SERVER
	$sql3 = "SELECT * 
		FROM _files 
		WHERE L_id = '$Lid'";
	$db3->query($sql3);
	$Data3 = $db3->fetch_array();
	foreach($Data3 as $rs){
		$file->deleteFile($rs['F_name'], $rs['F_path']);
	}
	//DELETE FROM DB _FILES
	$file->deleteFileDB($Lid);

?>