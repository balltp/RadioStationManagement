<?php

class File{
	private $name;
		
	
	//Name File
	function getName(){
		return $this->name;
	}
	
	//Delete File
	function deleteFile($filesName, $path){
		@unlink("..".$path.$filesName);
	}
	
	//Upload File 
	function uploadFile($path, $file = array(), $total){
		$today = getdate();
		$m = $today["month"];
		$w = $today["weekday"];
		$h = $today["hours"];
		$mn = $today["minutes"];
		$s = $today["seconds"];
		$str = substr($m,0,3).strtolower(substr($w,0,2))."-".$h.$mn.$s;
		
		
		$filename = $total."_".$_POST["upload_name"]."_".$str.strtolower(substr($file["name"], -4));
		$this->name = $filename;
		$path = "..".$path;
		if(move_uploaded_file($file["tmp_name"],$path.$filename)){
			echo "<span class='label label-primary'>บันทึกข้อมูลเรียบร้อย</span>";
		}else{
			echo "<span class='label label-danger'>บันทึกข้อมูล ไม่สำเร็จ</span>";
		}
	}
	
	//Path File
	function pathFile($time='', $date=''){
		if(!(file_exists("../files"))){
			mkdir("../files");
		}
			
		if(!(file_exists("../files/$time"))){
			mkdir("../files/".$time);
		}
		
		if(!(file_exists("../files/$time/$date"))){
			mkdir("../files/".$time."/".$date);
		}
		
		
		$pathFile = "/files/".$time."/".$date."/";
		
		return $pathFile;
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
	function renameFile($oldname, $newname){
		require_once '../lib/DB.php';
		$db = new DB();
		$db2 = new DB();
	
		$newname = $newname.substr($oldname, 2);
		
		$sql = "SELECT *
			FROM user_upload
			WHERE FilesName = '$oldname'";
		$db->query($sql);
		$Data = $db->fetch_array();
		
		$path = "..".$Data[0]['FilesPath'];
		$old = $path.$oldname;
		$new = $path.$newname;

		if(rename($old, $new)){
			$sql2 = "UPDATE user_upload
				SET FilesName = '$newname'
				WHERE FilesName = '$oldname'";
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
	
}
?>