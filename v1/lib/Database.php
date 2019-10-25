<?php
	$filepath = realpath(dirname(__FILE__));
	require($filepath.'/../config/config.php');

	Class Database{

		private $_host = DB_HOST;
		private $_db_name = DB_NAME;
		private $_db_user = DB_USER;
		private $_db_pass = DB_PASS;

		public $_link;
		public $_err;
		
		public function connectDB(){
			$this->_link = null;
			
			try{

				$this->_link = new PDO("mysql:host=".$this->_host.";dbname=".$this->_db_name, $this->_db_user, $this->_db_pass);
				$this->_link->exec("set names utf8");
				
			}
			catch(PDOException $exception){
				$this->_err =  "Connection error: ".$exception->getMessage();	
			}
			
			return $this->_link;			
		}

	}
