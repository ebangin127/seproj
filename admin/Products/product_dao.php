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

    function update($ID, $product) {
      $ID = $GLOBALS['sqlinterface']->Escape($ID);
      $product = $this->Escape($product);
      $query = 
        sprintf(
          "UPDATE Products 
            SET productname='%s', price=%s, imageurl='%s', description='%s'
            WHERE productid=%s",
            $product->getProductName(), $product->getPrice(),
            $product->getImageURL(), $product->getDescription(),
            $ID, $product->getSeller());
      return $GLOBALS['sqlinterface']->Query($query);
    }

    function selectByID($ID) {
      $ID = $GLOBALS['sqlinterface']->Escape($ID);
      $query = 
        sprintf(
          "SELECT * FROM Products WHERE
            productid=%s", $ID);
      return $GLOBALS['sqlinterface']->Query($query);
    }
    function selectByName($name) {
      $name = $GLOBALS['sqlinterface']->Escape($name);
      $query = 
        sprintf(
          "SELECT * FROM Products WHERE
            productname LIKE '%%%s%%'", $name);
      return $GLOBALS['sqlinterface']->Query($query);
    }
    function selectAll($type, $id) {
      $scope = "";
      if($type != "admin")
        $scope .= sprintf(" WHERE Products.seller='%s'", $id);
      $query = sprintf("SELECT * FROM Products %s", $scope);
      return $GLOBALS['sqlinterface']->Query($query);
    }
  }
?>