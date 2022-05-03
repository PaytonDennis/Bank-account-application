<?php
//Payton Dennis
//create parameters as variables
$dsn = 'mysql:host=localhost;dbname=bankaccount';
$username = 'root';
$password = '';

	

//create the pdo data object inside a try..catch
try {
	$db = new PDO ($dsn, $username, $password);
	
} catch (PDOException $e) {
		$error_message = $e->getMessage();
		include ('database_error.php');
		exit();
	
}


?>