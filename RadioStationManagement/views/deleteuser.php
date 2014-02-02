<?php
	require_once ('lib/Control.php');
	require_once ('lib/DB.php');
?>

<?php 
	if(Control::checkLevel($_SESSION["LEVEL"])){ 
		$db = new DB();
		$sql = "SELECT * FROM member ORDER BY level";
		$db->query($sql);
?>
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
					<td align="center"><?php echo $rs['id']?></td>
					<td><?php echo $rs['username']?></td>
					<td><?php echo $rs['name']?></td>
					<td><?php echo $rs['level']?></td>
					<td>
						<a data-backdrop="static" data-toggle="modal" data-target="#myModal" class="btn btn-danger btn-xs">
						<span class="glyphicon glyphicon-trash"></span>
						</a>
					</td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="myModalLabel">
        	<span class="glyphicon glyphicon-trash"></span>&nbsp;ลบผู้ใช้นี้จริงหรือ?
        </h2>
      </div>
      
      <div class="modal-body"></div>
      
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary">ตกลง</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php }else{ ?>
<script type="text/javascript">
	window.location='index.php?v=permission';
</script>
<?php } ?>