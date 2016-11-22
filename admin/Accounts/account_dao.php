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
   		$GLOBALS['sqlinterface']->Query($query);
   	}
   	function insertSeller($account, $businessnumber, $bankaccount) {
   		$GLOBALS['sqlinterface']->BeginTransaction();
   		$this->insert($account);
      $this->bankaccountdao->insert($bankaccount);
      $this->businessnumberdao->insert($businessnumber);
   		$GLOBALS['sqlinterface']->CommitTransaction();
   	}
  }
?>