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

    function delete($ID) {
      $ID = $GLOBALS['sqlinterface']->Escape($ID);
      $query = 
        sprintf(
          "DELETE FROM Benchmarks WHERE
            benchmarkid=%s", $ID);
      return $GLOBALS['sqlinterface']->Query($query);
    }

    function update($ID, $benchmark) {
      $ID = $GLOBALS['sqlinterface']->Escape($ID);
      $benchmark = $this->Escape($benchmark);
      $query = 
        sprintf(
          "UPDATE Benchmarks 
            SET imageurl='%s', maxval=%s, minval=%s, avgval=%s, freezingval=%s
            WHERE benchmarkid=%s",
            $benchmark->getImageURL(), $benchmark->getMaxValue(),
            $benchmark->getMinValue(), $benchmark->getAvgValue(),
            $benchmark->getFreezingValue(), $ID);
      return $GLOBALS['sqlinterface']->Query($query);
    }

    function selectByID($BenchmarkID) {
      $BenchmarkID = $GLOBALS['sqlinterface']->Escape($BenchmarkID);
      $query = 
        sprintf(
          "SELECT Benchmarks.*, productname 
            FROM Products 
            RIGHT OUTER JOIN Benchmarks
            ON Products.productid = Benchmarks.productid
            WHERE Benchmarks.benchmarkid='%s'", $BenchmarkID);
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