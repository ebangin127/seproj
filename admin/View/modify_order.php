<?php
  require_once '../Accounts/required_seller.php';
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
          <h1 class="page-header">주문 정보</h1>
          <form name="order" action=/Orders/register_tracking.php method=post onsubmit="return OnSubmitEvent();">
            <div class="container-fluid">
              <section class="container col-md-12">
                <div class="container-page">
                  <div class="form-group row">
                    <div class="no-gutter col-md-12">
                      <label>주문 번호</label>
                      <div id="orderid"></div>
                      <input type="hidden" name="orderid" class="form-control" id="" value="">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label>주문 상태</label>
                    <div id="state"></div>
                    <input type="hidden" name="state" class="form-control" id="" value="">
                  </div>
                  
                  <div class="form-group row">
                    <div class="no-gutter col-md-12">
                      <label>배송지 정보</label>
                      <table id="delivery" class="table table-striped">
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="no-gutter col-md-12">
                      <label>구매 항목</label>
                      <table id="product" class="table table-striped">
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <div class="no-gutter col-md-12">
                      <label>송장 등록하기</label>
                      <table id="shipping" class="table table-striped">
                        <tbody>
                        </tbody>
                      </table>
                    </div>
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
    <script src="js/modify_order.js"></script>
    <script>
      var data = {
  <?php
    require_once '../Orders/order_bo.php';
    require_once '../OrderProducts/orderproduct_bo.php';
    $orderbo = new OrderBO();
    $orderproductbo = new OrderProductBO();
    if($orders = $orderbo->getByOrderID($_GET["orderid"])) {
      if($orderrow = $orders->fetch_assoc()) {
        $productsource = "";
        if($orderproducts = $orderproductbo->getByOrderID($_GET["orderid"])) {
          while($orderproductrow = $orderproducts->fetch_assoc()) {
            $currentrowsource = sprintf("['%s', '%s개', '%s원'],",
              $orderproductrow["productname"], $orderproductrow["qty"], $orderproductrow["price"]);
            if($productsource)
              $productsource += $currentrowsource;
            else
              $productsource = $currentrowsource;
          }
        }
        printf('"orderid":"%s",
          "state":"%s",
          "delivery":[
            ["이름","%s"],
            ["연락처","%s"],
            ["우편번호","%s"],
            ["주소","%s %s"]
          ],
          "product":[
            %s
          ],
          "shipping":[
            ["발송 업체","%s%s%s"],
            ["발송 송장","%s%s%s"],',  
            $_GET["orderid"], $orderbo->getStatusInString($orderrow["state"]),
            $orderrow["name"], $orderrow["phonenum"],
            $orderrow["zipcode"], $orderrow["address1"],
            $orderrow["address2"],
            $productsource,
            '<select id=\"shippingmethod\" name=\"shippingmethod\" value=\"', $orderrow["shipmethod4sending"],
            '\"><option value=\"cj\">CJ대한통운</option><option value=\"postoffice\">우체국</option><option value=\"hanjin\">한진택배</option><option value=\"logen\">로젠택배</option><option value=\"kgb\">KGB택배</option></select>',
            '<input type=\"\" name=\"trackingnumber\" class=\"form-control\" id=\"\" value=\"',
            $orderrow["trackno4sending"], "\\\">");
        if($orderrow["trackno4returning"])
          printf('["반품/교환 업체","%s"],
              ["반품/교환 송장","%s"]
            ]',  
              $orderrow["shipmethod4returning"],
              $orderrow["trackno4returning"]);
        else
          printf(']');
      }
    }
  ?>
      };
      var type =
  <?php
    printf('"%s"', $_SESSION['type']);
  ?>
      ;
      var CurrentMenu = "manage_order";
      $("#" + CurrentMenu).addClass("active");
      fillForm(data);
      refreshMenu(type);
  <?php
      if(isset($orderrow["shipmethod4sending"])) {
        printf("$(\"#shippingmethod\").val('%s').change();", $orderrow["shipmethod4sending"]);
      }
  ?>
    </script>
  </body>
</html>