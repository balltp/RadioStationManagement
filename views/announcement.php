<?php
	require_once ('lib/DB.php');
	$db = new DB();

	$sql = "SELECT * FROM _announce";
	$db->query($sql);
	$data = $db->fetch_array();
?>

<table width="600px" border="1" bordercolor="red" style="margin-top: 20px;">
  	<tr>
  		<td>
			<font color="#FF6600">
				<marquee behavior="scroll" scrollamount="5" direction="left" scrolldelay="100">
				<b>ประกาศจากทีมงาน : <?php echo $data[0]["an_text"]; ?></b></marquee>
			</font>
		</td>
	</tr>
</table>
