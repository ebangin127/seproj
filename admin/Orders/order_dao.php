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
    function selectAll($type, $id) {
      $scope = "";
      if($type != "admin")
        $scope .= sprintf(" WHERE Orders.seller='%s'", $id);
      $query = sprintf(
        "SELECT Orders.*, sum(price*qty) 
        AS total 
        FROM Orders, OrderProducts %s
        GROUP BY Orders.orderid", $scope);
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