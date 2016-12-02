<?php
  require_once '../Accounts/required_admin.php';
?>
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
  function IsSeller($accounttype) {
    $SELLER = '0';
    return ($accounttype == $SELLER);
  }
  function CheckDefaultForm() {
    return
      (isset($_POST['id'])) &&
      (isset($_POST['pw'])) &&
      (isset($_POST['email'])) &&
      (isset($_POST['name'])) &&
      (isset($_POST['phonenum'])) &&
      (isset($_POST['zipcode'])) &&
      (isset($_POST['address1'])) &&
      (isset($_POST['address2'])) &&
      (isset($_POST['accounttype']));
  }
  function CheckSellerForm() {
    return
      (!IsSeller($_POST['accounttype'])) || 
        ((isset($_POST['businessnum'])) &&
         (isset($_POST['bankcode'])) &&
         (isset($_POST['accountnum'])));
  }
  function CheckForm() {
    if((!CheckDefaultForm()) ||
       (!CheckSellerForm())) {
      printf("Failed 0 - Fill the form properly");
      return FALSE;
    }
    return TRUE;
  }
  function GetAccountType($accounttype) {
    switch ($accounttype) {
    case '0':
      return 'seller';
      break;
    case '1':
      return 'reviewer';
      break;
    default:
      return '';
      break;
    }
  }
  function BuildAccountObject() {
    require_once '../Accounts/account_vo.php';
    return new AccountVO(
      GetAccountType($_POST['accounttype']),
      $_POST['id'],
      $_POST['pw'],
      $_POST['email'],
      $_POST['name'],
      $_POST['phonenum'],
      $_POST['zipcode'],
      $_POST['address1'],
      $_POST['address2']);
  }
  function BuildBankAccountObject() {
    require_once '../BankAccount/bankaccount_vo.php';
    return new BankAccountVO(
      $_POST['id'],
      $_POST['bankcode'],
      $_POST['accountnum']);
  }
  function BuildBusinessNumberObject() {
    require_once '../BusinessNumbers/businessnumber_vo.php';
    return new BusinessNumberVO(
      $_POST['id'],
      $_POST['businessnum']);
  }

  if(CheckForm()) {
    require_once '../Accounts/account_bo.php';
    $accountbo = new AccountBO();
    $account = BuildAccountObject();
    if(IsSeller($_POST['accounttype'])) {
      $businessnumber = BuildBusinessNumberObject();
      $bankaccount = BuildBankAccountObject();
      $accountbo->registerSeller($account, $businessnumber, $bankaccount);
    }
    else {
      $accountbo->register($account);
    }
  }
  printf("%s", "<script>opener.location.reload(); self.opener = self; window.close();</script>");
?>
  </body>
</html>