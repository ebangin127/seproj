<?php
  require_once '../Orders/order_dao.php';
  class OrderBO {
    private $orderdao;
    function __construct() {
      $this->orderdao = new OrderDAO();
    }
    function getAll() {
      return $this->orderdao->selectAll();
    }
  }
?>