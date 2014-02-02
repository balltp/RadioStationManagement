<div class="panel panel-primary">
	<div class="panel-heading">
		แสดงรายการที่ได้อัพโหลด
	</div>

	<div class="panel-body">
		<table class="table table-hover">
			<tr class="active">
				<td width="50"><strong>#</strong></td>
				<td><strong>NAME</strong></td>
				<td><strong>FILE</strong></td>
				<td><strong>SIZE</strong></td>
				<td><strong>DATE</strong></td>
				<td><strong>TIME</strong></td>
				<td><strong>LIST</strong></td>
				<td></td>
			</tr>	
			<?php
				require_once ('lib/DB.php');
				$mod = (1024*1024);
				$db = new DB();
				$db->query("SELECT * FROM user_upload ORDER BY FilesID ASC");
				foreach ($db->fetch_array() as $data){
			?>
				<tr>
					<td><?php echo $data['FilesID']; ?></td>
					<td><?php echo $data['Name']; ?></td>
					<td><?php echo $data['FilesName']; ?></td>
					<td><?php printf("%.2f", ($data['Size']/$mod)); ?> MB.</td>
					<td><?php echo $data['DayWeek']; ?></td>
					<td><?php echo $data['DayTime']; ?></td>
					<td><?php echo $data['List']; ?></td>
					<td>
					<a href="index.php?v=play&name=<?php echo $data['FilesName'];?>" class = "btn btn-success btn-xs">ฟังเพลง </a>
					<button onClick="JavaScript:window.location='index.php?v=Delete&ID=<?php echo $data['FilesID']?>'" class="btn btn-xs btn-danger">ลบ</button>
					</td>
				
				</tr>
			<?php
				}
			?>
		</table>
	</div>
</div>