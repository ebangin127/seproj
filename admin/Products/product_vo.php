<?php
  class ProductVO {
    private $seller;
    private $productname;
    private $price;
    private $imageurl;
    private $description;

    function __construct($seller, $productname, $price, $imageurl, $description) {
      $this->seller = $seller;
      $this->productname = $productname;
      $this->price = $price;
      $this->imageurl = $imageurl;
      $this->description = $description;
    }

    function getSeller() {
      return $this->seller;
    }
    function getProductName() {
      return $this->productname;
    }
    function getPrice() {
      return $this->price;
    }
    function getImageURL() {
      return $this->imageurl;
    }
    function getDescription() {
      return $this->description;
    }
  }
?>