<?php
  session_start();
  require_once('database.php');
// Check if data is requested.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_REQUEST['username'];
  $password = $_REQUEST['password'];
  // Connect to database.
  $db = db_connect();
  // Check if the database is down.
  /*if (isset($_SESSION['DB_DOWN'])) {
    echo "The database is down.";
    exit;
  }
  */
    // Get the hashed password from the database.
      $statement = $db->prepare("select password_hash FROM users WHERE username = '$username'");
      $statement->execute();
      $rows = $statement->fetch();

    // If password hash from database and inputted password which is hashed through password_verify match, then the user is authenticated and sent to index.php.
    if ($rows and password_verify($password, $rows['password_hash'])) {
      $_SESSION['authenticated'] = true;
      $_SESSION['username'] = $username;
      header ('location: /');
    }
      // Otherwise failed attempts is set to one or incremented by one and redirected to login.php.
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