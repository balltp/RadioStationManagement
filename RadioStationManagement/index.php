<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>ระบบจัดการไฟล์เพลง @ SUT-RADIO</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
</head>
<body background="images/bg.jpg">
	<script src="bootstrap/js/jQuery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<!-- HEADER TOP  -->
	<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<a class="navbar-brand">SUT-RADIO : ระบบจัดการไฟล์เพลง</a>
			</div>	
			<?php if(!empty($_SESSION["USER"])){?>
			<!-- LOGOUT -->
			<div class="navbar-form pull-right">			
				<button class="btn btn-danger" onClick="JavaScript:window.location='controller/logout.php';">
					<span class="glyphicon glyphicon-off"></span>&nbsp;ออกจากระบบ
				</button>
			</div>
			<!-- WELLCOME -->
			<ul class="nav navbar-nav navbar-right">
				<li>
					<a  class="">สวัสดีคุณ : <?php echo $_SESSION['USER']; ?></a>
				</li>
			</ul>
			<?php }?>
		</div>
	</nav>
	<!-- END HEADER TOP  -->

	<?php 
		require_once ('lib/Control.php');
		if(!empty($_SESSION["USER"])){
	?>
	
	<!-- CONTENT LAOUT -->
	<div class="container well" style="margin-top: 80px">
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