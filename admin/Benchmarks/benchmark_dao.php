<?php
  require_once '../SQL/sql_singleton.php';
  class BenchmarkDAO {
    private function Escape($benchmark) {
      $reviewer = $GLOBALS['sqlinterface']->Escape($benchmark->getReviewer());
      $productid = $GLOBALS['sqlinterface']->Escape($benchmark->getProductId());
      $imageurl = $GLOBALS['sqlinterface']->Escape($benchmark->getImageURL());
      $maxval = $GLOBALS['sqlinterface']->Escape($benchmark->getMaxValue());
      $minval = $GLOBALS['sqlinterface']->Escape($benchmark->getMinValue());
      $avgval = $GLOBALS['sqlinterface']->Escape($benchmark->getAvgValue());
      $freezingval = $GLOBALS['sqlinterface']->Escape($benchmark->getFreezingValue());
      return
        new BenchmarkVO($reviewer, $productid, $imageurl, $maxval, $maxval,
          $minval, $avgval, $freezingval);
    }

    function insert($benchmark) {
      $benchmark = $this->Escape($benchmark);
      $query = 
        sprintf(
          "INSERT INTO Benchmarks
           (reviewer, productid, imageurl, maxval, minval, avgval, freezingval)
           VALUES
           ('%s', %s, '%s', %s, %s, %s, %s)",
            $benchmark->getReviewer(), $benchmark->getProductId(),
            $benchmark->getImageURL(), $benchmark->getMaxValue(),
            $benchmark->getMinValue(), $benchmark->getAvgValue(),
            $benchmark->getFreezingValue());
      return $GLOBALS['sqlinterface']->Query($query);
    }

    function selectAll($type, $id) {
      $scope = "";
      if($type != "admin")
        $scope .= sprintf(" WHERE Benchmarks.reviewer='%s'", $id);
      $query = sprintf("SELECT Benchmarks.*, productname 
        FROM Products 
        RIGHT OUTER JOIN Benchmarks
        ON Products.productid = Benchmarks.productid %s", $scope);
      return $GLOBALS['sqlinterface']->Query($query);
    }
  }
?>