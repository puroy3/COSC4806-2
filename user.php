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

  public function create_user ($username, $password) {
    $db = db_connect();
    $statement = $db->prepare("INSERT into users //add stuff");
    $statement->execute();
    $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

  // $hash = password_hash("password123", PASSWORD_DEFAULT);
  // if (password_verify($_REQUEST['password'], $hash)) {

}

?>