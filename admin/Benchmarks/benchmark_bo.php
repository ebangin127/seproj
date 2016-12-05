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
    function modify($ID, $benchmark) {
      return $this->benchmarkdao->update($ID, $benchmark);
    }
    function delete($ID) {
      return $this->benchmarkdao->delete($ID);
    }
    function getByBenchmarkID($BenchmarkID) {
      $result = $this->benchmarkdao->selectByID($BenchmarkID);
      if(!$result)
        return 0;
      else
        return $result;
    }
    function getAll() {
      return $this->benchmarkdao->selectAll($_SESSION["type"], $_SESSION['id']);
    }
  }
?>