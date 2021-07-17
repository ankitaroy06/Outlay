<?php
  session_start();
  session_destroy();
      header('location: index.php');
  if(!isset($_SESSION['email']))
    {
        header('location: logIn.php');
    }
?>