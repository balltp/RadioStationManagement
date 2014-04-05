<?php 
	require_once 'lib/DB.php';
	require_once 'lib/FN.php';
	
	$db = new DB();
	$db2 = new DB();
	$db3 = new DB();
	
	$fn = new FN();
	
	$sql = "SELECT * FROM _list";
	$db->query($sql);
	$Data = $db->fetch_array();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="ajax-upload/js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="ajax-upload/js/jquery.form.min.js"></script>
	<script type="text/javascript" src="ajax-upload/js/ajax.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="ajax-upload/style/style.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="jquery/development-bundle/themes/ui-lightness/jquery-ui.css">
</head>
<body>
	<script src="jquery/js/jquery-ui-1.10.4.custom.min.js"></script>
	
	<script type="text/javascript">
		$(function() {
			$( "#datepicker" ).datepicker({ 
					    minDate: 0, 
					    maxDate: "+1M", 
					    dateFormat: "yy-mm-dd", 
					    dayNamesMin: [ "อา", "จ", "อ", "พ", "พฤ", "ศ", "ส" ],
					    monthNames: [ "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม" ]
			});
		});

		function dropdownList(){
			var Date = MyUploadForm.Date.value;	
			
			$.ajax("ajax-upload/list3.php?Date="+Date)
				.done(function(codeList){
					$('#List').html(codeList);
				})
				.fail(function(){
					alert("Fail");
				});
		}
		
		function dropdownTime(){
			var Data = MyUploadForm.List.value;	
			var splitDay = Data.split(":");	
			Lid = splitDay[0];
			Day = splitDay[1];							
	
			$.ajax("ajax-upload/list2.php?Day="+Day+"&Lid="+Lid)
				.done(function(codeTime){
					$('#Time').html(codeTime);
				})
				.fail(function(){
					alert("Fail");
				});
		}
	</script>

<div id="alert" style="display: none;">
	<div id="upload-wrapper">
		<div align="center">
			<div id="msg"></div>
			<div class="progress progress-striped active" id="progressbox" style="display:none;">
				<div class="progress-bar progress-bar-primary" id="progressbar"></div>
				<div id="statustxt">0%</div>
			</div>
			<div id="output" style="font-size: 25px;"></div>
		</div>
	</div>
</div>
<div class="panel panel-primary">
	<!-- HEADING PANEL CONTENT -->
	<div class="panel-heading">
		&nbsp;<strong>อัพโหลดไฟล์เพลง</strong>
	</div>
	
	<!-- BODY PANEL CONTENT -->
	<form action="controller/upload.php?user=<?php echo $_SESSION['USER'];?>" onSubmit="return false" method="post" enctype="multipart/form-data" id="MyUploadForm" name="MyUploadForm">
		<table class="table table-bordered">
			<tr>
				<td>
					<div align="right">
						<input type="submit" class="btn btn-primary" id="submit-btn1" value="Upload" />
						<input type="reset" class="btn btn-primary" id="submit-btn1" value="Cancel" />
						<img src="ajax-upload/images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
					</div>						
				</td>
			</tr>
			
			<tr>
				<td>
					<div class="panel-body">
						<div class="alert alert-info">
							<table width="600" align="center">
								<tr height="50">
									<td align="right"><strong><h3>อัพโหลดโดย :&nbsp;&nbsp;</h3></strong></td>
									<td><input type="text" class="form-control  input-lg" name="Name" placeholder="<?php echo $_SESSION['USER'];?>" disabled/></td>
								</tr>
								
								<tr height="50">
									<td align="right"><strong><h3>วันที่ :&nbsp;&nbsp;</h3></strong></td>
									<td>
										<input type="text" class="form-control input-lg" name="Date" id="datepicker" onChange="dropdownList()">
									</td>
								</tr>
								
								<tr height="50">
									<td align="right"><strong><h3>ชื่อรายการ :&nbsp;&nbsp;</h3></strong></td>
									<td>
								 		<div id="List" name="List" style="font-size: 20px; font-weight: bold;">กรุณาเลือกวันที่</div>
   									</td>
								</tr>
								
								<tr height="50">
									<td align="right"><strong><h3>[เวลา] วัน :&nbsp;&nbsp;</h3></strong></td>
									<td>
										<div id="Time" name="Time" style="font-size: 20px; font-weight: bold;">กรุณาเลือกรายการ</div>
									</td>
								</tr>
								
								<tr height="50">	
									<td align="right"><strong><h3>ไฟล์เพลง :&nbsp;&nbsp;</h3></strong></td>
									<td>
										<input type="file" name="upload_file" id="upload_file" class="form-control input-lg" />
									</td>
								</tr>
							</table>								
						</div>			
					</div>						
				</td>
			</tr>
		</table>
	</form>
	<!-- END BODY PANEL CONTENT -->
	
</div>
		
</body>
</html>