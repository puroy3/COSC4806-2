<?php
session_start();

require_once('database.php');

// Connect to database.
$db = db_connect();

// Check if the database is down.
if (isset($_SESSION['DB_DOWN'])) {
  echo "The database is down.";
  exit;
}

// If the user is logged in and attempts to go to login.php, it redirects them to index.php.
if (isset($_SESSION['authenticated'])) {
  header("Location: index.php");
}

// Check if 'failed attempts' is initialized, if not, the message won't be displayed.
if (!isset($_SESSION['failed_attempts'])){
  $_SESSION['failed_attempts'] = 0;
}

if ($_SESSION['failed_attempts'] > 0) {
  echo "This is unsuccessful attempt number " . $_SESSION['failed_attempts'] . ".";
}
  // When a user signs in, we are going to take their username and password, hash the password, compare that hash to what's already in the database, and if they match, the user can log in to the system.
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Login</title>
  </head>

  <body>

    <h1>Login Form</h1>

    <form action="/validate.php" method="post">
      <label for="username">Username:</label>
      <br>
      <input type="text" id="username" name="username">
      <br>
      <label for="password">Password:</label>
      <br>
      <input type="password" id="password" name="password">
      <br>
      <br>
      <input type="submit" value="Submit">
      <br>
      <p><a href="/signup.php"> Create an Account here </a></p>
    </form>

  </body>    
</html>