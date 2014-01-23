<?php 
	session_start();
	include_once("../lib/DB.php");
	include_once("../lib/config.php");
	
	if(!empty($_POST)){
		$db = new DB();
		$db->query("SELECT * FROM member WHERE username = '".$_POST["user"]."' AND password = '".$_POST["pass"]."'");
		if($db->fetch_array()){
			$_SESSION["USER"] = $_POST["user"];
			session_write_close();
			header("location:../index.php");
		}else{
			header("location:../index.php?errorUS=".$_POST["user"]);
		}
	}
?>