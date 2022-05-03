<?php
	// programmed by Payton Dennis
	//<label> Payton Dennis </label>
	
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My Realm"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'You must login to view this page';
    exit;
} else {
    echo "<p>Hello {$_SERVER['PHP_AUTH_USER']}.</p>";
    echo "<p>You entered {$_SERVER['PHP_AUTH_PW']} as your password.</p>";
}
	
	//connect to the database
require 'database.php';

	// Start session management with a persistent cookie
//$lifetime = 60 * 60 * 24 * 14;         // 2 weeks in seconds
// $lifetime = 0;                        // session cookie
$lifetime = 86400 * 2;    //2 days
session_set_cookie_params($lifetime, '/');
session_start();

// If the user isn't logged in, force the user to login
if (!isset($_SESSION['is_valid_admin'])) {
    $action = 'login';
}
//Check to see if cookies are allowed
if (isset($_COOKIE['lifetime']))
{
echo "Cookies are enabled";
}
else 
{
echo "Cookies are not enabled";
}
//connect to the database
require 'database.php';

$action = filter_input(INPUT_POST, 'action');
//write a query to retrieve all bank accounts
$query = 'SELECT * FROM bankaccount ORDER BY LastName';
//prepare sql statement for execution, returning a PDO statement object
//bind parameters-none for this query
//data access should be in a try catch block
try{
$statement = $db -> prepare($query);
//execute the query
$statement->execute();
//retrieve data from data set
$bankaccount = $statement->fetchAll();
//close
$statement->closeCursor();
}catch(Exception $e){
	$error_message = $e->getMessage();
	echo "Error Message " . $error_message;
}
	switch($action) {
 case 'login':
        $username = filter_input(INPUT_POST, 'username');
        $password = filter_input(INPUT_POST, 'password');
        if (is_valid_admin_login($username, $password)) {
            $_SESSION['is_valid_admin'] = true;
            include('index.php');
        } else {
            $login_message = 'You must login to view this page.';
            include('login.php');
        }
        break;
    case 'end_session':
        // Clear session data from memory
        $_SESSION = array();

        // Clean up session ID
        session_destroy();

        // Delete the cookie for the session
        $name = session_name();                // Get name of the session cookie
        $expire = strtotime('-1 year');        // Create expiration date in the past
        $params = session_get_cookie_params(); // Get session params
        $path = $params['path'];
        $domain = $params['domain'];
        $secure = $params['secure'];
        $httponly = $params['httponly'];
        setcookie($name, '', $expire, $path, $domain, $secure, $httponly);
        break;
}
?>
<html lang="en">
<head>
<title>Jaguar National Bank</title>
<link rel="stylesheet"type="text/css" href="main.css">
</head>
<body>


<main> <!--Table that displays list of accounts in database with their attributes-->
<h1>Account List</h1>
    <table>
	<thead>
	<tr>
	<th>Account ID</th>
    <th>Type ID</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Balance</th>
	</tr>
	</thead>
	<tbody>
	<!--loop through array(results of the query) and display accounts -->
	<?php foreach ($bankaccount as $account) : ?>
	<tr>
	
	<td><?php echo $account ['AccountID'];?></td>
	<td><?php echo $account ['TypeID'];?></td>
	<td><?php echo $account ['FirstName'];?></td>
	<td><?php echo $account ['LastName'];?></td>
	<td><?php echo '$' . ($account ['Balance']);?></td>
	<td><form action="delete_account.php" method="post"> <!--Button that deletes account -->
                    <input type="hidden" name="accountID"
                           value="<?php echo $account['AccountID']; ?>"/>
                    
                    <input type="submit" value="Delete"/>
                </form></td>
				<td><form action="withdraw_form.php" method="post"> <!--Button that takes user to withdraw form -->
                    <input type="hidden" name="accountID"
                           value="<?php echo $account['AccountID']; ?>"/>
                    <input type="hidden" name="balance"
                           value="<?php echo $account['Balance']; ?>"/>
                    <input type="submit" value="Withdraw"/>
                </form></td>
				<td><form action="deposit_form.php" method="post"> <!--Button that takes user to deposit form -->
                    <input type="hidden" name="accountID"
                           value="<?php echo $account['AccountID']; ?>"/>
                    <input type="hidden" name="balance"
                           value="<?php echo $account['Balance']; ?>"/>
						    <input type="hidden" name="dep_balance"
                           value="<?php echo $dep_balance; ?>"/>
                    <input type="submit" value="Deposit"/>
					
                </form></td>
				<td><form action="update_info_form.php" method="post"> <!--Button that takes user to update form -->
                    <input type="hidden" name="accountID"
                           value="<?php echo $account['AccountID']; ?>"/>
						    <input type="hidden" name="balance"
                           value="<?php echo $account['Balance']; ?>"/>
                   
                    <input type="submit" value="Update"/>
                </form></td>

	</tr>
	<?php endforeach; ?>
	</tbody>
    </table>

	<!--include links to separate action forms-->
	
	<ul>
	<li><a href="add_account_form.php">Add Account</a></li>
	</ul>
	<p>Session ID: <?php echo session_id(); ?></p>
</main>
</body>
</html>