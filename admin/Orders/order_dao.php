<?php
  require_once '../SQL/sql_singleton.php';
  class OrderDAO {
    function selectAll() {
      $query = sprintf("SELECT Orders.*, sum(price*qty) as total from Orders, OrderProducts group by Orders.orderid;");
      return $GLOBALS['sqlinterface']->Query($query);
    }
  }
?>