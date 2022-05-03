<?php 

//retrieve the data from the form
   

	$withdraw_amt = filter_input(INPUT_POST,'withdraw_amt',FILTER_VALIDATE_FLOAT);
	$accountID = filter_input(INPUT_POST,'accountID',FILTER_VALIDATE_INT);
	$balance = filter_input(INPUT_POST,'balance', FILTER_VALIDATE_FLOAT);
	







//error checking to make sure user types in valid information 
/*if ($withdraw_amt > $balance){
	$error_message = ' Withdraw Amount must be less than account balance.';
}else if(empty($withdraw_amt)) {
	$error_message = 'Please enter amount to withdraw.';
}else {
	$error_message = '';
}

if ($error_message != ''){
	include ('withdraw_form.php');
	exit();
}*/

//calculation to withdraw funds

$new_balance = $balance - $withdraw_amt;


//connect to database
require_once('database.php');
//query to update account
$withdrawQuery = "UPDATE bankaccount SET Balance = '$new_balance' WHERE AccountID = :accountID";

try{
	//create statement object
	$withdrawStatement = $db->prepare($withdrawQuery);
	//bind parameters
	

    $withdrawStatement->bindValue(':accountID', $accountID);

	//execute query
	$withdrawStatement->execute();
	//close connection
	$withdrawStatement->closeCursor();
}catch(Exception $e) {         //sees if there is an error and sends error message
	$error_message = $e->getMessage();
	echo 'Error Message:' . $error_message;
	
}//end try catch
include('index.php');







?>