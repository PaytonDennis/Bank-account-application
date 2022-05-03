<?php 
//get the data from the form

	$firstName_f = filter_input(INPUT_POST, 'firstName_f');
	$lastName_f = filter_input(INPUT_POST,'lastName_f');
	$balance_f = filter_input(INPUT_POST,'balance_f',FILTER_VALIDATE_FLOAT);
	$accountID = filter_input(INPUT_POST,'accountID',FILTER_VALIDATE_INT);



//error checking to make sure user types in valid information 
if(($balance_f === FALSE)){
	$error_message = 'First Name and Last Name must be valid string values.';
}else if ((empty($firstName_f)) || (empty ($lastName_f) || (empty($balance_f)))){
	$error_message = 'Invalid Data Input. Check data and try again.';
}else {
	$error_message = '';
}

if ($error_message != ''){
	include ('update_info_form.php');
	exit();
}
  //connect to database
require_once('database.php');

//query to update account
$updateQuery = "UPDATE bankaccount SET FirstName = :firstName_f, LastName = :lastName_f, Balance = :balance_f WHERE AccountID = :accountID";

try{
	//create statement object
	$updateStatement = $db->prepare($updateQuery);
	//bind parameters
	$updateStatement->bindValue(':accountID', $accountID);
	$updateStatement->bindValue(':firstName_f', $firstName_f);
	$updateStatement->bindValue(':lastName_f', $lastName_f);
	$updateStatement->bindValue(':balance_f', $balance_f);


	//execute query
	$updateStatement->execute();
	//close connection
	$updateStatement->closeCursor();
}catch(Exception $e) {         //sees if there is an error and sends error message
	$error_message = $e->getMessage();
	echo 'Error Message:' . $error_message;
	
}//end try catch
include('index.php');







?>