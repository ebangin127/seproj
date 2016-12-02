<?php
  require_once '../Products/product_dao.php';
  class ProductBO {
    private $productdao;
    function __construct() {
      $this->productdao = new ProductDAO();
    }
    function add($product) {
      return $this->productdao->insert($product);
    }
    function modify($ID, $product) {
      return $this->productdao->update($ID, $product);
    }
    function delete($ID) {
      return $this->productdao->delete($ID);
    }
    function findID($ID) {
      $result = $this->productdao->selectByID($ID);
      if(!$result)
        return 0;
      else
        return $result;
    }
    function findProduct($name) {
      $result = $this->productdao->selectByName($name);
      if(!$result)
        return 0;
      else
        return $result;
    }
    function getAll() {
      return $this->productdao->selectAll($_SESSION["type"], $_SESSION['id']);
    }
  }
?>