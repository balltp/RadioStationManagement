<?php
	require_once ('lib/Control.php');
	require_once ('lib/DB.php');

	if(Control::checkLevel($_SESSION["LEVEL"])){ 
		$db = new DB();
		$sql = "SELECT * FROM _member ORDER BY M_level";
		$db->query($sql);
?>

<!-- Confirm Delete User -->
<script>
function Delete(delUrl) {
  if (confirm("คุณจะลบผู้ใช้คนนี้จริงหรือ?")) {
    window.location = delUrl;
  }
}
</script>
<!-- End Confirm Delete User -->

<div class="panel panel-danger">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-user"></span><strong>&nbsp;ลบผู้ใช้งาน</strong></h4>
	</div>
	<div class="panel-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<td align="center"><strong>#</strong></td>
					<td><strong>USERNAME</strong></td>
					<td><strong>NAME</strong></td>
					<td><strong>LEVEL</strong></td>
					<td></td>
				</tr>
			</thead>
			<tbody>
				<?php foreach($db->fetch_array() as $rs){?>
				<tr>
					<td align="center"><?php echo $rs['M_id']; ?></td>
					<td><?php echo $rs['M_user']; ?></td>
					<td><?php echo $rs['M_name']; ?></td>
					<td><?php echo $rs['M_level']; ?></td>
					<td>
						<?php 
							$url = "controller/deleteuser.php?UserID=".$rs['M_id']; 
						?>
						<a href="javascript:Delete('<?php echo $url; ?>')" class="btn btn-danger btn-xs">
						<span class="glyphicon glyphicon-trash"></span>
						</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<?php }else{ ?>
<!-- Goto Page Permission -->
<script type="text/javascript">
	window.location='index.php?v=permission';
</script>
<!-- End Goto Page Permission -->
<?php } ?>