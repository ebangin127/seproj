<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="css/dashboard.css" rel="stylesheet">
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">NFD 관리 시스템</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="/View/modify_account.php">회원 정보 변경</a></li>
            <li><a href="/Accounts/logout.php">로그아웃</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li id="manage_accounts"><a href="/View/manage_accounts.php">회원 관리</a></li>
            <li id="manage_order"><a href="/View/manage_orders.php">주문 관리</a></li>
            <li id="manage_product"><a href="/View/manage_products.php">상품 관리</a></li>
            <li id="manage_benchmark"><a href="/View/manage_benchmarks.php">벤치마크 관리</a></li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">벤치마크 목록</h1>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <p id="add" style="text-align:right"><a href="/View/add_benchmark.php" target="_blank">벤치마크 추가</a></p>
        </div>
      </div>
    </div>
    <script src="js/manage.js"></script>
    <script>
      var header = ["삭제", "벤치마크 번호 (수정)", "상품명", "리뷰어", "평균 속도 (MiB/s)", "최소 속도 (MiB/s)", "프리징 수치 (%)"];
      var data = [
<?php
  require_once '../Accounts/required_reviewer.php';
  require_once '../Benchmarks/benchmark_bo.php';
  $benchmarkbo = new BenchmarkBO();
  if($benchmarks = $benchmarkbo->getAll()) {
    while($benchmarkrow = $benchmarks->fetch_assoc()) {
      printf('["<a href=\"/Benchmarks/delete_process.php?benchmarkid=%s\">삭제</a>", "<a href=\"/View/modify_benchmark.php?benchmarkid=%s\">%s</a>", "%s", "%s", "%s", "%s", "%s"],', 
        $benchmarkrow["benchmarkid"],  $benchmarkrow["benchmarkid"], $benchmarkrow["benchmarkid"],$benchmarkrow["productname"],
        $benchmarkrow["reviewer"], $benchmarkrow["avgval"], $benchmarkrow["minval"], $benchmarkrow["freezingval"]);
    }
  }
?>
      ];
      var type =
<?php
  printf('"%s"', $_SESSION['type']);
?>
      ;
      var CurrentMenu = "manage_benchmark";
      $("#" + CurrentMenu).addClass("active");
      printTable(header, data);
      refreshMenu(type);
      hideIfNotSufficient(type, ["reviewer"], "add");
    </script>
  </body>
</html>