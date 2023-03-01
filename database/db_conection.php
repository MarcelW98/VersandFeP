<?php

class DB {
	protected static $instance;
	protected function __construct() {}
	public static function getInstance() {
		if(empty(self::$instance)) {
			$db_info = array(
				"db_host" => "127.0.0.1",
				"db_user" => "root",
				"db_pass" => "",
				"db_name" => "paketzentrum",
				"db_charset" => "utf8");
			try {
				self::$instance = new PDO("mysql:host=".$db_info['db_host'].';dbname='.$db_info['db_name'], $db_info['db_user'], $db_info['db_pass'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET sql_mode="TRADITIONAL"'));
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
				self::$instance->query('SET NAMES utf8');
				self::$instance->query('SET CHARACTER SET utf8');
				self::$instance->query("SET SESSION TRANSACTION ISOLATION LEVEL SERIALIZABLE");
			} catch(PDOException $error) {
				echo $error->getMessage();
			}
		}
		return self::$instance;
	}
}
?>