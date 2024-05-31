<?php

require_once('database.php');

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
    // Create an SQL statement to insert the new user into the database using the username and the password hash.
    $statement = $db->prepare("INSERT into users (username, password_hash) VALUES (?, ?)");
    // Hash the password.
    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    $statement->execute([$username, $password_hash]);
  }
}
?>