<?php
session_start();

// Check if user is authenticated.
// If not, send them to login.php using header()...
if (!isset($_SESSION['authenticated'])) {
  header("Location: login.php");
}

require_once('user.php');

$user = new User();
$user_list = $user->get_all_users();

/*echo "<pre>";
print_r($user_list);
*/

?>