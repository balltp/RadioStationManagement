<?php

	require_once '../lib/DB.php';
	require_once '../lib/FN.php';

	$db = new DB();
	$fn = new FN();
	
	$Day = $_GET['Day'];
	$Lid = $_GET['Lid'];

	$sql = "SELECT * 
		FROM _sublist
		WHERE L_id = '$Lid'
			AND S_day = '$Day'";
	$db->query($sql);
	
	$Data = $db->fetch_array();	
?>

<select id="Time" name="Time" class="form-control input-lg">
	<option Selected value=""></option>
	<?php foreach ($Data as $rs){ ?>
		<option value="<?php echo $rs["S_time"]; ?>"><?php echo $fn->timeToBetween($rs["S_time"])." น."; ?></option>
	<?php } ?>	
</select>	
