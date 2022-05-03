<?php
function is_valid_admin_login($username, $password) {
    global $db;
    $query = 'SELECT password FROM UserAccounts
              WHERE username = :username';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $row = $statement->fetch();
    $statement->closeCursor();
    $hash = $row['password'];
    return password_verify($password, $hash);
}

?>