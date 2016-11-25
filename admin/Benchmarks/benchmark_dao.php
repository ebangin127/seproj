<?php
  require_once '../SQL/sql_singleton.php';
  class BenchmarkDAO {
    function selectAll() {
      $query = sprintf("SELECT Benchmarks.*, productname FROM Products natural join Benchmarks;");
      return $GLOBALS['sqlinterface']->Query($query);
    }
  }
?>