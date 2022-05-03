<?php
$accountID = filter_input(INPUT_POST,'accountID',FILTER_VALIDATE_INT);
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
<h1>Update Account Information</h1>
<form action="update_account.php" method="post" id="update_info_form">
<input type="hidden" name="accountID" value="<?php echo $accountID; ?>"/>

<label>First Name: </label>
<input type="input" name="firstName_f"/>
<br>
<br>
<label>Last Name: </label>
<input type="input" name="lastName_f"/>
<br>
<br>
<label>Balance: </label>
<input type="input" name="balance_f"/>
<br>
<br>
<input type="submit" value="Update Account"/>
<br>
</form>
<p><a href="index.php">Return to List of Account</a></p>
</main>
</body>
</html>