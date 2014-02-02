<div class="panel panel-primary">
	<div class="panel-heading">
		<span class="glyphicon glyphicon-hdd"></span>
		&nbsp;&nbsp;<strong>เมนูหลัก</strong>
	</div>
	<div class="panel-body ">
		<ul class="nav nav-pills nav-stacked">
			<li>
				<a href="index.php?v=Upload">
				<span class="glyphicon glyphicon-chevron-right"></span>
				&nbsp;อัพโหลดไฟล์เพลง
				</a>
			</li>
			<li>
				<a href="index.php?v=List">
				<span class="glyphicon glyphicon-chevron-right"></span>
				&nbsp;เพลงของฉัน
				</a>
			</li>
			
			<?php 
				require_once ('lib/Control.php');
				if(Control::checkLevel($_SESSION["LEVEL"])){
			?>
			<li>
				<a href="index.php?v=AddUser">
				<span class="glyphicon glyphicon-chevron-right"></span>
				&nbsp;เพิ่มผู้ใช้งาน
				</a>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>	