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

Class User {

  public function get_all_users() {
    $db = db_connect();
    $statement = $db->prepare("select * from users;");
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

  public function create_user($username, $password) {
    $db = db_connect();
    // Check to see if the account username already exists.
    $statement = $db->prepare("SELECT * FROM users WHERE username = ?");
    $statement->execute([$username]);
    // If the username already exists, return false.
    if ($statement->fetchAll()) {
      return false;
    }
    // Hash the password.
    $hash = password_hash($password, PASSWORD_DEFAULT);
    // Create an SQL statement to insert the new user into the database using the username and the password hash.
    $statement = $db->prepare("INSERT into users (username, password_hash) VALUES (?, ?)");
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

}

?>