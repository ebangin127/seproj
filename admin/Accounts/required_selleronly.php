<?php
  require_once '../Accounts/required_login.php';
  if(isset($_SESSION["id"])) {
    if(!in_array($_SESSION["type"], array("seller"))){
      header("location:/View/login.php?permission_err=true");
    }
  }
?>