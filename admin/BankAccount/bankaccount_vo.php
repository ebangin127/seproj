<?php
  class BankAccountVO {
    private $ID;
    private $bankcode;
    private $accountnum;

    function __construct($ID, $bankcode, $accountnum) {
      $this->ID = $ID;
      $this->bankcode = $bankcode;
      $this->accountnum = $accountnum;
    }

    function getBankcode() {
      return $this->bankcode;
    }
    function getID() {
      return $this->ID;
    }
    function getAccountnum() {
      return $this->accountnum;
    }
  }
?>