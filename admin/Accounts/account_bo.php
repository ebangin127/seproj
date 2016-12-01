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
    function modify($account) {
      $this->accountdao->update($account);
    }
    function modifySeller($account, $businessnumber, $bankaccount) {
      $this->accountdao->updateSeller($account, $businessnumber, $bankaccount);
    }
    function getAll() {
      return $this->accountdao->selectAll();
    }
    function findID($ID) {
      $result = $this->accountdao->selectByID($ID);
      if(!$result)
        return 0;
      else
        return $result;
    }
    function getIDAggregated($ID) {
      $result = $this->accountdao->selectByIDJoin($ID);
      if(!$result)
        return 0;
      else
        return $result;
    }
  }
?>