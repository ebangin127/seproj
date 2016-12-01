<?php
  require_once '../SQL/sql_singleton.php';
  require_once '../BankAccount/bankaccount_dao.php';
  require_once '../BusinessNumbers/businessnumber_dao.php';
  require_once '../Accounts/account_vo.php';
  class AccountDAO {
    private $bankaccountdao;
    private $businessnumberdao;
    function __construct() {
      $this->bankaccountdao = new BankAccountDAO();
      $this->businessnumberdao = new BusinessNumberDAO();
    }
    private function escape($account) {
      $ID = $GLOBALS['sqlinterface']->Escape($account->getID());
      $PW = $GLOBALS['sqlinterface']->Escape($account->getPW());
      $email = $GLOBALS['sqlinterface']->Escape($account->getEmail());
      $name = $GLOBALS['sqlinterface']->Escape($account->getName());
      $phonenum = $GLOBALS['sqlinterface']->Escape($account->getPhonenum());
      $zipcode = $GLOBALS['sqlinterface']->Escape($account->getZipcode());
      $address1 = $GLOBALS['sqlinterface']->Escape($account->getAddress1());
      $address2 = $GLOBALS['sqlinterface']->Escape($account->getAddress2());
      return
        new AccountVO($account->getAccounttype(),
          $ID, $PW, $email, $name, $phonenum, $zipcode,
          $address1, $address2);
    }

    function insert($account) {
      $account = $this->escape($account);
      $query = 
        sprintf(
          "INSERT INTO Accounts
           (ID, PW, email, name, phonenum, zipcode, address1,
            address2, type)
           VALUES
           ('%s', '%s', '%s', '%s', '%s', '%s', '%s',
            '%s', '%s')",
            $account->getID(), $account->getPW(),
            $account->getEmail(), $account->getName(),
            $account->getPhonenum(), $account->getZipcode(),
            $account->getAddress1(), $account->getAddress2(),
            $account->getAccounttype());
      return $GLOBALS['sqlinterface']->Query($query);
    }
    function insertSeller($account, $businessnumber, $bankaccount) {
      $GLOBALS['sqlinterface']->BeginTransaction();
      if($this->insert($account))
        if($this->bankaccountdao->insert($bankaccount))
          if($this->businessnumberdao->insert($businessnumber))
            $GLOBALS['sqlinterface']->CommitTransaction();
          else
            $GLOBALS['sqlinterface']->RollbackTransaction();
        else
          $GLOBALS['sqlinterface']->RollbackTransaction();
      else
        $GLOBALS['sqlinterface']->RollbackTransaction();
    }
    
    function update($account) {
      $account = $this->escape($account);
      if($account->getPW()){
        $query = 
          sprintf(
            "UPDATE Accounts 
            SET PW='%s', email='%s', phonenum='%s', zipcode='%s',
            address1='%s', address2='%s'
            WHERE ID='%s'",
              $account->getPW(), $account->getEmail(),
              $account->getPhonenum(), $account->getZipcode(),
              $account->getAddress1(), $account->getAddress2(),
              $account->getID());
      }
      else {
        $query = 
          sprintf(
            "UPDATE Accounts 
            SET email='%s', phonenum='%s', zipcode='%s',
            address1='%s', address2='%s'
            WHERE ID='%s'",
              $account->getEmail(),
              $account->getPhonenum(), $account->getZipcode(),
              $account->getAddress1(), $account->getAddress2(),
              $account->getID());
      }
      return $GLOBALS['sqlinterface']->Query($query);
    }
    function updateSeller($account, $businessnumber, $bankaccount) {
      $GLOBALS['sqlinterface']->BeginTransaction();
      if($this->update($account))
        if($this->bankaccountdao->update($bankaccount))
          if($this->businessnumberdao->update($businessnumber))
            $GLOBALS['sqlinterface']->CommitTransaction();
          else
            $GLOBALS['sqlinterface']->RollbackTransaction();
        else
          $GLOBALS['sqlinterface']->RollbackTransaction();
      else
        $GLOBALS['sqlinterface']->RollbackTransaction();
    }

    function selectAll() {
      $query = sprintf("SELECT * FROM Accounts");
      return $GLOBALS['sqlinterface']->Query($query);
    }
    function selectByID($ID) {
      $ID = $GLOBALS['sqlinterface']->Escape($ID);
      $query = 
        sprintf(
          "SELECT * FROM Accounts WHERE
            ID='%s'", $ID);
      return $GLOBALS['sqlinterface']->Query($query);
    }
    function selectByIDJoin($ID) {
      $ID = $GLOBALS['sqlinterface']->Escape($ID);
      $query = 
        sprintf(
          "select Accounts.*, BankAccount.*, BusinessNumbers.* from
            Accounts
            left outer join BusinessNumbers on Accounts.ID = BusinessNumbers.ID
            left outer join BankAccount on Accounts.ID = BankAccount.ID
            WHERE Accounts.ID='%s'", $ID);
      return $GLOBALS['sqlinterface']->Query($query);
    }
  }
?>