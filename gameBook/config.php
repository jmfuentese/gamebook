<?php 
	
	define('DB_SERVER', 'localhost');//Cambiar 'localhost' por '127.0.0.1 si se trabaja con entorno xamp/wamp'
	define('DB_USER', 'root');
	define('DB_PASSWORD', '123456');//cambiar 123456 por la contraseña del servicio mysql local
	define('DB_DATABASE', 'gameBook');
	define('DB_PORT', 3306);

	date_default_timezone_set('America/Mexico_City');

	function getDbConnection(){
		$host = DB_SERVER;
		$dbname = DB_DATABASE;
		$port = DB_PORT;
		$connStr = "mysql:host={$host};dbname={$dbname};port={$port};";
		$opt = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'");

		return new PDO($connStr, DB_USER, DB_PASSWORD, $opt);
	}

	
 ?>