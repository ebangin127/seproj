<?php
  class BenchmarkVO {
    private $reviewer;
    private $productid;
    private $imageurl;
    private $maxval;
    private $minval;
    private $avgval;
    private $freezingval;

    function __construct($reviewer, $productid, $imageurl, $maxval, $minval, $avgval, $freezingval) {
      $this->reviewer = $reviewer;
      $this->productid = $productid;
      $this->imageurl = $imageurl;
      $this->maxval = $maxval;
      $this->minval = $minval;
      $this->avgval = $avgval;
      $this->freezingval = $freezingval;
    }

    function getReviewer() {
      return $this->reviewer;
    }
    function getProductId() {
      return $this->productid;
    }
    function getImageURL() {
      return $this->imageurl;
    }
    function getMaxValue() {
      return $this->maxval;
    }
    function getMinValue() {
      return $this->minval;
    }
    function getAvgValue() {
      return $this->avgval;
    }
    function getFreezingValue() {
      return $this->freezingval;
    }
  }
?>