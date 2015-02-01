<?php

	require_once '../lib/DB.php';
	require_once '../lib/FN.php';
	
	$db = new DB();
	$fn = new FN();
	
	$Date = $_GET['Date'];
	
	$day = $Date;
	$day = explode("-",$day);
	
	$jd=cal_to_jd(CAL_GREGORIAN,$day[1],$day[2],$day[0]);
	$dayOfweek = jddayofweek($jd,1);

	$sql = "SELECT s.*, l.* 
		FROM _sublist s, _list l
		WHERE s.S_day = '$dayOfweek'
			AND s.L_id = l.L_id
		GROUP BY l.L_th
		ORDER BY l.L_id DESC";
	$db->query($sql);
	
	$Data = $db->fetch_array();	
?>

<?php if(!empty($Data)){ ?>
<select id="List" name="List" onChange="dropdownTime()" class="form-control input-lg">
	<option selected value=""></option>
	<?php foreach ($Data as $rs){ ?>
	<option value="<?php echo $rs['L_id'].":".$rs['S_day']; ?>"><?php echo $rs['L_th']; ?></option>
	<?php } ?>
</select>
<?php }else{
	echo "ไม่พบรายการของวัน".$fn->dateToTH($dayOfweek)." !!!";
}
?>
	

