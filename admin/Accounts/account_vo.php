<?php
  class AccountVO {
  	private $accounttype;
  	private $ID;
  	private $PW;
  	private $email;
  	private $name;
  	private $phonenum;
  	private $zipcode;
  	private $address1;
  	private $address2;

    function __construct($accounttype, $ID, $PW, $email, $name,
    	$phonenum, $zipcode, $address1, $address2) {
      $this->accounttype = $accounttype;
      $this->ID = $ID;
      $this->PW = $PW;
      $this->email = $email;
      $this->name = $name;
      $this->phonenum = $phonenum;
      $this->zipcode = $zipcode;
      $this->address1 = $address1;
    	$this->address2 = $address2;
   	}

   	function getAccounttype() {
   		return $this->accounttype;
   	}
   	function getID() {
   		return $this->ID;
   	}
   	function getPW() {
   		return $this->PW;
   	}
   	function getEmail() {
   		return $this->email;
   	}
   	function getName() {
   		return $this->name;
   	}
   	function getPhonenum() {
   		return $this->phonenum;
   	}
   	function getZipcode() {
   		return $this->zipcode;
   	}
   	function getAddress1() {
   		return $this->address1;
   	}
   	function getAddress2() {
   		return $this->address2;
   	}
  }
?>