<?php
  require_once '../SQL/sql_singleton.php';
  require_once '../Products/product_vo.php';
  class ProductDAO {
    private function Escape($product) {
      $seller = $GLOBALS['sqlinterface']->Escape($product->getSeller());
      $productname = $GLOBALS['sqlinterface']->Escape($product->getProductName());
      $price = $GLOBALS['sqlinterface']->Escape($product->getPrice());
      $imageurl = $GLOBALS['sqlinterface']->Escape($product->getImageURL());
      $description = $GLOBALS['sqlinterface']->Escape($product->getDescription());
      return
        new ProductVO($seller, $productname, $price, $imageurl, $description);
    }

    function insert($product) {
      $product = $this->Escape($product);
      $query = 
        sprintf(
          "INSERT INTO Products
           (seller, productname, price, imageurl, description)
           VALUES
           ('%s', '%s', '%s', '%s', '%s')",
            $product->getSeller(), $product->getProductName(),
            $product->getPrice(), $product->getImageURL(),
            $product->getDescription());
      return $GLOBALS['sqlinterface']->Query($query);
    }

    function selectAll() {
      $query = sprintf("SELECT * FROM Products");
      return $GLOBALS['sqlinterface']->Query($query);
    }
  }
?>