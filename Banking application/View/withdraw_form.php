<?php
$accountID = filter_input(INPUT_POST,'accountID',FILTER_VALIDATE_INT);
$balance = filter_input(INPUT_POST,'balance', FILTER_VALIDATE_FLOAT);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dennis National Bank</title>
    <link rel="stylesheet"type="text/css" href="main.css">
</head>
<body>
<main>
<h1>Withdraw Funds</h1>
<form action="withdraw.php" method="post" id="withdraw_form">

<label>Amount to Withdraw:</label> 
<input type="hidden" name="balance"
                           value="<?php echo $balance; ?>"/>
						   <input type="hidden" name="accountID" value="<?php echo $accountID; ?>"/>
<input type="input" name="withdraw_amt"/>
<br>
<br>
<input type="submit" value="Withdraw"/>
<br>
<br>

</form>
<p><a href="index.php">Return to List of Accounts</a></p>
<br>
<p>Session ID: <?php echo session_id(); ?></p>
</main>
</body>
</html>