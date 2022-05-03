<?php 

//get the data from the form
  $accountID = filter_input(INPUT_POST,'accountID',FILTER_VALIDATE_FLOAT);
  $balance = filter_input(INPUT_POST,'balance', FILTER_VALIDATE_FLOAT);
  $deposit_amt = filter_input(INPUT_POST,'deposit_amt', FILTER_VALIDATE_INT);

	
//error checking to make sure user types in valid information 
/*if ($deposit_amt === FALSE){
	$error_message = 'Deposit Amount must be a valid number with no decimals.';
}else if(empty($deposit_amt)) {
	$error_message = 'Please enter amount to deposit.';
}else {
	$error_message = '';
}

if ($error_message != ''){
	include ('index.php');
	exit();
}*/
	//connect to database
require_once('database.php');

//calculation to deposit funds
$dep_balance = ($balance + $deposit_amt);


//query to update account
$depQuery = "UPDATE bankaccount SET Balance = '$dep_balance' WHERE AccountID = :accountID";

try{
	//create statement object
	$depStatement = $db->prepare($depQuery);
	//bind parameters
	
	$depStatement->bindValue(':accountID', $accountID);

	//execute query
	$depStatement->execute();
	//close connection
	$depStatement->closeCursor();
}catch(Exception $e) {         //sees if there is an error and sends error message
	$error_message = $e->getMessage();
	echo 'Error Message:' . $error_message;
	
}//end try catch
include('index.php');







?>