<?php 
	require_once ('lib/DB.php');
	$mod = (1024*1024);
	$db = new DB();
	$db->query("SELECT * FROM user_upload WHERE Name = '".$_SESSION['USER']."' ORDER BY FilesID ASC");	
?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<strong>แสดงรายการที่ได้อัพโหลด</strong>
	</div>

	<div class="panel-body">
		<?php 
			if($db->fetch_array()){
		?>
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
					<a href="index.php?v=play&ID=<?php echo $data['FilesID']; ?>" class = "btn btn-success btn-xs"><span class="glyphicon glyphicon-music"></span></a>
					<a href="index.php?v=Delete&ID=<?php echo $data['FilesID']; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
					</td>
				
				</tr>
			<?php
				}
			?>
		</table>
		<?php 
			}else{
				echo "<div class=\"alert alert-danger\"><h3><span class=\"glyphicon glyphicon-list-alt\"></span>&nbsp;&nbsp;ไม่มีข้อมูล ในฐานข้อมูล</h3></div>";
			}
		?>
	</div>
</div>