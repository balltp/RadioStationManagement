<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>ระบบจัดการไฟล์เพลง @ SUT-RADIO</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!-- BOOTSTRAP -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
</head>
<body background="images/bg - blue.jpg">
	<script src="bootstrap/js/jQuery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<!-- HEADER TOP  -->
	<nav class="navbar-inverse navbar-static-top">
	<div class="container">
		<div class="container well-header">
			<div class="navbar-header">
				<div class="navbar-brand glyphicon glyphicon-music" style="font-size: 25px;"></div>
					<a class="navbar-brand" href="index.php">
					<div style="font-size: 25px;"> SUT-RADIO </div>
					ระบบจัดการไฟล์เพลง
					</a>
					<!-- ANNOUNCEMENT VIEW -->
					<?php include ('views/announcement.php');?>
			</div>
			<?php if(!empty($_SESSION["USER"])){?><br/>
			<!-- LOGOUT -->
			<div class="navbar-form pull-right">
				<div class="btn-group">
    			<div class="btn-group btn-group-xs">
				<button class="btn btn-danger" onClick="JavaScript:window.location='controller/logout.php';">
					<span class="glyphicon glyphicon-off"></span>&nbsp;ออกจากระบบ
				</button>
				</div></div>
				</div>		
			<!-- WELLCOME -->
			<ul class="nav navbar-right">
				<li>
					<a class="glyphicon glyphicon-user"> สวัสดีคุณ : <b><?php echo strtoupper($_SESSION['USER']); ?></b></a>
				</li>
			</ul>
			<?php }?>
			</div>
		</div>
	</nav>
	<!-- END HEADER TOP  -->

	<?php 
		require_once ('lib/Control.php');
		if(!empty($_SESSION["USER"])){
	?>
	
	<!-- CONTENT LAOUT -->
	<div class="container well" style="margin-top: 20px;margin-bottom: 20px">
		<div class="row">
			<!-- MENU -->
			<div class="col-md-3">
			<?php 
				Control::viewMenu();
			?>	
			</div>
			
			<!-- CONTENT -->
			<div class="col-md-9">
			<?php 
				Control::content($_GET['v']);
			?>
			</div>
		</div>
	</div>
	<!-- END CONTENT LAOUT -->
	<?php 
		}else{ 
			Control::viewLogin();
		} 
	?>
</body>
</html>