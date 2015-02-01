<div class="panel panel-primary">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-th-list"></span>
		&nbsp;&nbsp;<strong>เมนูหลัก</strong>
	</div>
	<div class="panel-body ">
		<ul class="nav nav-pills nav-stacked">
			<li>
				<a href="index.php">
				<span class="glyphicon glyphicon-home"></span>
				&nbsp;หน้าหลัก
				</a>
			</li>
			<li>
				<a href="index.php?v=Upload">
				<span class="glyphicon glyphicon-chevron-right"></span>
				&nbsp;อัพโหลดไฟล์เพลง
				</a>
			</li>
			<li>
				<a href="index.php?v=List">
				<span class="glyphicon glyphicon-chevron-right"></span>
				&nbsp;รายการของฉัน
				</a>
			</li>
		</ul>
	</div>
</div>	

<!-- Menu For LEVEL ADMIN -->
<?php 
	require_once ('lib/Control.php');
	if(Control::checkLevel($_SESSION["LEVEL"])){
?>
<!-- CONFIG -->
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-wrench"></span>
		&nbsp;&nbsp;<strong>ตั้งค่าทั่วไป</strong>
	</div>
	
	<div class="panel-body">
		<ul class="nav nav-pills nav-stacked">
			<li>
				<a href="index.php?v=ManageList">
				<span class="glyphicon glyphicon-chevron-right"></span>
				&nbsp;จัดการ รายการ
				</a>
			</li>
			<li>
				<a href="index.php?v=ManageSubList">
				<span class="glyphicon glyphicon-chevron-right"></span>
				&nbsp;จัดการ รายการย่อย
				</a>
			</li>
			<li>
				<a href="index.php?v=Announce">
				<span class="glyphicon glyphicon-chevron-right"></span>
				&nbsp;หอกระจายข่าว
				</a>
			</li>
		</ul>
	</div>
</div>

<!-- MANAGE USER -->
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-wrench"></span>
		&nbsp;&nbsp;<strong>จัดการผู้ใช้งาน</strong>
	</div>
	
	<div class="panel-body">
		<ul class="nav nav-pills nav-stacked">
			<li>
				<a href="index.php?v=AddUser">
				<span class="glyphicon glyphicon-chevron-right"></span>
				&nbsp;เพิ่มผู้ใช้งาน
				</a>
			</li>
			<li>
				<a href="index.php?v=DeleteUser">
				<span class="glyphicon glyphicon-chevron-right"></span>
				&nbsp;ลบผู้ใช้งาน
				</a>
			</li>
		</ul>
	</div>
</div>
<?php } ?>
<!-- END Menu For LEVEL ADMIN -->