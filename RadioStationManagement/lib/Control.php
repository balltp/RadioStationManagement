<?php
	class Control{
		
		public function content($v=''){
			if(empty($v))
			{
				return require_once('views/jamboContent.php');
			}
			else if($v == "Upload")
			{
				return require_once ('ajax-upload/index.php');
			}
			else if($v == "List")
			{
				return require_once ('views/list.php');
			}
			else if($v == "Delete")
			{
				return require_once ('views/delete.php');
			}
			else if($v == "AddUser")
			{
				return require_once ('views/adduser.php');
			}
			else if($v == "permission")
			{
				return require_once ('views/permission.php');
			}
			else if($v =="play")
			{
				return require_once ('views/play.php');
			}
			else if($v == "DeleteUser")
			{
				return require_once ('views/deleteuser.php');
			}
			else if($v == "Table")
			{
				return require_once('views/table.php');
			}
		}
		
		public function checkLevel($level){
			if($level == "ADMIN"){
				return true;
			}else{
				return false;
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