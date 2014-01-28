<?php
class File{
	private $name;
	
	//Name File
	public function getName(){
		return $this->name;
	}
	
	//Delete File
	public function deleteFile($filesName){
		@unlink("../files/".$filesName);
	}
	
	//Upload File 
	public function uploadFile($file = array()){
		$today = getdate();
		$m = $today["month"];
		$w = $today["weekday"];
		$h = $today["hours"];
		$mn = $today["minutes"];
		$s = $today["seconds"];
		$str = substr($m,0,3).strtolower(substr($w,0,2))."-".$h.$mn.$s;
			
		$filename = $str.strtolower(substr($file["name"], -4));
		$this->name = $filename;
			
		if(move_uploaded_file($file["tmp_name"],"../files/".$filename)){
			//header("location:../index.php?upload=success");
			echo "ok";
		}else{
			//header("location:../index.php?upload=fail");
			echo "no";
		}
	}
}
?>