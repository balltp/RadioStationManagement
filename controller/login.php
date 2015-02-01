<?php 
	session_start();
	include_once("../lib/DB.php");
	include_once("../lib/config.php");
	
	if(!empty($_POST)){
		$db = new DB();
		$sql = "SELECT M_user, M_pass, M_level
			FROM _member 
			WHERE M_user = '".$_POST["user"]."' 
				AND M_pass = '".$_POST["pass"]."' LIMIT 1";
		
		$db->query($sql);
		if($db->fetch_array()){		
			$_SESSION["USER"] = $_POST["user"];
			foreach($db->fetch_array() as $data){
				$level = $data["M_level"];
			}
			$_SESSION["LEVEL"] = $level;
			session_write_close();
			header("location:../index.php");
		}else{
			header("location:../index.php?errorUS=".$_POST["user"]);
		}
	}
?>