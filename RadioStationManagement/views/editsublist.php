<?php
	require_once 'lib/DB.php';
	require_once 'lib/File.php';
	
	$db = new DB();
	$db2 = new DB();
	$file = new File();
	
	$sql = "SELECT radio_list.*, radio_sublist.*
		FROM radio_list, radio_sublist
		WHERE radio_list.Lid = radio_sublist.Lid
			AND radio_sublist.time = '".$_GET['T']."'
			AND radio_sublist.day = '".$_GET['D']."'
		ORDER BY radio_sublist.Sorder ASC";
	$db->query($sql);
	$Data = $db->fetch_array();

?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<strong style="font-size: 20px">แก้ไขลำดับรายการ</strong>
	</div>
	<div class="panel-body">
		<?php if(!empty($Data)){ ?>
		<form action="controller/editsublist.php" method="POST" class="form-horizontal" role="form">
			<?php for($i=0; $i<COUNT($Data); $i++){ ?>
			
				<input type="hidden" name="Sid[]" value="<?php echo $Data[$i]['Sid']; ?>" />

			  <div class="form-group">
			    <label for="inputEmail3" class="col-sm-2 control-label" style="font-size: 20px">
			    	รายการ
			    </label>
			    <div class="col-sm-10">
			       <p class="form-control-static" style="font-size: 20px">
			       		<?php echo $Data[$i]['title']; ?>
			       </p>
			    </div>
			  </div>
			  <div class="form-group">
			    <label class="col-sm-2 control-label" id="order" style="font-size: 20px">
			    	ลำดับ
			    </label>
			    <div class="col-sm-2">
			      <input value="<?php echo $Data[$i]['Sorder']; ?>" class="form-control input-lg" type="text" name="order[]" />
			    </div>
			    <label class="col-sm-7 control-label" id="order" style="font-size: 20px">
			    	<div align="left">
				    	<?php 
				    		if($Data[$i]['status']=="Y"){
					    		$day = $Data[$i]['day'];
					    		$time = $Data[$i]['time'];
					    		$list = $Data[$i]['Lid'];
					    		$filename = $file->getFileNameDB($day, $time, $list);
					    		echo $filename;
				    	?>
				    			<input type="hidden" name="name[]" value="<?php echo $Data[$i]['Sid'].":".$filename; ?>" />
				    	<?php } ?>
			    	</div>
			    </label>
			  </div>
		  	<?php } ?>
		  		<div class="form-group">
			    	<div class="col-sm-offset-2 col-sm-10">
			      		<button type="submit" class="btn btn-primary btn-lg">บันทึก</button>
			      		<a onClick="JavaScript:window.location='index.php?v=ManageSubList'" class="btn btn-default btn-lg">ยกเลิก</a>
			    	</div>
			  	</div>
		</form>
		<?php }else{ ?>
			<div style="font-size: 20px">ไม่พบรายการย่อย</div>
		<?php }?>
	</div>
</div>