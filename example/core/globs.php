<?
/*
The first file that must be included in the other files.
It starts a session and load all settings, and the DB class.
*/
		if(!isset($_SESSION))session_start(); // just nice to have if you need session variables.
/*
	define('DB_SERVER', 'localhost');
	define('DB_PORT', '3306');
	define('DB_SERVER_USERNAME', 'eunoreco_a2wp49');
	define('DB_SERVER_PASSWORD', '18xpL8cS!(');
	define('DB_DATABASE', 'eunoreco_mvctest');
*/	
	define('DB_SERVER', 'localhost');
	define('DB_PORT', '3306');
	define('DB_SERVER_USERNAME', 'viggo');
	define('DB_SERVER_PASSWORD', 'Kaviar123!');
	define('DB_DATABASE', 'mvctest');	

	$objdb = new DBCLASS(
		DB_SERVER,
		DB_PORT,
		DB_DATABASE,
		DB_SERVER_USERNAME,
		DB_SERVER_PASSWORD
    );  
?>