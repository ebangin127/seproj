<?php
  require_once '../Products/product_dao.php';
  class ProductBO {
    private $productdao;
    function __construct() {
      $this->productdao = new ProductDAO();
    }
    function getAll() {
      return $this->productdao->selectAll();
    }
  }
?>