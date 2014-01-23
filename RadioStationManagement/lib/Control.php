<?php
	class Control{
		private $name;
		
		public function content($v=''){
			if(empty($v) || $v == "Upload"){
				return require_once ('views/upload.php');
			}else if($v == "List"){
				return require_once ('views/list.php');
			}
		}
		
		public function goPage($page){
			header("location:../".$page);
		}

		public function getName(){
			return $this->name;
		}
		
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
		
		public function viewMenu(){
			return require_once ('views/menu.php');
		}
		
		public  function viewUpload(){
			return require_once ('views/upload.php');
		}
		
		public function viewLogin(){
			return require_once ('views/login.php');
		}
	}
?>