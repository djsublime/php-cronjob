<?php

class DB {
	
	private static $_instance = false;

	private function __construct() {}

	public static function select($sql){

		$res = self::query($sql);

		if(!$res){

			return Array('success' => false, 'data' => 'MySQL Error: '.mysqli_error($conn));
		}

		$data = array();
		
		while ($row = $res->fetch_array(MYSQLI_ASSOC)) {
			
			$data[] = $row;
		}

		return Array('success' => true, 'data' => $data);
	}

	public static function query($sql){

		return self::getInstance()->query($sql);
	}


	private static function getInstance() {
		
		if(!self::$_instance) {

			$_config = get_config('database')['mysql'];

			self::$_instance = new mysqli($_config['host'], $_config['username'], $_config['password'], $_config['database']);
			
			if(mysqli_connect_error()) {

				trigger_error("Failed to conenct to MySQL: " . mysqli_connect_error(), E_USER_ERROR);

			}

		}

		return self::$_instance;
	}

	private function __clone() { }

}