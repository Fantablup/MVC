<?
/*
The first file that must be included in the other files.
It starts a session and load all settings, and the DB class.
*/
		if(!isset($_SESSION))session_start(); // just nice to have if you need session variables.

	define('DB_SERVER', 'localhost');
	define('DB_PORT', '3306');
	define('DB_SERVER_USERNAME', 'demo');
	define('DB_SERVER_PASSWORD', 'demo');
	define('DB_DATABASE', 'mvctest');	

	$objdb = new DBCLASS(
		DB_SERVER,
		DB_PORT,
		DB_DATABASE,
		DB_SERVER_USERNAME,
		DB_SERVER_PASSWORD
	);  
?>