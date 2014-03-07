
<?php 

	require_once ('lib/DB.php');
	$db = new DB();
	
	$sql = "SELECT * FROM user_upload WHERE FilesID = '".$_GET['ID']."'";
	$db->query($sql);
	
	//HOST NAME
	$host = $_SERVER["SERVER_NAME"];
	//SUBFOLDER OF FILE
	$subhost = substr($_SERVER["PHP_SELF"],0, strlen($_SERVER["PHP_SELF"])-10);
	
	foreach($db->fetch_array() as $rs){
		//MUSIC PATH
		$path = "http://".$host.$subhost.$rs['FilesPath'].$rs['FilesName'];
		$file_name = $rs['FilesName'];
	}

?>

<div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"> <span class="glyphicon glyphicon-music"></span> <?php echo $file_name; ?></h4>
      </div>
      <div class="modal-body">
      	<div align="center">
        	<audio controls>
				<source src="<?php echo $path; ?>" type="audio/mpeg" />
			</audio>  
		</div>
      </div>
      <div class="modal-footer">
        <a href="index.php?v=List" class="btn btn-success">Back</a>
      </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->