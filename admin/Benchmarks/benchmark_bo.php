<?php
  require_once '../Benchmarks/benchmark_dao.php';
  class BenchmarkBO {
    private $benchmarkdao;
    function __construct() {
      $this->benchmarkdao = new BenchmarkDAO();
    }
    function add($benchmark) {
      return $this->benchmarkdao->insert($benchmark);
    }
    function getAll() {
      return $this->benchmarkdao->selectAll($_SESSION["type"], $_SESSION['id']);
    }
  }
?>