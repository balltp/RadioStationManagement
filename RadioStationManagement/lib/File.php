<?php

class File{
	private $name;
		
	
	//Name File
	public function getName(){
		return $this->name;
	}
	
	//Delete File
	public function deleteFile($filesName, $path){
		@unlink("..".$path.$filesName);
	}
	
	//Upload File 
	public function uploadFile($path, $file = array(), $total){
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
	public function pathFile($time='', $date=''){
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
}
?>