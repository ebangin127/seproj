<?php
  function CheckForm() {
    if(!isset($_GET['id'])) {
      printf("Failed 0 - Fill the form properly");
      return FALSE;
    }
    return TRUE;
  }
  if(Checkform()) {
    require_once '../Accounts/account_bo.php';
    $accountbo = new AccountBO();
    if($accountbo->findID($_GET['id'])) {
      printf("이미 있는 ID입니다");
    }
    else {
      printf("사용 가능한 ID입니다");
    }
  }
?>