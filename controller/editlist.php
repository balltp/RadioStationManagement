<?php
	require_once '../lib/DB.php';
	
	$db = new DB();
	$sql = "UPDATE _list SET L_th='".$_POST['title']."',
		L_en='".$_POST['title_en']."' WHERE L_id='".$_POST['Lid']."'";
	$db->query($sql);
?>

<script>
	alert('แก้ไขเรียบร้อย');
	window.location = '../index.php?v=EditList&Lid=<?php echo $_POST['Lid']; ?>';
</script>