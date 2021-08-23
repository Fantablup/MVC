<?
/*
The first file that must be included in the when using database.
It starts a session and load all settings, and the DB class.
*/
		/* 
		just nice to have if you need session variables.
		This must be as the very first line in the HTML for it to work.
		You can place this in another file if you need it.
		*/
		if(!isset($_SESSION))session_start(); 

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