<?php 
	require_once ('lib/DB.php');
	$mod = (1024*1024);
	$db = new DB();
	
	if($_SESSION['USER']!="admin"){
		$sql = "SELECT f.*, s.*, l.* 
			FROM _files f, _sublist s, _list l
			WHERE f.M_user = '".$_SESSION['USER']."'
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
				<td><strong>DAY</strong></td>
				<td><strong>TIME</strong></td>
				<td><strong>LIST</strong></td>
				<td></td>
			</tr>	
			<?php
				foreach ($db->fetch_array() as $data){
			?>
				<tr>
					<td><?php echo $data['F_id']; ?></td>
					<td><?php echo $data['M_user']; ?></td>
					<td><?php echo $data['F_name']; ?></td>
					<td><?php printf("%.2f", ($data['F_size']/$mod)); ?> MB.</td>
					<td><?php echo $data['F_date']; ?></td>
					<td><?php echo $data['S_day']; ?></td>
					<td><?php echo $data['S_time']; ?></td>
					<td><?php echo $data['L_th']; ?></td>
					<td>
					<a href="index.php?v=play&ID=<?php echo $data['F_id']; ?>" class = "btn btn-success btn-xs"><span class="glyphicon glyphicon-music"></span></a>
					<a href="index.php?v=Delete&ID=<?php echo $data['F_id']; ?>" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
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