<?php
	require_once 'lib/DB.php';
	require_once 'lib/FN.php';
	
	$db = new DB();
	$db2 = new DB();
	
	$sql = "SELECT * FROM _list WHERE L_id='".$_GET['Lid']."' LIMIT 1";
	$db->query($sql);
	$Data = $db->fetch_array();
	
	$Lid = $_GET['Lid'];
	$sql2 = "SELECT *
		FROM _sublist
		WHERE L_id = '$Lid'";
	$db2->query($sql2);
	$Data2 = $db2->fetch_array();
	
	$fn = new FN();
	$day = $fn->getDayTH();
	$time = $fn->getTime();
?>

<div id="dialog2" title="แก้ไขรายการ">
	<div class="alert alert-info">
		<form action="controller/editlist.php?Lid=<?php echo $_GET['Lid']; ?>" method="POST" id="frmEditList">
			<input type="hidden" value="<?php echo $Data[0]['L_id']; ?>" name="Lid" />
			<input class="form-control input-lg" type="text" value="<?php echo $Data[0]['L_th'];?>" name="title" /></br>
			<input class="form-control input-lg" type="text" value="<?php echo $Data[0]['L_en'];?>" name="title_en" /></br>
			<button class="btn btn-success btn-lg" type="submit">บันทึก</button>
			<a class="btn btn-default btn-lg" onClick="modalHide()">ยกเลิก</a>
		</form>
	</div>
</div>

<div id="dialog" title="เพิ่มรายการย่อย">
	<div class="alert alert-info">
		</br>
		<form method="POST" id="frmSublist">
			<div class="input-group">
				<span class="input-group-addon"> 
				<strong style="font-size: 20px">วัน :</strong>
				</span>
				<div class="btn-group" data-toggle="buttons">
					<?php for($i=0;$i<count($day);$i++){?>
					<label class="btn btn-default"> <input type="checkbox" name="d[]"
						value="<?php echo $day[$i]; ?>"> &nbsp;<?php echo $day[$i];?>
					</label>
					<?php } ?>
				</div>
			</div>
			</br>

			<div class="input-group">
				<span class="input-group-addon"> <strong style="font-size: 20px">เวลา
						:</strong>
				</span> <select name="Time" class="form-control input-lg">
					<option value=""></option>
					<?php for($i=0;$i<count($time)-1;$i++){?>
					<option value="<?php echo $time[$i]; ?>">
						<?php echo $time[$i]." - ".$time[$i+1];?>
					</option>
					<?php } ?>
				</select>
			</div>
			</br>

			<div align="left">
				<input type="submit" id="save" value="บันทึก"
					class="btn btn-primary btn-lg" />
				<input type="reset" id="reset" onClick="modalHide()"
					value="ยกเลิก" class="btn btn-default btn-lg" />
			</div>
		</form>
	</div>
</div>

<div class="panel panel-primary">
	<div class="panel-heading">
		<strong style="font-size: 20px">
		รายการย่อย : <?php echo $Data[0]['L_th'];?>
		</strong>
	</div>
	<div class="panel-body">
		<div class="pull-right">
			<button class="btn btn-primary">
				<div style="font-size: 18px" id="opener">
					<span class="glyphicon glyphicon-plus-sign"></span> เพิ่มรายการย่อย
				</div>
			</button>
			<button class="btn btn-warning" id="opener2">
				<div style="font-size: 18px">
					<span class="glyphicon glyphicon-edit"></span> แก้ไขชื่อรายการ
				</div>
			</button>
		</div>
		</br >
		<hr class="btn-danger"></hr>
		<table class="table table-bordered">
		<thead>
			<tr class="active">
				<td>วัน</td>
				<td>เวลา</td>
			</tr>
		</thead>
		<tbody>
		<?php foreach($Data2 as $rs){?>
			<tr>
				<td><?php echo $fn->dateToTH($rs['S_day']); ?></td>
				<td><?php echo $rs['S_time']; ?></td>
			</tr>
		<?php }?>
		</tbody>
	</table>
	</div>
</div>

<script type="text/javascript">	
	$(function(){
		$("#frmSublist").submit(function(){
			$.post( "controller/addsublist.php?Lid=<?php echo $_GET['Lid']; ?>", $( "#frmSublist" ).serialize() );
			alert('บันทึกเรียบร้อย');
		});
	});
</script>

<script type="text/javascript">
		$(function() {
		    $( "#dialog" ).dialog({
		      width: 600,
		      autoOpen: false,
		      modal: true,
		      draggable: false,
		      hide: { effect: "drop", duration: 500 , direction: "down"}
		    });
		 
		    $( "#opener" ).click(function() {
		      $( "#dialog" ).dialog( "open" );
		    });
		});

		$(function() {
		    $( "#dialog2" ).dialog({
		      width: 600,
		      autoOpen: false,
		      modal: true,
		      draggable: false,
		      hide: { effect: "drop", duration: 500 , direction: "down"}
		    });
		 
		    $( "#opener2" ).click(function() {
		      $( "#dialog2" ).dialog( "open" );
		    });
		});
	
		function modalHide() {
			$('#dialog').dialog( "close" );
			$('#dialog2').dialog( "close" );
		}
</script>
