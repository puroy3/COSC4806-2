<? php
session_start();

require_once('database.php');

// Connect to database.
$db = db_connect();

// Check if the database is down.
if (isset($_SESSION['DB_DOWN'])) {
  echo "The database is down.";
  exit;
}
// Ask for 3 things:
// Username
// Password
// Password
// Press "Create", check that the two passwords are the same, check that the username is not already in the table, and have a minimum security standard of at least eleven characters for the password. 
// Redirect to login.php to sign in to the website.
?>