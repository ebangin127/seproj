<?php
  require_once '../SQL/sql_singleton.php';
  require_once '../BusinessNumbers/businessnumber_vo.php';
  class BusinessNumberDAO {
    function escape($businessnumber) {
      $ID = $GLOBALS['sqlinterface']->Escape($businessnumber->getID());
      $businessnumber = $GLOBALS['sqlinterface']->Escape($businessnumber->getBusinessNumber());
      return
        new BusinessNumberVO($ID, $businessnumber);
    }
    function insert($businessnumber) {
      $businessnumber = $this->escape($businessnumber);
      $query = 
        sprintf(
          "INSERT INTO BusinessNumbers
           (ID, BusinessNumber)
           VALUES
           ('%s', '%s')",
            $businessnumber->getID(), $businessnumber->getBusinessNumber());
      return $GLOBALS['sqlinterface']->Query($query);
    }
    function update($businessnumber) {
      $businessnumber = $this->escape($businessnumber);
      $query = 
        sprintf(
          "UPDATE BusinessNumbers
           SET BusinessNumber='%s'
           WHERE ID='%s'",
            $businessnumber->getBusinessNumber(),
            $businessnumber->getID());
      return $GLOBALS['sqlinterface']->Query($query);
    }
  }
?>