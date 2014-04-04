<?php

class FN{
	public $time = array(
			"06.00", "06.30", "07.00", "07.30", "08.00", "08.30",
			"09.00", "09.30", "10.00", "10.30", "11.00", "11.30", "12.00", "12.30",
			"13.00", "13.30", "14.00", "14.30", "15.00", "15.30", "16.00", "16.30",
			"17.00", "17.30", "18.00", "18.30","19.00", "19.30", "20.00"
		);
	public $dayTH = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
	public $dayEN = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	
	//CHECK SUBLIST
	function checkSubList($day, $time){
		require_once 'lib/DB.php';
		$db = new DB();
		
		$sql = "SELECT S_id 
			FROM _sublist 
			WHERE S_day='$day' 
				AND S_time = '$time'";
		$db->query($sql);
		
		if($db->fetch_array()){
			return true;
		}else{
			return false;
		}
	}
	
	//FIND MAX ROW
	function findMax($day, $time, $p=''){
		$path = $p.'lib/DB.php';
		require_once $path;
		$db = new DB();
		
		$sql = "SELECT COUNT(S_id) as max
			FROM _sublist
			WHERE S_day='$day'
				AND S_time = '$time'";
		$db->query($sql);
		
		$Data = $db->fetch_array();
		
		return $Data[0]['max'];
	}
	
	//CONVERT DAY FROM THAI TO ENGLISH
	function dateToEN($day){
		for($i=0; $i<7; $i++){
			if($day==$this->dayTH[$i]){
				return $this->dayEN[$i];
			}
		}
	}	
	
	//CONVERT DAY FROM ENGLIST TO THAI
	function dateToTH($day){
		for($i=0; $i<7; $i++){
			if($day==$this->dayEN[$i]){
				return $this->dayTH[$i];
			}
		}
	}
	
	function timeToBetween($time){
		for($i=0; $i<COUNT($this->time)-1; $i++){
			if($time == $this->time[$i]){
				return $this->time[$i]." - ".$this->time[$i+1];
			}
		}
	}
	
	function getDayTH(){
		return $this->dayTH;
	}
	
	function getDayEN(){
		return $this->dayEN;
	}
	
	function getTime(){
		return $this->time;
	}
}
?>