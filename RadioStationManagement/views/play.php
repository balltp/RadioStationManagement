
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> <span class="glyphicon glyphicon-music"></span> <?php echo $_GET['name']?></h4>
      </div>
      <div class="modal-body">
      	<div align="center">
      	 
        	<audio controls>
				<source src="http://localhost/RadioStationManagement/RadioStationManagement/files/<?php echo $_GET['name'] ?>" type="audio/mpeg" />
			</audio>  
		</div>
      </div>
      <div class="modal-footer">
        <a href="index.php?v=List" class="btn btn-success">Back</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->

