<?php

class FN{
	private $time = array("06.00", "07.00", "08.00", "09.00", "10.00", "11.00", "12.00",
			"13.00", "14.00", "15.00", "16.00", "17.00", "18.00","19.00", "20.00");
	private $dayTH = array("อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัสบดี", "ศุกร์", "เสาร์");
	private $dayEN = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
	
	function dateToEN($day){
		for($i=0; $i<7; $i++){
			if($day==$this->dayTH[$i]){
				return $this->dayEN[$i];
			}
		}
	}	

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