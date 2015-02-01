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
			ORDER BY DATE(F_date) ASC";
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
			</tr>	
			<?php
				foreach ($db->fetch_array() as $data){
			?>
				<tr onClick="play(<?php echo $data['F_id']; ?>, <?php echo $data['S_id']; ?>, <?php echo $data['L_id']; ?>)">
					<td><?php echo $data['F_id']; ?></td>
					<td><?php echo $data['M_user']; ?></td>
					<td><?php echo $data['F_name']; ?></td>
					<td><?php printf("%.2f", ($data['F_size']/$mod)); ?> MB.</td>
					<td><?php echo $data['F_date']; ?></td>
					<td><?php echo $data['S_day']; ?></td>
					<td><?php echo $data['S_time']; ?></td>
					<td><?php echo $data['L_th']; ?></td>
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

<div id="dialog"></div>

<div id="del">
	<h4>คุณแน่ใจที่จะลบ ไฟล์นี้จริงหรือ ?</h4>
</div>

<div id="delSuccess" title="แจ้งเตือน">
	<h4>ลบไฟล์สำเร็จ !</h4>
</div>

<script>
	$( "#dialog" ).hide();
	$( "#del" ).hide();
	$( "#delSuccess" ).hide();
	
	function play(Fid, Sid, Lid){
		$.ajax("controller/play.php?PlayFid="+Fid+"&Sid="+Sid+"&Lid="+Lid)
			.done(function(codePlay){
				$('#dialog').html(codePlay);
			})
			.fail(function(){
				alert("Fail");
			});

		$( "#dialog" ).dialog({
		      width: 500,
		      autoOpen: false,
		      modal: true,
		      title: "Play",
		    });
		$( "#dialog" ).dialog( "open" );
	}
	
	function delFile(Fid){
		$( "#del" ).dialog({
		      width: 450,
		      autoOpen: false,
		      modal: true,
		      draggable: false,
		      title: "Delete",
		      buttons: {
		      	"ตกลง": function() {
		        	$.ajax("controller/delete.php?Fid="+Fid)
			  			.done(function(codeDel){
			  				$( "#del" ).dialog( "close" );
			  				$( "#dialog" ).dialog( "close" );
			  				$( "#delSuccess" ).dialog({
				  				modal: true
				  				});
			  				setTimeout("window.location.reload();",1500);
			  			})
			  			.fail(function(){
			  				alert("Fail");
			  			});
		          },
		          ยกเลิก: function() {
		            $( this ).dialog( "close" );
		          }
		        }
		    });
		$( "#del" ).dialog( "open" );
	}
</script>