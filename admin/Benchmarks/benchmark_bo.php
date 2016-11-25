<?php
  require_once '../Benchmarks/benchmark_dao.php';
  class BenchmarkBO {
    private $benchmarkdao;
    function __construct() {
      $this->benchmarkdao = new BenchmarkDAO();
    }
    function getAll() {
      return $this->benchmarkdao->selectAll();
    }
  }
?>