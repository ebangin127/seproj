<?php
  session_start();
  if(!isset($_SESSION["id"])) {
    header("location:/View/login.php");
  }
?>