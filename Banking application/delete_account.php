<?php 

//get the data from the form
$accountID = filter_input(INPUT_POST,'accountID', FILTER_VALIDATE_INT);

//error checking to make sure accountID is correct
if($accountID === FALSE) {
	$error_message = 'Account ID must be a valid number';

}else {
	$error_message = '';
}

if ($error_message != ''){
	include ('index.php');
	exit();
}
require_once('database.php');


try{
	
	//query to delete account and execute the query
	if ($accountID != FALSE) {
    $deleteQuery = 'DELETE FROM bankaccount
              WHERE AccountID = :accountID';
	//create statement object
    $delstatement = $db->prepare($deleteQuery);
	//bind parameters
    $delstatement->bindValue(':accountID', $accountID);
	//execute query
    $delstatement->execute();
	//close connection
    $delstatement->closeCursor();    
	}
}catch(Exception $e) {            //catch to check for errors and send an error message
	$error_message = $e->getMessage();
	echo 'Error Message:' . $error_message;
	
}//end try catch
include('index.php');
?>