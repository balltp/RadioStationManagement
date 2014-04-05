<?php
	require_once 'lib/DB.php';
	require_once 'lib/FN.php';
	
	$db = new DB();
	$db2 = new DB();
	$fn = new FN();
	
	$sql = "SELECT * FROM radio_list";
	$db->query($sql);
	$Data = $db->fetch_array();
	
	$sql2 = "SELECT time FROM radio_sublist GROUP BY time";
	$db2->query($sql2);
	$Data2 = $db2->fetch_array();
	
	$day = $fn->getDayTH();
	$time = $fn->getTime();
?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<strong style="font-size: 25px">เพิ่มรายการย่อย </strong>
	</div>
	
	<div class="panel-body">
		<form method="POST" id="frmSublist">
			<div class="input-group">
				<span class="input-group-addon">
					<strong style="font-size: 20px">วัน :</strong>
				</span>
				<div class="btn-group" data-toggle="buttons"> 
					
				<?php for($i=0;$i<count($day);$i++){?>
					<label class="btn btn-default">
				    	<input type="checkbox" name="d[]" value="<?php echo $day[$i]; ?>">
				    	&nbsp;<?php echo $day[$i];?>
				  	</label>
				<?php } ?>
				</div>
			</div></br>

			<div class="input-group">
				<span class="input-group-addon">
					<strong style="font-size: 20px">เวลา :</strong>
				</span>
				<select name="Time" class="form-control input-lg">
					<option value=""></option>
					<?php for($i=0;$i<count($time)-1;$i++){?>
						<option value="<?php echo $time[$i]; ?>">
							<?php echo $time[$i]." - ".$time[$i+1];?>
						</option>
					<?php } ?>
				</select>
			</div></br>
			
			<div class="input-group">
				<span class="input-group-addon">
				  	<strong style="font-size: 20px">รายการ :</strong>
				</span>
				<select name="List" class="form-control input-lg">
					<option value=""></option>
					<?php for($i=0;$i<count($Data);$i++){?>
						<option value="<?php echo $Data[$i]['Lid']; ?>">
							<?php echo $Data[$i]['title'];?>
						</option>
					<?php } ?>
				</select>
			</div></br>	

			<div class="input-group">
			  <span class="input-group-addon">
			  	<strong style="font-size: 20px">ลำดับ :</strong>
			  </span>
			  <input type="text" name="order" class="form-control input-lg">
			</div></br>

			<div align="center">
				<input type="submit" id="save" value="บันทึก" class="btn btn-primary btn-lg" />
				<input type="reset" id="reset" value="ยกเลิก" class="btn btn-default btn-lg" />
			</div>
		</form>	
	</div>
</div>

<script type="text/javascript">	
	$(function(){
		$("#frmSublist").submit(function(){
			$.post( "controller/addsublist.php", $( "#frmSublist" ).serialize() );
			alert('บันทึกเรียบร้อย');
		});
	});
</script>