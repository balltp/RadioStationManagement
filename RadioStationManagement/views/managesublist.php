<?php
	require_once 'lib/DB.php';
	require_once 'lib/FN.php';
	require_once 'lib/File.php';
	
	$db = new DB();
	$fn = new FN();
	$file = new File();

	//JOIN TABLE RADIO_LIST AND RADIO_SUBLIST
	$sql = "SELECT radio_list.*, radio_sublist.*
		FROM radio_list, radio_sublist
		WHERE radio_list.Lid = radio_sublist.Lid
		ORDER BY radio_sublist.Sorder ASC";
	$db->query($sql);
	$Data = $db->fetch_array();
	
	if(empty($_GET['D'])){
		$_GET['D'] = "Sunday";
	}
	
	$day = $fn->getDayTH();
	
	$time = $fn->getTime();
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
					<div class="btn btn-primary" style="font-size: 18px">
					<span class="glyphicon glyphicon-time"></span>
					<?php echo $fn->timeToBetween($time[$i]); ?>
					</div>
					<?php if($fn->checkSubList($_GET['D'], $time[$i])){ ?>
					<div onClick="JavaScript:window.location='index.php?v=EditSubList&T=<?php echo $time[$i]; ?>&D=<?php echo $_GET['D']; ?>'" id="btn" class="btn btn-warning" style="font-size: 18px">
						<span class="glyphicon glyphicon-sort-by-order"></span>
						แก้ไขลำดับไฟล์
					</div>
					<?php } ?>
				</td>
			</tr>
			<tr>
				<td>
					<?php if($fn->checkSubList($_GET['D'], $time[$i])){ ?>
					<table class="table table-bordered" id="tb">
						<tr class="success" style="font-size: 20px">
							<td width="50px" align="center">#</td>
							<td width="350px">รายการ</td>
							<td>สถานะ</td>
							<td width="80px"></td>
						</tr>
					<?php for($j=0; $j<count($Data); $j++){?>	
						<?php if($time[$i]==$Data[$j]['time'] && $Data[$j]['day']==$_GET['D']){ ?>
							<tr style="font-size: 18px">
								<td><?php echo $Data[$j]['Sorder']; ?></td>
								<td><?php echo $Data[$j]['title']; ?></td>
								<td>
								<?php if($Data[$j]['status']=="Y"){ ?>
									<span class="label label-success" style="font-size: 18px">
									<span class="glyphicon glyphicon-ok-sign"></span>
									อัพโหลดไฟล์แล้ว
									</span>
									<?php 
										$D = $Data[$j]['day'];
										$T = $Data[$j]['time'];
										$L = $Data[$j]['Lid'];
									?>
									</br>
									
									<?php if($file->checkFile($D, $T, $L)){ ?>
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

