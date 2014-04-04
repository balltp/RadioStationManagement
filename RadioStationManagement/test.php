<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
</head>
<body>
<?php
 /*
	$strStartDate = "2014-03-16";
	$strEndDate = "2014-04-16";
	
	$intWorkDay = 0;
	$intHoliday = 0;
	$intTotalDay = ((strtotime($strEndDate) - strtotime($strStartDate))/  ( 60 * 60 * 24 )) + 1; 

	while (strtotime($strStartDate) <= strtotime($strEndDate)) {
		
		$DayOfWeek = date("w", strtotime($strStartDate));
		if($DayOfWeek == 0 or $DayOfWeek ==6)  // 0 = Sunday, 6 = Saturday;
		{
			$intHoliday++;
			echo "$strStartDate = <font color=red>Holiday</font><br>";
		}
		else
		{
			$intWorkDay++;
			echo "$strStartDate = <b>Work Day</b><br>";
		}
		//$DayOfWeek = date("l", strtotime($strStartDate)); // return Sunday, Monday,Tuesday....

		$strStartDate = date ("Y-m-d", strtotime("+1 day", strtotime($strStartDate)));
	}

	echo "<hr>";
	echo "<br>Total Day = $intTotalDay";
	echo "<br>Work Day = $intWorkDay";
	echo "<br>Holiday = $intHoliday";
*/	
	$strStartDate = date('Y-m-d');
	$strEndDate = date('Y-m-d',strtotime('+1 month'));
	echo $strStartDate."<br>";
	echo $strEndDate."<br>";
	echo "<hr>";
	while(strtotime($strStartDate) <= strtotime($strEndDate)){
	  $day = $strStartDate;
	$day = explode("-",$day);
	
	$jd=cal_to_jd(CAL_GREGORIAN,$day[1],$day[2],$day[0]); //2011-01-29
		echo (jddayofweek($jd,1));
		echo $strStartDate."<br>";
		$strStartDate = date('Y-m-d', strtotime("+1 day", strtotime($strStartDate)));
	
	}


?>
</body>
</html>