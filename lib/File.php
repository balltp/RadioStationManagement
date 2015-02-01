<?php

class File{
	private $name;
		
	
	//NAME FILE
	function getName(){
		return $this->name;
	}
	
	//DELETE FILE
	function deleteFile($filesName, $path){
		@unlink("../".$path.$filesName);
	}
	
	//UPLOAD FILE TO SERVER 
	function uploadFile($path, $file = array(), $total, $L_en){
		$number = rand();
		$tmp_type = explode("/", $file['type']);
		$type = $tmp_type[1];
		
		$filename = $total."_".$L_en."-".$number.".".$type;
		$this->name = $filename;
		$path = "../".$path;
		if(move_uploaded_file($file["tmp_name"],$path.$filename));
	}
	
	//PATH FILE
	function pathFile($time='', $day='', $date=''){
		//SUBSTR DATE
		$Mdate = substr($date, 0, 7);
		$Ddate = substr($date, -2);
		
		if(!(file_exists("../files"))){
			mkdir("../files");
		}
		
		if(!(file_exists("../files/$Mdate"))){
			mkdir("../files/".$Mdate);
		}
		
		if(!(file_exists("../files/$Mdate/$Ddate"))){
			mkdir("../files/".$Mdate."/".$Ddate);
		}
		
		if(!(file_exists("../files/$Mdate/$Ddate/$day"))){
			mkdir("../files/".$Mdate."/".$Ddate."/".$day);
		}

		if(!(file_exists("../files/$Mdate/$Ddate/$day/$time/"))){
			mkdir("../files/".$Mdate."/".$Ddate."/".$day."/".$time);
		}
		
		$path = "files/".$Mdate."/".$Ddate."/".$day."/".$time."/";
		
		return $path;
	}
	
	//GET FILE NAME FROM DATABASE
	function getFileNameDB($day, $time, $list){
		require_once 'lib/DB.php';
		$db = new DB();
		
		$sql = "SELECT *
			FROM user_upload
			WHERE DayWeek = '$day'
				AND DayTime = '$time'
				AND List = '$list'";
		$db->query($sql);
		$Data = $db->fetch_array();
		
		return $Data[0]['FilesName'];	
	}
	
	//RENAME FILE ON SERVER AND DATABASE
	function renameFile($Sid, $newOrder){
		if(strlen($newOrder)==1){
			$newOrder = "0".$newOrder;
		}
		
		require_once '../lib/DB.php';
		$db = new DB();
		$db2 = new DB();

		$sql = "SELECT *
			FROM _files
			WHERE S_id = '$Sid'";
		$db->query($sql);
		$Data = $db->fetch_array();
		
		foreach($Data as $rs){
			$Fid = $rs['F_id'];
			$path = "../".$rs['F_path'];
			$Name = $rs['F_name'];
			
			$newname = $newOrder.substr($Name, 2);
			$old = $path.$Name;
			$new = $path.$newname;
	
			if(rename($old, $new)){
				$sql2 = "UPDATE _files
					SET F_name = '$newname'
					WHERE F_id = '$Fid'";
				$db2->query($sql2);
			}
		}
	}	
	
	function checkFile(){
		require_once '../lib/DB.php';
		$db = new DB();
		$db2 = new DB();
		$db3 = new DB();
		
		$sql = "SELECT * FROM _files";
		$db->query($sql);
		
		foreach($db->fetch_array() as $rs){
			$file = "../".$rs['F_path'].$rs['F_name'];
			if(!file_exists($file)){
				$Sid = $rs['S_id'];
				$sql2 = "UPDATE _sublist
					SET S_status = 'N'
					WHERE S_id = '$Sid'";
				$db2->query($sql2);
				
				$Fid = $rs['F_id'];
				$sql3 = "DELETE FROM _files WHERE F_id = '$Fid'";
				$db3->query($sql3);
			}
		}
	}

	//DELETE FILE FROM DATABASE
	function deleteFileDB($Lid){
		require_once '../lib/DB.php';
		$db = new DB();
		
		$sql = "DELETE FROM _files WHERE L_id = '$Lid'";
		$db->query($sql);
	}
	
	//CHECK FILE HAVE TODAY
	function checkToday($Sid, $Lid){
		require_once 'lib/DB.php';
		
		$today = date("Y-m-d");
		
		$db = new DB();
		$sql = "SELECT * 
			FROM _files
			WHERE S_id = '$Sid'
				AND L_id = '$Lid'
				AND F_date = '$today'";
		$db->query($sql);
		
		if($db->fetch_array()){
			return true;	
		}else{
			return false;
		}

	}
	
}
?>