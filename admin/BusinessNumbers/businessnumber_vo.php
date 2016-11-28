<?php
  class BusinessNumberVO {
    private $ID;
    private $BusinessNumber;

    function __construct($ID, $BusinessNumber) {
      $this->ID = $ID;
      $this->BusinessNumber = $BusinessNumber;
    }

    function getID() {
      return $this->ID;
    }
    function getBusinessNumber() {
      return $this->BusinessNumber;
    }
  }
?>