<?php

session_start();

require_once('database.php');

// Checking if any data is sent.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_REQUEST['username'];
  $password = $_REQUEST['password'];
  $password2 = $_REQUEST['password2'];
  // Connect to database.
  $db = db_connect();

  // Check if password length is less than 11.
  if (strlen($password) < 11) {
    // If less, print the message.
    echo "Password has to be at minimum 11 characters.";
  }
  // Check if the two inputted passwords match.
  else if ($password !== $password2) {
    // If they don't, print the message.
    echo "Passwords don't match.";
  }
  else {
    // Check if the username already exists in the database by querying database.
    $statement = $db->prepare("select * from users where username = '$username'");
    $statement->execute();
    // Check if any matches occur.
    if ($statement->fetchAll()) {
      // If matches occur, then the username is already taken, so print the message.
      echo "This username is already taken. Choose a different one.";
    }
    else {
      // Hash the password and insert it into the database.
      $hash = password_hash($password, PASSWORD_DEFAULT);
      $statement = $db->prepare("insert into users (username, password_hash) VALUES ('$username', '$hash')");
      $statement->execute();
      // Tell the user that the account was created.
      echo "Your account was created successfully. Press login here.";
    }
  }
}
  
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Signup</title>
  </head>

  <body>

    <h1>Signup Form</h1>

    <form method="post">
      <!-- Ask for 3 things: Username-->
      <label for="username">Username:</label>
      <br>
      <input type="text" id="username" name="username" required>
      <br>
      <br>
      <!-- Password -->
      <label for="password">Password:</label>
      <br>
      <input type="password" id="password" name="password" required>
      <br>
      <br>
      <!-- Confirm Password -->
      <label for="password2">Confirm Password:</label>
      <br>
      <input type="password" id="password2" name="password2" required>
      <br>
      <br>
      <input type="submit" value="Create">
      <br>
    </form>
    <p><a href="/login.php"> Login here </a></p>
  </body>    
</html>