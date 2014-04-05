<?php 
	require_once '../lib/DB.php';
	require_once '../lib/FN.php';
	
	$Fid = $_GET['PlayFid'];
	$Sid = $_GET['Sid'];
	$Lid = $_GET['Lid'];
	
	$fn = new FN();
	$db = new DB();
	$sql = "SELECT f.*, s.*, l.L_th
		FROM _files f, _sublist s, _list l
		WHERE f.F_id = '$Fid'
			AND s.S_id = '$Sid'
			AND l.L_id = '$Lid'";
	$db->query($sql);
	$Data = $db->fetch_array();
	
	foreach($Data as $rs){
		$File = $rs['F_path'].$rs['F_name'];
		$Type = $rs['F_type'];
		$List = $rs['L_th'];
		$Day = $rs['S_day'];	
		$Time = $rs['S_time'];
	}
?>

<div class="alert alert-info">

	<div class="pull-right">
		<buttom onClick="delFile(<?php echo $Fid; ?>)" class="btn btn-danger">
		<span class="glyphicon glyphicon-trash"></span> ลบไฟล์</buttom>
	</div>
	
	<div style="font-size: 22px; margin-left: 60px;">
	รายการ : <?php echo $List; ?></br >
	วัน : <?php echo $fn->dateToTH($Day); ?></br >
	เวลา : <?php echo $fn->timeToBetween($Time); ?>
	</div>
	<hr></hr >
	<div align="center">
		<audio controls>
			<source src="<?php echo $File; ?>" type="<?php $Type; ?>" />
		</audio>
	</div>
</div>