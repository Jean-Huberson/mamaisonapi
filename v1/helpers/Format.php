<?php 

	Class Format{

		public static function validation($data){
			
			$data = trim($data);
			$data = stripcslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
	}