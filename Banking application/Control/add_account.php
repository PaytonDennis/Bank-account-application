<?php 
//get the data from the form
    $type_id = filter_input(INPUT_POST, 'typeID', FILTER_VALIDATE_INT);
    $firstName = filter_input(INPUT_POST, 'firstName');
	$lastName = filter_input(INPUT_POST, 'lastName');
	$balance = filter_input(INPUT_POST, 'balance', FILTER_VALIDATE_FLOAT);


//error checking
if($type_id === FALSE) {
	$error_message = 'TypeID must be a valid number.';
}else if($balance === FALSE){
	$error_message = 'Balance must be a valid number.';
}else if ((empty($type_id)) || (empty($firstName)) || (empty($lastName)) || (empty($balance))){
	$error_message = 'Invalid Account Information. Check data and try again.';
}else {
	$error_message = '';
}

if ($error_message != ''){
	include ('add_account_form.php');
	exit();
}
//connect to database
require_once('database.php');
//query to add account
$addQuery = "INSERT INTO bankaccount(TypeID, FirstName, LastName, Balance) VALUES (:typeID, :firstName, :lastName, :balance)";

try{
	//create statement object
	$addStatement = $db->prepare($addQuery);
	//bind parameters
	$addStatement->bindValue(':typeID', $type_id);
	$addStatement->bindValue(':firstName', $firstName);
	$addStatement->bindValue(':lastName', $lastName);
	$addStatement->bindValue(':balance', $balance);

	//execute query
	$addStatement->execute();
	//close connection
	$addStatement->closeCursor();
}catch(Exception $e) {         //sees if there is an error and sends error message
	$error_message = $e->getMessage();
	echo 'Error Message:' . $error_message;
	
}//end try catch
include('index.php');







?>