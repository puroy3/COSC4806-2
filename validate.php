<?php

  session_start();

  require_once('user.php');

  require_once('database.php');

  // When a user signs in, we are going to take their username and password, hash the password, compare that hash to what's already in the database, and if they match, the user can log in to the system.

// Check if data is requested.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  // Create user object.
  $user = new User();
  // Connect to database.
  $db = db_connect();
  // Check if the database is down.
  if (isset($_SESSION['DB_DOWN'])) {
    echo "The database is down.";
    exit;
  }



    // Don't hardcode username and password.
    /*$valid_username = "pushpak";
    $valid_password = "1";
     

    $username = $_REQUEST['username'];
    $_SESSION['username'] = $username;
    $password = $_REQUEST['password'];

    if ($valid_username == $username && $valid_password == $password) {
      $_SESSION['authenticated'] = true;
      header ('location: /');
    }
    */
    // Authenticate the user.
    $authenticate = $user->authenticateuser($username, $password);
    // If the user is authenticated, redirect to index.php.
    if ($authenticate) {
      $_SESSION['authenticated'] = true;
      $_SESSION[username] = $username;
      header ('location: /');
    }
    else {

      if (!isset($_SESSION['failed_attempts'])){
        $_SESSION['failed_attempts'] = 1;
      }
      else {
        $_SESSION['failed_attempts'] = $_SESSION['failed_attempts'] + 1;
      }

      // header... redirect to login.php
      header("Location: login.php");

    }
}

?>