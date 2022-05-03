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
<?php if (!empty($error_message)) { ?>
        <h2><b><?php echo htmlspecialchars($error_message); ?></b></h2> <!--displays error message if any-->
    <?php } ?>
<main>
<h1>Deposit Funds</h1>
<form action="deposit.php" method="post" id="deposit_form">
<input type="hidden" name="accountID" value="<?php echo $accountID; ?>"/>
<input type="hidden" name="balance" value="<?php echo $balance; ?>"/>
<label>Amount to Deposit:</label>
<input type="input" name="deposit_amt"/>
<br>
<br>

<input type="submit" value="Deposit"/>
<br>
</form>
<p><a href="index.php">Return to List of Accounts</a></p>
<br>
<p>Session ID: <?php echo session_id(); ?></p>
</main>
</body>
</html>