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
				<td><strong>DATE</strong></td>
				<td><strong>TIME</strong></td>
				<td></td>
			</tr>	
			<?php
				require_once ('lib/DB.php');
				$db = new DB();
				$db->query("SELECT * FROM fileupload ORDER BY id ASC");
				foreach ($db->fetch_array() as $data){
					echo "<tr>";
					echo "<td>".$data['id']."</td>";
					echo "<td>".$data['upload_name']."</td>";
					echo "<td>".$data['upload_file']."</td>";
					echo "<td>".$data['upload_date']."</td>";
					echo "<td>".$data['upload_time']."</td>";
					echo "<td></td>";
					echo "</tr>";	
				}
			?>
		</table>
	</div>
</div>