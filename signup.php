<?php

session_start();

require_once('database.php');

// Checking if any data is sent.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  // Connect to database.
  $db = db_connect();

  // Check if password length is less than 11.
  if (strlen($password) < 11) {
    // If less, print the message.
    echo "Password has to be at minimum 11 characters."
  }
  // Check if the two inputted passwords match.
  else if ($password !== $password2) {
    // If they don't, print the message.
    echo "Passwords don't match.";
  }
  else {
    // Check if the username already exists in the database by querying database.
    $statement = $db->prepare("select * from users where username = ?");
    $statement->execute([$username]);
    // Check if any matches occur.
    if ($statement->fetchAll()) {
      // If matches occur, then the username is already taken, so print the message.
      echo "This username is already taken. Choose a different one."
    }
    else {
      // Hash the password and insert it into the database.
      $password_hash = password_hash($password, PASSWORD_DEFAULT);
      $statement = $db->prepare("insert into users (username, password_hash) VALUES (?, ?)");
      $statement->execute([$username, $password_hash]);
      // Tell the user that the account was created.
      echo "Your account was created successfully.";
    }
  }
  // Check if the database is down.
  /*if (isset($_SESSION['DB_DOWN'])) {
    echo "The database is down.";
    exit;
  }
  */
  /*
  // Check to see if the account username already exists.
  $statement = $db->prepare("SELECT * FROM users WHERE username = ?");
  $statement->execute([$username]);
  // If the username already exists, return false.
  if ($statement->fetchAll()) {
    return false;
    header("Location: signup.php");
    echo "The username already exists.";
  }
  else {
  // If the minimum password length is less than 11 or password is not identical to password2, print a message.
  if (strlen($password) < 11 || $password !== $password2) {
    echo "The password does not meet the minimum length requirement of 11 characters or the passwords do not match.";
  }
  // Otherwise, create a new user.  
  else {
    // Hash the password.
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $statement = $db->prepare("INSERT into users (username, password) VALUES (?, ?)");
    $statement->execute([$username, $hash]);
    //$rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    //return $rows;
    header("Location: login.php");
    /* $user = new User();
    // If the user is created successfully, redirect to login.php to sign in to the website.
    if ($user->create_user($username, $password)) {
      header("Location: login.php");
      exit;
    }
    // Otherwise, print a message telling the user that the username already exists.
    else {
      echo "The username already exists.";
    }
  }
}
}
// Ask for 3 things:
// Username
// Password
// Password
// Press "Create", check that the two passwords are the same, check that the username is not already in the table, and have a minimum security standard of at least eleven characters for the password. 
// Redirect to login.php to sign in to the website.
  */
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Signup</title>
  </head>

  <body>

    <h1>Signup Form</h1>

    <form method="post">
      <label for="username">Username:</label>
      <br>
      <input type="text" id="username" name="username" required>
      <br>
      <br>
      <label for="password">Password:</label>
      <br>
      <input type="password" id="password" name="password" required>
      <br>
      <br>
      <label for="password2">Confirm Password:</label>
      <br>
      <input type="password" id="password2" name="password2" required>
      <br>
      <br>
      <input type="submit" value="Create">
      <br>
      
    </form>

  </body>    
</html>