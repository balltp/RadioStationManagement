<?php
	require_once ('lib/DB.php');
	require_once ('lib/File.php');
	
	$File = new File();

	
	$DayOfWeek = array(
					'1' => array('0' => 'อาทิตย์', '1' => 'Sunday'),
					'2' => array('0' => 'จันทร์', '1' => 'Monday'),
					'3' => array('0' => 'อังคาร', '1' => 'Tuesday'),
					'4' => array('0' => 'พุธ', '1' => 'Wednesday'),
					'5' => array('0' => 'พฤหัสบดี', '1' => 'Thursday'),
					'6' => array('0' => 'ศุกร์', '1' => 'Friday'),
					'7' => array('0' => 'เสาร์', '1' => 'Saturday'),
				);
	
	$TimeOfDay = array(
					'1' => '06.00',
					'2' => '07.00',
					'3' => '08.00',
					'4' => '09.00',
					'5' => '10.00',
					'6' => '11.00',
					'7' => '12.00',
					'8' => '13.00',
					'9' => '14.00',
					'10' => '15.00',
					'11' => '16.00',
					'12' => '17.00',
					'13' => '18.00',
					'14' => '19.00',
				);
	
	$db = new DB();
	$sql = "SELECT DayTime, DayWeek FROM user_upload";
	$db->query($sql);
	$ArrData = $db->fetch_array();
	echo print_r($ArrData);
?>
	
<div class="panel panel-primary">
	<div class="panel-heading">
		ตารางรายการเพลง
	</div>
	<div class="panel-body">
		<table class="table table-bordered" width="800" align="center" border="1">
			<?php 
			for($i=0;$i<=count($TimeOfDay);$i++){
			?>
			<?php 
			if($TimeOfDay[$i]=='12.00'){
			?>
			<tr bgcolor="#DDDDD">
			<?php }else{?>
			<tr>
			<?php }?>
				<?php 
				for($j=0;$j<=count($DayOfWeek);$j++){
					if($i==0 && $j==0){?>
				<td bgcolor="#DDDDD" width="100px">
					<div style="text-align: center; font-size: 20px">วัน/เวลา</div>
				</td>
				<?php }else if($i==0 && $j>0){?>
				<td bgcolor="#DDDDD" width="100px">
					<div style="text-align: center; font-size: 22px">
						<?php echo $DayOfWeek[$j][0]; ?>
					</div>
				</td>
				<?php }else if($j==0){?>
				<td height="50px" align="center">
					<?php echo $TimeOfDay[$i]; ?>
				</td>
				<?php }else{?>
				<td align="center">
					<?php 
					
					echo $DayOfWeek[$i][$j]."<br>".$TimeOfDay[$i];
							//echo "<br>".$ArrData[0][DayWeek]; 
							?>
				</td>
				<?php }}?>
			</tr>
			<?php }?>
		</table>
	</div>
</div>