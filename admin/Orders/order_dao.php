<?php
  require_once '../SQL/sql_singleton.php';
  class OrderDAO {
    function selectByID($OrderID) {
      $OrderID = $GLOBALS['sqlinterface']->Escape($OrderID);
      $query = 
        sprintf(
          "SELECT * FROM Orders WHERE
            orderid=%s", $OrderID);
      return $GLOBALS['sqlinterface']->Query($query);
    }
    function selectAll() {
      $query = sprintf("SELECT Orders.*, sum(price*qty) as total from Orders, OrderProducts group by Orders.orderid;");
      return $GLOBALS['sqlinterface']->Query($query);
    }
    function updateTrackingNumber($OrderID, $ShippingMethod, $TrackingNumber) {
      $OrderID = $GLOBALS['sqlinterface']->Escape($OrderID);
      $ShippingMethodID = $GLOBALS['sqlinterface']->Escape($ShippingMethod);
      $TrackingNumber = $GLOBALS['sqlinterface']->Escape($TrackingNumber);
      $query = 
        sprintf(
          "UPDATE Orders 
            SET state='shipping', shipmethod4sending='%s', trackno4sending='%s'
            WHERE orderid=%s", $ShippingMethod, $TrackingNumber, $OrderID);
      return $GLOBALS['sqlinterface']->Query($query);
    }
  }
?>