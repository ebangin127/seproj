<?php
  require_once '../Accounts/account_dao.php';
  class AccountBO {
    private $accountdao;
    function __construct() {
      $this->accountdao = new AccountDAO();
    }
    function register($account) {
      $this->accountdao->insert($account);
    }
    function registerSeller($account, $businessnumber, $bankaccount) {
      $this->accountdao->insertSeller($account, $businessnumber, $bankaccount);
    }
    function findID($ID) {
      $result = $this->accountdao->selectByID($ID);
      if(!$result)
        return 0;
      else
        return $result;
    }
  }
?>