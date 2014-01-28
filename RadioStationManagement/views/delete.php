<?php
	require_once ('lib/File.php');
	require_once ('lib/DB.php');
	$file = new File();
	$db = new DB();
	
	$sql = "SELECT * FROM user_upload WHERE FilesID = '".$_GET['ID']."' LIMIT 1";
	$db->query($sql);

	foreach($db->fetch_array() as $data){}
	
?>

<div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <strong>
        <h3 class="modal-title">คุณต้องการลบเพลงนี้หรือไม่ ?</h3>
        </strong>
      </div>
      
      <div class="modal-body">
      	<table class="table table-bordered">
      		<tr>
      			<td class="danger"><div align="right">ชื่อเพลง : </div></td>
      			<td class="warning"><div align="left"><?php echo $data["FilesName"]; ?></div></td>
      		</tr>
      		<tr>
      			<td class="danger"><div align="right">ขนาดไฟล์ : </div></td>
      			<td class="warning"><?php echo $data["Size"]; ?></td>
      		</tr>
      		<tr>
      			<td class="danger"><div align="right">ชนิดไฟล์ : </div></td>
      			<td class="warning"><?php echo $data["ContentType"]; ?></td>
      		</tr>
      		<tr>
      			<td class="danger"><div align="right">วันที่เปิด : </div></td>
      			<td class="warning"><?php echo $data["DayWeek"]; ?></td>
      		</tr>
      		<tr>
      			<td class="danger"><div align="right">เวลาที่เปิด : </div></td>
      			<td class="warning"><?php echo $data["DayTime"]; ?></td>
      		</tr>
      		<tr>
      			<td class="danger"><div align="right">จากรายการ : </div></td>
      			<td class="warning"><?php echo $data["List"]; ?></td>
      		</tr>
		</table>
      </div>
      
      <div class="modal-footer">
	      <div align="center">
	      	<button type="button" onclick="JavaScript:window.location='controller/delete.php?ID=<?php echo $data["FilesID"];?>&File=<?php echo $data['FilesName']?>'" class="btn btn-danger">ยืนยันการลบ</button>
	        <button type="button" onclick="JavaScript:window.location='index.php?v=List'" class="btn btn-default" data-dismiss="modal">ย้อนกลับไป</button>
	      </div>
      </div>
      
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
