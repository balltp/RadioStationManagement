<?php
	require_once ('lib/DB.php');
	$db = new DB();
	
	$sql = "SELECT * FROM _list ORDER BY L_id DESC";
	$db->query($sql);
	$Data = $db->fetch_array();
?>

<div>
	<a id="opener" class="btn btn-primary btn-lg">
		<span class="glyphicon glyphicon-plus"></span>
		&nbsp;เพิ่มรายการ
	</a>
</div>

<hr class="btn-danger"></hr>

<div class="panel panel-primary">
	<div class="panel-heading">
		<strong style="font-size: 25px">จัดการ รายการ</strong>
	</div>
	<div class="panel-body">
	<!-- ถ้ามีข้อมูล -->
	<?php if(!empty($Data)){ ?>
		<?php foreach ($Data as $rs){ ?>
		<div class="alert alert-info" style="font-size: 18px;">
			<span class="glyphicon glyphicon-asterisk"></span> <strong><?php echo $rs['L_th']; ?>
			</strong>
			<div class="pull-right">
				<a href="index.php?v=EditList&Lid=<?php echo $rs['L_id']; ?>"
					class="btn btn-warning"> <span class="glyphicon glyphicon-pencil"></span>
				</a> <a
					onClick="JavaScript:if(confirm('คุณต้องการลบ?')==true){
										window.location='controller/dellist.php?Lid=<?php echo $rs['L_id']; ?>'};"
					class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span>
				</a>
			</div>
		</div>
		<?php } ?>
	<?php 
		}else{ 
			echo "<div class=\"alert alert-danger\"><h3><span class=\"glyphicon glyphicon-list-alt\"></span>&nbsp;&nbsp;ไม่มีข้อมูล ในฐานข้อมูล</h3></div>";
		}
	?>
	</div>
</div>

<div id="dialog">
	<div class="alert alert-info">
		<form method="POST" id="frmlist">
			<div class="modal-body" style="font-size: 20px">
				<label for="title">ชื่อรายการ</label> <input
					class="form-control input-lg" type="text" name="title" id="title" />
				</br >
				<label for="title_en">ชื่อรายการ [ภาษาอังกฤษ]</label> <input
					class="form-control input-lg" type="text" name="title_en"
					id="title_en" />
				</br >
				<button class="btn btn-success" type="submit" id="save">บันทึก</button>
				<button class="btn btn-default" type="reset"
					onClick="modalHide()">ยกเลิก</button>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
		$(function() {
		    $( "#dialog" ).dialog({
		      width: 600,
		      autoOpen: false,
		      modal: true,
		      title: "+ เพิ่มรายการ",
		    });
		 
		    $( "#opener" ).click(function() {
		      $( "#dialog" ).dialog( "open" );
		    });
		});
	
		$(function(){
			$("#frmlist").submit(function(){
				$.post( "controller/addlist.php", $( "#frmlist" ).serialize() );
				$("#myModal").hide();
				alert('บันทึกเรียบร้อย');
			});
		});

		function modalHide() {
			$('#dialog').dialog( "close" );
		}
</script>