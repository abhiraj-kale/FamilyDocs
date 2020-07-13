<?php
require 'connect.inc.php';
ob_start();
session_start();

if (isset($_GET['input'])) {
  global $conn;
  if ($_SESSION['otp']==$_GET['input']) {
    // code...
    $sql = "INSERT INTO clients (name, username, password,email)
           VALUES ('$_SESSION[name]', '$_SESSION[username]', '$_SESSION[password]','$_SESSION[email]')";

  if ($conn->query($sql) === TRUE) {
    $_SESSION['logged_in']= true;
    header('Location: home.php');
  } else {
    session_destroy();
    header('Location: signup.php');
  }

  $conn->close();
  }else{
    echo  'error';
  }
}
 ?>
