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

require_once('user.php');

// Checking if any data is sent.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password2 = $_POST['password2'];
  // If the minimum password length is less than 11 or password is not identical to password2, print a message.
  if (strlen($password) < 11 || $password !== $password2) {
    echo "The password does not meet the minimum length requirement of 11 characters or the passwords do not match."
  }
  // Otherwise, create a new user.  
  else {
    $user = new User();
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
// Ask for 3 things:
// Username
// Password
// Password
// Press "Create", check that the two passwords are the same, check that the username is not already in the table, and have a minimum security standard of at least eleven characters for the password. 
// Redirect to login.php to sign in to the website.
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
      <label for="password">Password:</label>
      <br>
      <input type="password" id="password" name="password" required>
      <br>
      <label for="password2">Confirm Password:</label>
      <br>
      <input type="password" id="password2" name="password2" required>
      <br>
      <br>
      <input type="submit" value="Create an account">
      <br>
    </form>

  </body>    
</html>