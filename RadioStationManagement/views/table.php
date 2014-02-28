<?php
	require_once ('lib/DB.php');
	require_once ('lib/File.php');
	
	$File = new File();

	$DayOfWeek = array(
					'1' => array('0' => 'อาทิตย์', 'Sunday' => '1'),
					'2' => array('0' => 'จันทร์', 'Monday' => '2'),
					'3' => array('0' => 'อังคาร', 'Tuesday' => '3'),
					'4' => array('0' => 'พุธ', 'Wednesday' => '4'),
					'5' => array('0' => 'พฤหัสบดี', 'Thursday' => '5'),
					'6' => array('0' => 'ศุกร์', 'Friday' => '6'),
					'7' => array('0' => 'เสาร์', 'Saturday' => '7'),
				);
	$DayOfWeekEN = array(
			'Sunday' => '1',
			'Monday' => '2',
			'Tuesday' => '3',
			'Wednesday' => '4',
			'Thursday' => '5',
			'Friday' => '6',
			'Saturday' => '7',
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
	
	$TimeOfDayEN = array(
			'06.00' => '1',
			'07.00' => '2',
			'08.00' => '3',
			'09.00' => '4',
			'10.00' => '5',
			'11.00' => '6',
			'12.00' => '7',
			'13.00' => '8',
			'14.00' => '9',
			'15.00' => '10',
			'16.00' => '11',
			'17.00' => '12',
			'18.00' => '13',
			'19.00' => '14',
	);
	
	$db = new DB();
	$user = USER;
	if($user != "admin"){
		$sql = "SELECT DayTime, DayWeek FROM user_upload WHERE Name='$user'";
	}else{
		$sql = "SELECT DayTime, DayWeek FROM user_upload";
	}
	
	$db->query($sql);
	$ArrData = $db->fetch_array();

	$x = 0; 
	$y = 0;
	foreach($ArrData as $a){
		$xy[$x++] = $DayOfWeekEN[$a['DayWeek']];
		$xy[$x++] = $TimeOfDayEN[$a['DayTime']];
	}
	
?>
	
<div class="panel panel-primary">
	<div class="panel-heading">
		ตารางรายการเพลง
	</div>
	<div class="panel-body">
		<table class="table table-bordered" width="800" align="center" border="1">
			<?php 
			for($i=0;$i<=count($TimeOfDay);$i++){
				if($TimeOfDay[$i]=='12.00'){
			?>
			<tr bgcolor="#DDDDD">
			<?php }else{?>
			<tr>
			<?php } 
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
						for($k=0;$k<count($xy);$k+=2){
							if($xy[$k]==$j && $xy[$k+1]==$i){
					?>
					<a class="btn btn-info">
						<span class="glyphicon glyphicon-ok-sign"></span>
						&nbsp;มีไฟล์
					</a>
					<?php 	
							}
						}
					?>
				</td>
				<?php }}?>
			</tr>
			<?php }?>
		</table>
	</div>
</div>