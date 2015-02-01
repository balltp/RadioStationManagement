<?php
	require_once 'lib/DB.php';
	require_once 'lib/FN.php';
	require_once 'lib/File.php';

	$db = new DB();
	$fn = new FN();
	$file = new File();

	//JOIN TABLE RADIO_LIST AND RADIO_SUBLIST
	$sql = "SELECT l.*, s.*
		FROM _list l, _sublist s
		WHERE l.L_id = s.L_id
		ORDER BY s.S_order ASC";
	$db->query($sql);
	$Data = $db->fetch_array();
	
	if(empty($_GET['D'])){
		$_GET['D'] = "Sunday";
	}
	
	$day = $fn->getDayTH();
	$time = $fn->getTime();
	
	$pSid = array();
?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<strong style="font-size: 25px">จัดการ รายการย่อย 
		<span class="label label-success">
			วัน<?php echo $fn->dateToTH($_GET['D']); ?>
		</span>
		</strong>
	</div>
	
	<div class="panel-body">
		<?php for($i=0; $i<count($day); $i++){?>
			<a style="font-size: 18px" href="index.php?v=ManageSubList&D=<?php echo $fn->dateToEN($day[$i]); ?>" class="btn btn-primary">
				<?php echo $day[$i]; ?>
			</a>
		<?php } ?>
		</br></br>
		<table class="table">
			<?php 
			for($i=0;$i<count($time)-1;$i++){
			?>
			<tr class="active" style="font-size: 18px">
				<td>
					<div class="" style="font-size: 18px">
					<span class="glyphicon glyphicon-time"></span>
					<?php echo $fn->timeToBetween($time[$i]); ?>
					<?php $rowMax = $fn->findMax($_GET['D'], $time[$i]); ?>
					</div>
				</td>
			</tr>
			<tr>
				<td>
					<?php if($fn->checkSubList($_GET['D'], $time[$i])){ ?>
					<table class="table table-bordered" id="tb">
					<thead>
						<tr class="success" style="font-size: 20px">
							<td width="50px" align="center">#</td>
							<td width="300px">รายการ</td>
							<td>สถานะ <b>[วันนี้]</b></td>
							<td width="50px">ลำดับ</td>
							<td width="50px"></td>
						</tr>
					</thead>
					<tbody>
					<?php 
						$row = 0;
						for($j=0; $j<count($Data); $j++){?>	
						<?php if($time[$i]==$Data[$j]['S_time'] && $Data[$j]['S_day']==$_GET['D']){ 
							$row++;
						?>
							<tr style="font-size: 18px">
								<td align="center">
									<?php echo $Data[$j]['S_order']; ?>
								</td>
								<td><?php echo $Data[$j]['L_th']; ?></td>
								<td>
								<?php 
										$Sid = $Data[$j]['S_id'];
										$Lid = $Data[$j]['L_id'];
								?>
								<?php if($file->checkToday($Sid, $Lid)=="OK"){ ?>
									<button style="font-size: 18px" class="btn btn-success">
										<span class="glyphicon glyphicon-ok-sign"></span>
										อัพไฟล์แล้ว
									</button>
								<?php }else{ ?>
									<span class="label label-danger" style="font-size: 18px">
									<span class="glyphicon glyphicon-minus-sign"></span>
									ยังไม่ได้อัพไฟล์
									</span>
								<?php } ?>
								</td>
								<td align="center">
									<?php 
										$Sid = $Data[$j]['S_id'];
										$Sorder = $Data[$j]['S_order'];
										$pSid[$row-1] = $Sid;
										$status = $Data[$j]['S_status'];
									if($row != 1) {?>
									<button class="btn btn-info btn-xs" onClick="orderUp(<?php echo $Sid; ?>, <?php echo $pSid[$row-2]; ?>, <?php echo $Sorder; ?>, '<?php echo $status; ?>')">
										<span class="glyphicon glyphicon-arrow-up"></span>
									</button>
									<?php } ?>
									<?php if($row != $rowMax){ ?>
									<button id="warning" class="btn btn-info btn-xs" onClick="orderDown(<?php echo $Sid; ?>, <?php echo $Sorder; ?>, '<?php echo $_GET['D']; ?>', '<?php echo $time[$i]; ?>', '<?php echo $status; ?>')">
										<span class="glyphicon glyphicon-arrow-down"></span>
									</button>
									<?php } ?>
								</td>
								<td align="center">
									<button onClick="deleteSublist(<?php echo $Sid; ?>, <?php echo $Sorder; ?>)" class="btn btn-danger" >
										<span class="glyphicon glyphicon-remove"></span>
									</button>
								</td>
							</tr>
						<?php }?>				
					<?php } ?>
					</tbody>
					</table>
					<?php }else{ ?>
						<div align="center">
							<strong style="font-size: 20px;">ไม่พบรายการย่อย !</strong>
						</div>
					<?php } ?>
				</td>
			</tr>
			<?php } ?>
		</table>
	</div>
</div>

<div id="dialog" title="File Upload"></div>

<script type="text/javascript">

	$('#dialog').dialog({
		width: 600,
		autoOpen: false,
		modal: true,
	});
	
	//CHANGE ORDER TO UP
	function orderUp(Sid, pSid, Sorder, status){
		$.ajax("controller/editorder.php?Mode=Up&Sid="+Sid+"&pSid="+pSid+"&Sorder="+Sorder+"&Status="+status)
		.done(function(data){
			//alert(data);
			window.location.reload();
		})
		.fail(function(){
			alert("Fail");
		});
	}

	//CHANGE ORDER TO DOWN
	function orderDown(Sid, Sorder, Day, Time, status){
		$.ajax("controller/editorder.php?Mode=Down&Sid="+Sid+"&Sorder="+Sorder+"&Day="+Day+"&Time="+Time+"&Status="+status)
		.done(function(data){
			//alert(data);
			window.location.reload();
		})
		.fail(function(){
			alert("Fail");
		});
	}

	//DELETE SUBLIST
	function deleteSublist(Sid, Sorder){
		if (confirm("คุณจะลบรายการนี้จริงหรือ?")){
			$.ajax("controller/delsublist.php?Sid="+Sid+"&Sorder="+Sorder)
				.done(function(data){
					window.location.reload();
				})
				.fail(function(){
					alert("Fail");
				});
		}
	}
</script>