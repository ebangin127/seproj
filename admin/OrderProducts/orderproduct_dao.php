<?php
  require_once '../SQL/sql_singleton.php';
  class OrderProductDAO {
    function selectByID($OrderID) {
      $ID = $GLOBALS['sqlinterface']->Escape($OrderID);
      $query = 
        sprintf(
          "SELECT OrderProducts.productid, OrderProducts.price, OrderProducts.qty, Products.productname
            FROM OrderProducts, Products 
            WHERE OrderProducts.productid = Products.productid and
            OrderProducts.orderid=%s", $OrderID);
      return $GLOBALS['sqlinterface']->Query($query);
    }
  }
?>