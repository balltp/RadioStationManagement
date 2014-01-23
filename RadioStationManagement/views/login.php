	<div class="container" style="margin-top: 150px">
		<div class="row">
			<div class="col-md-5 col-md-offset-4 well">
				<form class="form-horizontal" role="form" action="controller/login.php" method="POST">
				  <?php if(!empty($_GET['errorUS'])){?>
				  <div class="alert alert-danger">
				    	<h4>ชื่อผู้ใช้ หรือ รหัสผ่าน ของท่านไม่ถูกต้อง</h4>
				  </div>
				  <?php }?>
				  <div class="form-group">
				    <label for="inputEmail3" class="col-sm-4 control-label">USERNAME</label>
				    <div class="col-sm-7">
				      <input type="text" class="form-control" name="user" placeholder="ชื่อผู้ใช้">
				    </div>
				  </div>
				  <div class="form-group">
				    <label for="inputPassword3" class="col-sm-4 control-label">PASSWORD</label>
				    <div class="col-sm-7">
				      <input type="password" class="form-control" name="pass" placeholder="รหัสผ่าน">
				    </div>
				  </div>
				  <!-- //USE WITH COOKIE 
				  <div class="form-group">
				    <div class="col-sm-offset-4 col-sm-4">
				      <div class="checkbox">
				        <label>
				          <input type="checkbox" id="chk"> จดจำฉันไว้
				        </label>
				      </div>
				    </div>
				  </div>
				  -->
				  <div class="form-group">
				    <div class="col-sm-offset-4 col-sm-4">
				      <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-user"></span> เข้าใช้งานระบบ</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>