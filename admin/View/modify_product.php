<?php
  require_once '../Accounts/required_seller.php';
?>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <link href="css/dashboard.css" rel="stylesheet">
    <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
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
          <h1 class="page-header">상품 변경</h1>
          <form name="product" action=/Products/modify_process.php method=post>
            <div class="container-fluid">
              <section class="container col-md-12">
                <div class="container-page">
                  <input type="hidden" name="productid" class="form-control" id="" value="">  

                  <div class="form-group row">
                    <label>상품명</label>
                    <input type="" name="productname" class="form-control" id="" value="">
                  </div>
                  
                  <div class="form-group row">
                    <label>가격</label>
                    <input type="" name="price" class="form-control" id="" value="">
                  </div>        
                  
                  <div class="form-group row">
                    <label>대표 사진</label>
                    <input type="" name="imageurl" class="form-control" id="" value="">
                  </div>      

                  <div class="form-group row">
                    <label>상품 소개</label>
                    <textarea id="description" name="description" class="form-control" id="" value=""></textarea>
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
    <script src="js/modify_product.js"></script>
    <script>
      var data = {
  <?php
    require_once '../Products/product_bo.php';
    $productbo = new ProductBO();
    if($products = $productbo->findID($_GET["productid"])) {
      if($productrow = $products->fetch_assoc()) {
        printf('"productid":"%s",
          "productname":"%s",
          "price":"%s",
          "imageurl":"%s",
          "description":%s',
            $_GET["productid"],
            $productrow["productname"], $productrow["price"],
            $productrow["imageurl"], json_encode($productrow["description"]));
      }
    }
  ?>
      };
      var type =
  <?php
    printf('"%s"', $_SESSION['type']);
  ?>
      ;
      var CurrentMenu = "manage_accounts";
      $("#" + CurrentMenu).addClass("active");
      fillForm(data);
      refreshMenu(type);
    </script>
  </body>
</html>