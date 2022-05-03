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
<h1>Add Account</h1>
<form action="add_account.php" method="post" id="add_account_form">
<label>Type ID: </label>
<input type="input" name="typeID"/>
<br>
<br>
<label>First Name: </label>
<input type="input" name="firstName"/>
<br>
<br>
<label>Last Name: </label>
<input type="input" name="lastName"/>
<br>
<br>
<label>Balance: </label>
<input type="input" name="balance"/>
<br>
<br>
<input type="submit" value="Add Account"/>
<br>
</form>
<p><a href="index.php">Return to List of Account</a></p>
</main>
</body>
</html>