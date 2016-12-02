<?php
  require_once '../Accounts/required_reviewer.php';
?>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="css/dashboard.css" rel="stylesheet">
    <script src="http://d1p7wdleee1q2z.cloudfront.net/post/search.min.js"></script>
    <script> $(function() { $("#postcodify_search_button").postcodifyPopUp(); }); </script>
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
            <li><a href="#">회원 정보 변경</a></li>
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
          <h1 class="page-header">주문 정보</h1>
          <form name="benchmark" action=/Benchmarks/modify_process.php method=post onsubmit="return OnSubmitEvent();">
            <div class="container-fluid">
              <section class="container col-md-12">
                <div class="container-page">
                  <input type="hidden" name="benchmarkid" class="form-control" id="" value="">
                  <div class="form-group row">
                    <label>상품명</label>
                    <div id="productname"></div>
                  </div>
                  
                  <div class="form-group row">
                    <label>벤치마크 스크린샷 경로</label>
                    <input type="" name="imageurl" class="form-control" id="" value="">
                  </div>    
            
                  <div class="form-group row">
                    <label>평균 속도 (MiB/s)</label>
                    <input type="" name="avgval" class="form-control" id="" value="">
                  </div>        
                  
                  <div class="form-group row">
                    <label>최소 속도 (MiB/s)</label>
                    <input type="" name="minval" class="form-control" id="" value="">
                  </div>   
                  
                  <div class="form-group row">
                    <label>최대 속도 (MiB/s)</label>
                    <input type="" name="maxval" class="form-control" id="" value="">
                  </div>   
                  
                  <div class="form-group row">
                    <label>평균 속도 50% 미만 구간 (%)</label>
                    <input type="" name="freezingval" class="form-control" id="" value="">
                  </div>     

                  <div class="form-group row">
                    <div class="row-sm-offset-2">
                      <button type="submit" class="btn btn-primary col-md-12">수정</button>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="js/manage.js"></script>
    <script src="js/modify_benchmark.js"></script>
    <script>
      var data = {
  <?php
    require_once '../Benchmarks/benchmark_bo.php';
    $benchmarkbo = new BenchmarkBO();
    if($benchmarks = $benchmarkbo->getByBenchmarkID($_GET["benchmarkid"])) {
      if($benchmarkrow = $benchmarks->fetch_assoc()) {
        printf('"benchmarkid":"%s",
          "productname":"%s",
          "imageurl":"%s",
          "maxval":"%s",
          "minval":"%s",
          "avgval":"%s",
          "freezingval":"%s"',  
            $_GET["benchmarkid"], 
            $benchmarkrow["productname"], $benchmarkrow["imageurl"],
            $benchmarkrow["maxval"], $benchmarkrow["minval"],
            $benchmarkrow["avgval"], $benchmarkrow["freezingval"]);
      }
    }
  ?>
      };
      var type =
  <?php
    printf('"%s"', $_SESSION['type']);
  ?>
      ;
      var CurrentMenu = "manage_benchmark";
      $("#" + CurrentMenu).addClass("active");
      fillForm(data);
      refreshMenu(type);
    </script>
  </body>
</html>