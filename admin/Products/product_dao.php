<?php
  require_once '../SQL/sql_singleton.php';
  class ProductDAO {
    function selectAll() {
      $query = sprintf("SELECT * FROM Products");
      return $GLOBALS['sqlinterface']->Query($query);
    }
  }
?>