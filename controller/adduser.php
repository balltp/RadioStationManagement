<?php
	require_once ('../lib/DB.php');
	$db = new DB();
	
	if(empty($_POST["us"])||empty($_POST["pw"])||empty($_POST["name"])){
		header("location:../index.php?v=AddUser&user=".$_POST["us"]."&name=".$_POST["name"]);
	}else{
		$sql = "INSERT INTO _member VALUES (NULL, '".$_POST["name"]."', '".$_POST["lname"]."', '".$_POST["us"]."', '".$_POST["pw"]."', '".$_POST["level"]."')";
		$db->query($sql);	
		header("location:../index.php");
	}

?>