<?php

class Modelo{
	public $_db;

	
	private static $DB_SERVER = "localhost";
	private static $DB_USER = "root";
	private static $DB_PASS = "";
	private static $DB_NAME = "ritmodecopas";

	public function __construct(){
		$this->_db = new mysqli(self::$DB_SERVER, self::$DB_USER, self::$DB_PASS, self::$DB_NAME);
		if ( $this->_db->connect_errno ){
			echo "Fallo al conectar a MySQL";
			return;
		}
		$this->_db->query("SET NAMES 'UTF8'");
		$this->_db->set_charset('utf-8');
	}

	public function __destruct(){
		$this->_db->close();
	}
}

?>