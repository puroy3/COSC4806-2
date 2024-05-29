<?php

  session_start();
  // Don't hardcode username and password.
  /*$valid_username = "pushpak";
  $valid_password = "1";
  */ 

  $username = $_REQUEST['username'];
  $_SESSION['username'] = $username;
  $password = $_REQUEST['password'];

  if ($valid_username == $username && $valid_password == $password) {
    $_SESSION['authenticated'] = true;
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

?>