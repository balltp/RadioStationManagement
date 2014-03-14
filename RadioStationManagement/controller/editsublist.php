<?php
	require_once '../lib/File.php';
	
	$file = new File();
	
	$Sid = $_POST['Sid'];
	$Order = $_POST['order'];
	$Name = $_POST['name'];
	
	if(!empty($Name)){
		for($i=0; $i<count($Order); $i++){
			foreach ($Name as $str){
				$exp = explode(":", $str);
				if($exp[0]==$Sid[$i]){
					$file->renameFile($exp[1], $Order[$i]);
				}
			}
		}
	}
	
	$file->updateOrderDB($Sid, $Order);
	
?>

<script>
	alert('Update Success');
	window.location = '../index.php?v=ManageSubList';
</script>