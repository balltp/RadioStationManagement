<?php
	require_once ('../lib/File.php');
	require_once ('../lib/DB.php');
	require_once ('../lib/GenListFile.php');
	require_once ('../lib/FN.php');
	
	$file = new File();
	$db = new DB();
	$db2 = new DB();
	$db3 = new DB();
	$db4 = new DB();
	$fn = new FN();
	
	$file->checkFile();
	
	$Name = $_GET["user"];
	$Date = $_POST['Date'];
	$Day = explode(":", $_POST["List"]);
	$Lid = $Day[0];
	$Fday = $Day[1];
	$Ftime = $_POST["Time"];
	
	//QUERY L_EN FROM _list
	$sql4 = "SELECT L_en
	FROM _list
	WHERE L_id = '$Lid'";
	$db4->query($sql4);
	$Data4 = $db4->fetch_array();
	$L_en = $Data4[0]['L_en'];
	
	//ORDER FILE FROM DATABASE
	$sql2 = "SELECT *
	FROM _sublist
	WHERE L_id='$Lid'
	AND S_day='$Fday'
	AND S_time='$Ftime'
	LIMIT 1";
	$db2->query($sql2);
	$Data2 = $db2->fetch_array();
	$total = $Data2[0]['S_order'];
	$Sid = $Data2[0]['S_id'];
	
	//QUERY S_ID FROM DATABASE
	$db5 = new DB();
	$sql5 = "SELECT S_id
	FROM _sublist
	WHERE L_id = '$Lid'
		AND S_day = '$Fday'
		AND S_time = '$Ftime'";
	$db5->query($sql5);
	$Data = $db5->fetch_array();
	$Sid = $Data[0]['S_id'];
	
	//QUERY CHECK FOR HAVE FILE ?
	$db6 = new DB();
	$sql6 = "SELECT *
	FROM _files
	WHERE S_id = '$Sid'
		AND L_id = '$Lid'
		AND F_date = '$Date'";
	$db6->query($sql6);
	$Data2 = $db6->fetch_array();

	if(empty($Data2)){
		//UPLOAD FILE TO SERVER
		$FilesPath = $file->pathFile($Ftime, $Fday, $Date);
		$file->uploadFile($FilesPath, $_FILES["upload_file"], $total, $L_en);
		
		$FilesName = $file->getName();
		$Size = $_FILES["upload_file"]["size"];
		$ContentType = $_FILES["upload_file"]["type"];
		
		//SAVE DATA TO DATABASE
		$sql = "INSERT INTO _files
		VALUES (NULL, '".$FilesName."', '".$Name."', '".$Lid."', '".$Sid."', '".$Date."', '".$ContentType."', '".$Size."', '".$FilesPath."')";
				$db->query($sql);
		
		//CHANGE STATUS FROM N => Y IN DATABASE
		$sql3 = "UPDATE _sublist
		SET S_status='Y'
		WHERE S_id='$Sid'";
		$db3->query($sql3);
	}else{
		$Fid = $Data2[0]['F_id'];
		$FilesPath = $Data2[0]['F_path'];
		$FilesName = $Data2[0]['F_name'];
		$Size = $_FILES["upload_file"]["size"];
		$ContentType = $_FILES["upload_file"]["type"];
		
		//DELECT OLD FILE
		$file->deleteFile($FilesName, $FilesPath);
		
		//UPLOAD FILE TO SERVER
		$file->uploadFile($FilesPath, $_FILES["upload_file"], $total, $L_en);
	
		$Fname = $file->getName();
		
		//SAVE DATA TO DATABASE
		$sql = "UPDATE _files
			SET F_name = '$Fname', M_user = '$Name', F_type = '$ContentType', F_size = '$Size'
			WHERE F_id = '$Fid'";
		$db->query($sql);
	}

?>
