<?php
	//require_once ('config.php');

	define('DB_HOST','localhost');
	// const DB_HOST = 'localhost';

	define("DB_ROOT", "root");
	define("DB_PW", "");
	define("DB_NAME", "sut_radio");
	define("USER", empty($_SESSION['USER'])? NULL:$_SESSION['USER']);
	define("IP", $_SERVER["REMOTE_ADDR"]);
	
	class DB {
		private $charset = "UTF8";
		private $rs;
		private $_fetch_array = array();
	
		public function __construct(){
			mysql_connect(DB_HOST, DB_ROOT, DB_PW) or die (mysql_error());
			mysql_query("SET NAMES ".$this->charset);
			mysql_select_db(DB_NAME);
		}
	
		public function query($sql){
			$this->rs = mysql_query($sql);
		}
	
		public function num_rows(){
			return mysql_num_rows($this->rs);
		}
	
		public function fetch_array(){
			if(count($this->_fetch_array) > 0){
				return $this->_fetch_array;
			}else{
				while($row = mysql_fetch_array($this->rs)){
					$this->_fetch_array[] = $row;
				}
				return $this->_fetch_array;
			}
		}
	}
?>