<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
      .no-gutter {
          padding-left:0 !important; 
      }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  </head>
  <body>
<?php
  function CheckForms() {
    //Check the form
    if((!isset($_POST['id'])) || (!isset($_POST['pw']))) {
      printf("Failed 0 - Fill the form properly");
      return FALSE;
    }
    return TRUE;
  }

  session_start();
  if(!isset($_SESSION["id"])) {
    if(CheckForms()) {
      require_once '../Accounts/account_bo.php';
      $accountbo = new AccountBO();
      if($account = $accountbo->findID($_POST['id'])) {
        $accountrow = $account->fetch_assoc();
        if($accountrow["PW"] == $_POST['pw']) {
          if($accountrow["type"] == "buyer")
            printf("%s", "<script>alert('구매자는 이용할 수 없습니다'); history.back();</script>");
          $_SESSION["id"] = $_POST['id'];
          $_SESSION["type"] = $accountrow["type"];
          switch ($accountrow["type"]) {
            case "seller":
              header("location:/View/manage_orders.php");
              break;
            case "reviewer":
              header("location:/View/manage_benchmarks.php");
              break;
            case "admin":
              header("location:/View/manage_accounts.php");
              break;
          }
        }
        else {
          printf("%s", "<script>alert('비밀번호를 확인해주세요'); history.back();</script>");
        }
      }
      else {
        printf("%s", "<script>alert('ID가 존재하지 않습니다'); history.back();</script>");
      }
    }
  }
  else {
    printf("%s%s%s", "<script>alert('이미 ", $_SESSION["id"], "로 로그인되어있습니다. 자동으로 로그아웃됩니다.'); history.back();</script>");
    session_destroy();
  }
?>
  </body>
</html>