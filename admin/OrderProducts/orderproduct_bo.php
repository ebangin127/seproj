<?php
  require_once '../OrderProducts/orderproduct_dao.php';
  class OrderProductBO {
    private $orderproductdao;
    function __construct() {
      $this->orderproductdao = new OrderProductDAO();
    }
    function getByOrderID($OrderID) {
      $result = $this->orderproductdao->selectByID($OrderID);
      if(!$result)
        return 0;
      else
        return $result;
    }
  }
?>