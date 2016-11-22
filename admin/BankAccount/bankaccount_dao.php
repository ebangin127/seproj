<?php
  require_once '../SQL/sql_singleton.php';
  require_once '../BankAccount/bankaccount_vo.php';
  class BankAccountDAO {
  	function escape($bankaccount) {
  		$ID = $GLOBALS['sqlinterface']->Escape($bankaccount->getID());
  		$bankcode = $GLOBALS['sqlinterface']->Escape($bankaccount->getBankcode());
  		$accountnum = $GLOBALS['sqlinterface']->Escape($bankaccount->getAccountnum());
  		return
  			new BankAccountVO($ID, $bankcode, $accountnum);
  	}
   	function insert($bankaccount) {
      $bankaccount = $this->escape($bankaccount);
      $query = 
        sprintf(
          "INSERT INTO BankAccount
           (ID, bankcode, accountnum)
           VALUES
           ('%s', %s, '%s')",
            $bankaccount->getID(), $bankaccount->getBankcode(),
            $bankaccount->getAccountnum());
      $GLOBALS['sqlinterface']->Query($query);
   	}
  }
?>