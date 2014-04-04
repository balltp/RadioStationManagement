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
					<!--  
					<?php /*if($fn->checkSubList($_GET['D'], $time[$i])){ ?>
					<div onClick="JavaScript:window.location='index.php?v=EditSubList&T=<?php echo $time[$i]; ?>&D=<?php echo $_GET['D']; ?>'" id="btn" class="btn btn-warning" style="font-size: 18px">
						<span class="glyphicon glyphicon-sort-by-order"></span>
						แก้ไขลำดับไฟล์
					</div>
					<?php } */?>
					-->
				</td>
			</tr>
			<tr>
				<td>
					<?php if($fn->checkSubList($_GET['D'], $time[$i])){ ?>
					<table class="table table-bordered" id="tb">
						<tr class="success" style="font-size: 20px">
							<td width="50px" align="center">#</td>
							<td width="300px">รายการ</td>
							<td>สถานะ</td>
							<td>ลำดับ</td>
							<td width="50px"></td>
						</tr>
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
								<?php if($Data[$j]['S_status']=="Y"){ ?>
									<span class="label label-success" style="font-size: 18px">
									<span class="glyphicon glyphicon-ok-sign"></span>
									อัพโหลดไฟล์แล้ว
									</span>
									<?php 
										$Sid = $Data[$j]['S_id'];
									?>
									</br>
									
									<?php if($file->checkFile($Sid)){ ?>
										<div style="font-size: 18px; color: red;">
										<span class="glyphicon glyphicon-question-sign"></span>
											<strong>ไม่พบไฟล์บน Server!</strong>
										</div>
									<?php } ?>
								<?php }else{ ?>
									<span class="label label-danger" style="font-size: 18px">
									<span class="glyphicon glyphicon-minus-sign"></span>
									ยังไม่ได้อัพโหลดไฟล์
									</span>
								<?php } ?>
								</td>
								<td align="left">
									<?php 
										$Sid = $Data[$j]['S_id'];
										$Sorder = $Data[$j]['S_order'];
										$pSid[$row-1] = $Sid;
									if($row != 1) {?>
									<button class="btn btn-info" onClick="orderUp(<?php echo $Sid; ?>, <?php echo $pSid[$row-2]; ?>, <?php echo $Sorder; ?>)">
										<span class="glyphicon glyphicon-arrow-up"></span>
									</button>
									<?php } ?>
									<?php if($row != $rowMax){ ?>
									<button id="warning" class="btn btn-info" onClick="orderDown(<?php echo $Sid; ?>, <?php echo $Sorder; ?>, '<?php echo $_GET['D']; ?>', '<?php echo $time[$i]; ?>')">
										<span class="glyphicon glyphicon-arrow-down"></span>
									</button>
									<?php } ?>
								</td>
								<td align="center">
									<a onClick="JavaScript:if(confirm('คุณต้องการลบ?')==true){
												window.location='controller/delsublist.php?Sid=<?php echo $Data[$j]['Sid']; ?>'};" 
										class="btn btn-danger" >
										<span class="glyphicon glyphicon-remove"></span>
									</a>
								</td>
							</tr>
						<?php }?>				
					<?php } ?>
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

<script type="text/javascript">
	//CHANGE ORDER TO UP
	function orderUp(Sid, pSid, Sorder){
		$.ajax("controller/editorder.php?Mode=Up&Sid="+Sid+"&pSid="+pSid+"&Sorder="+Sorder)
		.done(function(data){
			window.location.reload();
		})
		.fail(function(){
			alert("Fail");
		});
	}

	//CHANGE ORDER TO DOWN
	function orderDown(Sid, Sorder, Day, Time){
		$.ajax("controller/editorder.php?Mode=Down&Sid="+Sid+"&Sorder="+Sorder+"&Day="+Day+"&Time="+Time)
		.done(function(data){
			window.location.reload();
		})
		.fail(function(){
			alert("Fail");
		});
	}
</script>