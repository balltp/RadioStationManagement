<?php
	require_once ('lib/DB.php');
	$db = new DB();
	
	$sql = "SELECT * FROM radio_list ORDER BY Lid DESC";
	$db->query($sql);
	$Data = $db->fetch_array();
?>

<div>
	<a class="btn btn-primary btn-lg" onClick="showModal()">
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
		<table class="table">
			<thead>
				<tr class="active">
					<td width="80px" align="center">#</td>
					<td width="600px">รายการ</td>
					<td></td>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($Data as $rs){ ?>
				<tr>
					<td align="right">
						<?php echo $rs['Lid']; ?>
					</td>
					<td>
						<?php echo $rs['title']; ?>
					</td>
					<td>
						<a href="index.php?v=EditList&Lid=<?php echo $rs['Lid']; ?>" class="btn btn-warning">
							<span class="glyphicon glyphicon-pencil"></span>
						</a>
						<a onClick="JavaScript:if(confirm('คุณต้องการลบ?')==true){
									window.location='controller/dellist.php?Lid=<?php echo $rs['Lid']; ?>'};" 
							class="btn btn-danger" >
							<span class="glyphicon glyphicon-remove"></span>
						</a>
					</td>
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<?php 
			}else{ 
				echo "<div class=\"alert alert-danger\"><h3><span class=\"glyphicon glyphicon-list-alt\"></span>&nbsp;&nbsp;ไม่มีข้อมูล ในฐานข้อมูล</h3></div>";
			}
		?>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header alert alert-info">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        	<span class="glyphicon glyphicon-remove"></span>
        </button>
        <h3 class="modal-title" id="myModalLabel">
        	<span class="glyphicon glyphicon-plus"></span>
        	&nbsp;เพิ่มรายการ
        </h3>
      </div>
      <form method="POST" id="frmlist">
	      <div class="modal-body" style="font-size: 25px">
	       <label for="title">ชื่อรายการ</label>
	      	<input class="form-control input-lg" type="text" name="title" id="title" />
	      	<label for="title_en">ชื่อรายการ [ภาษาอังกฤษ]</label>
	      	<input class="form-control input-lg" type="text" name="title_en" id="title_en" />
	      </div>
	      <div class="modal-footer">
			<button class="btn btn-primary btn-lg" type="submit" id="save">บันทึก</button>
			<button class="btn btn-default btn-lg" type="reset" data-dismiss="modal" aria-hidden="true">ยกเลิก</button>
	      </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">		
	function showModal() {
		$('#myModal').modal('show');
	}

	$(function(){
		$("#frmlist").submit(function(){
			$.post( "controller/addlist.php", $( "#frmlist" ).serialize() );
			$("#myModal").hide();
			alert('บันทึกเรียบร้อย');
		});
	});
</script>