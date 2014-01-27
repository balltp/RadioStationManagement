<?php
	require_once ('lib/Control.php');
?>

<?php 
	if(Control::checkLevel($_SESSION["LEVEL"])){ 
?>
<div class="panel panel-info">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-user"></span><strong>&nbsp;เพิ่มผู้ใช้งาน</strong></h4>
	</div>
	<div class="panel-body">
		<form action="" method="POST" entype="multipart/form-data">
			<table align="center" width="500">
				<tr align="right" height="50">
					<td>NAME : </td>
					<td><input type="text" class="form-control" name="name" placeholder="นายดีเจ น่าฟัง"/></td>
				</tr>
				<tr align="right" height="50">
					<td>USERNAME : </td>
					<td><input type="text" class="form-control" name="us" placeholder="ไม่เกิน 10 ตัวอักษร" /></td>
				</tr>
				<tr align="right" height="50">
					<td>PASSWORD : </td>
					<td><input type="password" class="form-control" name="pw" placeholder="ไม่เกิน 10 ตัวอักษร" /></td>
				</tr>
				<tr align="right" height="50">
					<td>TYPE : </td>
					<td>
						<div class="col-xs-8">
						<select multiple name="level" class="form-control">
							<option value="USER" selected>ผู้ใช้ทั่วไป</option>
							<option value="ADMIN">ผู้ดูแลระบบ</option>
						</select>
						</div>
					</td>
				</tr>
				<tr align="left" height="70">
					<td></td>
					<td>
						<button type="submit" class="btn btn-primary">ADD USER</button>
						&nbsp;
						<button type="reset" class="btn btn-default">CLEAR</button>
					</td>
				</tr>
			</table>			
		</form>
	</div>
</div>
<?php }else{ ?>
<<script type="text/javascript">
	window.location='index.php?v=permission';
</script>
<?php } ?>

