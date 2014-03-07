<?php
	require_once ('lib/Control.php');
?>

<?php 
	if(Control::checkLevel($_SESSION["LEVEL"])){ 
?>
<div class="panel panel-info">
	<div class="panel-heading">
		<h4><span class="glyphicon glyphicon-bullhorn"></span><strong>&nbsp;หอกระจายข่าว</strong></h4>
	</div>
	<div class="panel-body">
		<form action="controller/announce.php" method="POST" entype="multipart/form-data">
		<div class="pull-right">
			<button type="submit" class="btn btn-primary">ADD</button>
			&nbsp;
			<button type="reset" class="btn btn-default">CLEAR</button>
		</div>
			<table align="center" width="100">
					<td><tr align="center">
					<td><input name="an_text" type="text" id="an_text" size="100" placeholder=""/></td>
					</tr></td>
			</table>
		</form>
	</div>
</div>
<?php }else{ ?>
<<script type="text/javascript">
	window.location='index.php?v=permission';
</script>
<?php } ?>