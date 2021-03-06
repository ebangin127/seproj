<?php
  require_once '../Accounts/required_seller.php';
?>
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
          <h1 class="page-header">주문 목록</h1>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script src="js/manage.js"></script>
    <script>
      var header = ["주문 번호", "주문 상태", "판매자", "구매자", "총 구매 가격"];
      var data = [
<?php
  require_once '../Orders/order_bo.php';
  $orderbo = new OrderBO();
  if($orders = $orderbo->getAll()) {
    while($orderrow = $orders->fetch_assoc()) {
      printf('["<a href=\"/View/modify_order.php?orderid=%s\">%s</a>", "%s", "%s", "%s", "%s"],',
        $orderrow["orderid"], $orderrow["orderid"], 
        $orderbo->getStatusInString($orderrow["state"]),
        $orderrow["seller"], $orderrow["buyer"],
        $orderrow["total"] + "원");
    }
  }
?>
      ];
      var type =
<?php
  printf('"%s"', $_SESSION['type']);
?>
      ;
      var CurrentMenu = "manage_order";
      $("#" + CurrentMenu).addClass("active");
      printTable(header, data);
      refreshMenu(type);
    </script>
  </body>
</html>