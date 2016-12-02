<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <style>
      .no-gutter {
          padding-left:0 !important; 
      }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  </head>
  <body>
<?php
  function CheckForm() {
    return
      (isset($_POST['benchmarkid'])) &&
      (isset($_POST['imageurl'])) &&
      (isset($_POST['maxval'])) &&
      (isset($_POST['minval'])) &&
      (isset($_POST['avgval'])) &&
      (isset($_POST['freezingval']));
  }
  function BuildBenchmarkObject() {
    require_once '../Benchmarks/benchmark_vo.php';
    session_start();
    return new BenchmarkVO(
      $_SESSION['id'],
      "",
      $_POST['imageurl'],
      $_POST['maxval'],
      $_POST['minval'],
      $_POST['avgval'],
      $_POST['freezingval']);
  }

  if(CheckForm()) {
    require_once '../Benchmarks/benchmark_bo.php';
    $benchmarkbo = new BenchmarkBO();
    $benchmark = BuildBenchmarkObject();
    $benchmarkbo->modify($_POST['benchmarkid'], $benchmark);
  }
  printf("<script>window.location.href = '%s';</script>", $_SERVER['HTTP_REFERER']);

?>
  </body>
</html>