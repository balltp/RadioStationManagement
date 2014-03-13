<?php 
	require_once 'lib/DB.php';
	require_once 'lib/FN.php';
	
	$db = new DB();
	$db2 = new DB();
	$fn = new FN();
	
	$sql = "SELECT * FROM radio_list";
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

</head>
<body>

<script language = "JavaScript">
		function ListProvince(SelectValue)
		{
			MyUploadForm.upload_date.length = 0
			
			var myOption = new Option('','')  
			MyUploadForm.upload_date.options[MyUploadForm.upload_date.length]= myOption

			<?
			$intRows = 0;
			$sql2 = "SELECT * FROM radio_sublist ORDER BY Sid ASC";
			$db2->query($sql2);
			$intRows = 0;
			foreach($db2->fetch_array() as $rs)
			{
			$intRows++;
			?>			
				x = <?php echo $intRows;?>;
				mySubList = new Array();
				
				strGroup = "<?php echo $rs["Lid"];?>";
				strValue = "<?php echo $rs["day"].":".$rs["time"];?>";
				strItem = "<?php echo "[".$fn->timeToBetween($rs["time"])."] ".$fn->dateToTH($rs["day"]);?>";
				mySubList[x,0] = strItem;
				mySubList[x,1] = strGroup;
				mySubList[x,2] = strValue;
				if (mySubList[x,1] == SelectValue){
					var myOption = new Option(mySubList[x,0], mySubList[x,2])  
					MyUploadForm.upload_date.options[MyUploadForm.upload_date.length]= myOption					
				}
			<?
			}
			?>																
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
							<table width="500" align="center">
								<tr height="50">
									<td align="right"><strong><h3>อัพโหลดโดย :&nbsp;&nbsp;</h3></strong></td>
									<td><input type="text" class="form-control" name="upload_by" placeholder="<?php echo $_SESSION['USER'];?>" disabled/></td>
								</tr>

								<tr height="50">
									<td align="right"><strong><h3>ชื่อรายการ :&nbsp;&nbsp;</h3></strong></td>
									<td>
								 		<select name="upload_name" class="form-control" onChange="ListProvince(this.value)">
								 			<option selected value=""></option>
								 			<?php foreach ($Data as $rs){?>
									        <option value="<?php echo $rs['Lid']?>"><?php echo $rs['title']; ?></option>
									       	<?php } ?>
								   		</select>
   									</td>
								</tr>
								
								<tr height="50">
									<td align="right"><strong><h3>[เวลา] วัน :&nbsp;&nbsp;</h3></strong></td>
									<td>
										<select id="upload_date" name="upload_date" class="form-control"></select>
									</td>
								</tr>
								<tr height="50">	
									<td align="right"><strong><h3>ไฟล์เพลง :&nbsp;&nbsp;</h3></strong></td>
									<td>
										<input type="file" name="upload_file" id="upload_file" class="btn btn-warning" />
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