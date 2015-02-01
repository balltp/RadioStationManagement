<?php
	require_once ('lib/DB.php');
	require_once ('lib/FN.php');
	
	$db = new DB();
	$fn = new FN();
	
	$Time = $fn->getTime();
	$DayTH = $fn->getDayTH();
	$DayEN = $fn->getDayEN();
	
	$row = 0;

	$USER = $_SESSION['USER'];
	if($USER !="admin"){
		$sql = "SELECT f.*, s.*, l.* 
			FROM _files f, _sublist s, _list l
			WHERE f.M_user = '$USER'
				AND f.L_id = l.L_id
				AND f.S_id = s.S_id 
			ORDER BY F_id ASC";
	}else{
		$sql = "SELECT f.*, s.*, l.* 
			FROM _files f, _sublist s, _list l
			WHERE f.L_id = l.L_id
				AND f.S_id = s.S_id 
			ORDER BY F_id ASC";
	}
	$db->query($sql);
	$Data = $db->fetch_array();
?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<div style="font-size: 20px;">
			ตาราง ไฟล์ที่อัพโหลด
		</div>
	</div>
	<div class="panel-body">
		<table class="table table-bordered">
			<thead>
				<tr style="font-size: 18px;" bgcolor="#DDDDD">
					<td height="50px" align="center">เวลา/วัน</td>
					<?php foreach($DayTH as $day){ ?>
					<td width="95px" align="center"><?php echo $day; ?></td>
					<?php } ?>
				</tr>
			</thead>
			<tbody>
				<?php for($row=0; $row < COUNT($Time)-1; $row++){ ?>
				<tr style="font-size: 16px;">
					<td height="50px" align="center">
						<?php echo $fn->timeToBetween($Time[$row]); ?>
					</td>
					<?php for($col=0; $col < COUNT($DayEN); $col++){ ?>
					<td align="center">
						<?php foreach($Data as $rs){ ?>
							<?php if($Time[$row]==$rs['S_time'] && $DayEN[$col]==$rs['S_day']){ ?>
							<button onClick="show()" class="btn btn-info">
								<span class="glyphicon glyphicon-ok-sign"></span>
								อัพแล้ว
							</button>
							<?php } ?>
						<?php } ?>
					</td>
					<?php } ?>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<div id="modal" title="รายละเอียด">
	OK	
</div>

<script>
	$('#modal').dialog({
		modal: true,
		width: 600,
		autoOpen: false
	});

	function show(){
		$('#modal').dialog("open");
	}
	
</script>