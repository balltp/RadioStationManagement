<?php
	require_once 'lib/DB.php';
	
	$db = new DB();
	$sql = "SELECT * FROM radio_list WHERE Lid='".$_GET['Lid']."' LIMIT 1";
	$db->query($sql);
	$Data = $db->fetch_array();
?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<strong style="font-size: 20px">แก้ไข รายการ</strong>
	</div>
	<div class="panel-body">
		<form action="controller/editlist.php?Lid=<?php echo $_GET['Lid']; ?>" method="POST" id="frmEditList">
			<input type="hidden" value="<?php echo $Data[0]['Lid']; ?>" name="Lid" />
			<input class="form-control input-lg" type="text" value="<?php echo $Data[0]['title'];?>" name="title" /></br>
			<input class="form-control input-lg" type="text" value="<?php echo $Data[0]['title_en'];?>" name="title_en" /></br>
			<button class="btn btn-success btn-lg" type="submit">บันทึก</button>
			<a class="btn btn-default btn-lg" onClick="JavaScript:window.location='index.php?v=ManageList'">ยกเลิก</a>
		</form>
	</div>
</div>