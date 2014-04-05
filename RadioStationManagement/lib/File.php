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
		$type = strtolower(substr($file["name"], -4));
		
		$filename = $total."_".$L_en."-".$number.$type;
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
		
		if(!(file_exists("../files/$Mdate/$Ddate/$time"))){
			mkdir("../files/".$Mdate."/".$Ddate."/".$time);
		}

		if(!(file_exists("../files/$Mdate/$Ddate/$time/$day"))){
			mkdir("../files/".$Mdate."/".$Ddate."/".$time."/".$day);
		}
		
		$path = "files/".$Mdate."/".$Ddate."/".$time."/".$day."/";
		
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
		
		$Fid = $Data[0]['F_id'];
		$path = "../".$Data[0]['F_path'];
		$Name = $Data[0]['F_name'];
		
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
	
	//UPDATE ORDER IN DATABASE
	function updateOrderDB($Sid, $Order){
		require_once '../lib/DB.php';
		$db = new DB();

		for($i=0; $i<COUNT($Sid); $i++){
			$Sorder = $Order[$i];
			$id = $Sid[$i];

			$sql = "UPDATE radio_sublist
				SET Sorder = '$Sorder'
				WHERE Sid = '$id'";
			$db->query($sql);
		}
	}
	
	//CHECK FILE IN SERVER
	function checkFile($Sid){
		require_once 'lib/DB.php';
		$db = new DB();
		
		$sql = "SELECT * 
			FROM _files
			WHERE S_id = '$Sid'";
		$db->query($sql);
		$Data = $db->fetch_array();
		
		$file = $Data[0]['F_path'].$Data[0]['F_name'];

		if(!file_exists($file)){
			return true;
		}else{
			return false;
		}
	}
	
}
?>