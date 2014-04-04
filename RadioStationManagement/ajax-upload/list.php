<?php

	require_once '../lib/DB.php';
	require_once '../lib/FN.php';
	
	$db = new DB();
	$fn = new FN();
	
	$Lid = $_GET['id'];
	$sql = "SELECT * 
		FROM radio_sublist
		WHERE Lid = '$Lid'";
	$db->query($sql);
	
	$Data = $db->fetch_array();	
?>

<select id="DayMonth" name="DayMonth" onChange="dropdownDayWeek()" class="form-control input-lg">
	<option selected value=""></option>
	<?php 
		$strStartDate = date('Y-m-d');
		$strEndDate = date('Y-m-d',strtotime('+3 week'));
		while(strtotime($strStartDate) <= strtotime($strEndDate)){
	
	  	$day = $strStartDate;
		$day = explode("-",$day);
	
		$jd=cal_to_jd(CAL_GREGORIAN,$day[1],$day[2],$day[0]); //2011-01-29
		
			foreach($Data as $rs){
				if(jddayofweek($jd,1) == $rs['day']){
	?>
	
	<option value="<?php echo $strStartDate.":".jddayofweek($jd,1); ?>"><?php echo $strStartDate." | วัน".$fn->dateToTH(jddayofweek($jd,1)); ?></option>
	
	<?php 
				}
			}
		$strStartDate = date('Y-m-d', strtotime("+1 day", strtotime($strStartDate)));
		} 
	?>
</select>	
