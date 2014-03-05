<?php
	require_once ('lib/DB.php');
	$db = new DB();
	$objDB = mysql_select_db("db_radio");
	$strSQL = "SELECT * FROM announce";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	$objResult = mysql_fetch_array($objQuery);
?>
<table width="500" border="1" bordercolor="red">
  	<tr><td>
	<font color="#FF6600">
		<marquee behavior="scroll" scrollamount="5" direction="left" scrolldelay="50"><b><?=$objResult["an_text"];?></b></marquee>
	</font>
	</td></tr></table>