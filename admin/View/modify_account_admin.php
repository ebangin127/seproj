<?php
  require_once '../Accounts/required_admin.php';
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
          <h1 class="page-header">회원 정보 변경 (관리자)</h1>
          <form name="register" action=/Accounts/modify_process_admin.php method=post onsubmit="return OnSubmitEvent();">
            <div class="container-fluid">
              <section class="container col-md-12">
                <div class="container-page">
                  <input type="hidden" name="accounttype" class="form-control" id="" value="">  
                  
                  <div class="form-group row">
                    <div class="no-gutter col-md-12">
                      <label>아이디</label>
                      <div id="id"></div>
                      <input type="hidden" name="id" class="form-control" id="" value="">
                    </div>
                  </div>
                  
                  <div class="form-group row">
                    <label>비밀번호</label>
                    <input type="password" name="pw" class="form-control" id="" value="">
                  </div>
                  
                  <div class="form-group row">
                    <label>비밀번호 확인</label>
                    <input type="password" name="pw_confirm" class="form-control" id="" value="">
                  </div>
                                  
                  <div class="form-group row">
                    <label>이메일 주소</label>
                    <input type="" name="email" class="form-control" id="" value="">
                  </div>
                  
                  <div class="form-group row">
                    <label>이메일 주소 확인</label>
                    <input type="" name="email_confirm" class="form-control" id="" value="">
                  </div>        
                  
                  <div class="form-group row">
                    <label>이름</label>
                    <div id="name"></div>
                    <input type="hidden" name="name" class="form-control" id="" value="">
                  </div>      

                  <div class="form-group row">
                    <label>전화번호</label>
                    <input type="" name="phonenum" class="form-control" id="" value="">
                  </div>      

                  <div class="form-group row">
                    <div class="no-gutter col-md-12">
                      <label>우편번호</label>
                    </div>
                    <div class="col-md-10 no-gutter">
                      <input name="zipcode" class="form-control postcodify_postcode5" id="" value="">
                    </div>
                    <div class="col-md-2 no-gutter">
                      <button type="button" id="postcodify_search_button" class="btn col-md-12 btn-primary">검색</button>
                    </div>
                  </div>   

                  <div class="form-group row">
                    <div class="no-gutter">
                      <label>주소</label>
                    </div>
                    <div class="col-md-4 no-gutter">
                      <input type="text" name="address1" class="form-control address postcodify_address" id="" value="">
                    </div>
                    <div class="col-md-8 no-gutter">
                      <input type="" type="text" name="address2" class="form-control postcodify_details" id="" value="">
                    </div>
                  </div>
                  
                  <div class="form-group row seller-only">
                    <label>사업자등록번호</label>
                    <div id="businessnum"></div>
                  </div>
                  
                  <div class="form-group row seller-only">
                    <label>계좌</label>
                    <div class="form-inline">
                      <div class="row">
                        <div class="col-md-2">
                          <label for="bankcode">금융결제원 은행코드 <a href="http://www.kftc.or.kr/kftc/data/EgovBankListMove.do">(?)</a></label>
                        </div>
                        <div class="col-md-10">
                          <input type="" name="bankcode" class="form-control" id="" value="">
                        </div>
                      </div>
                    </div>

                    <div class="form-inline">
                      <div class="row">
                        <div class="col-md-2">
                          <label for="accountnum">계좌번호</label>
                        </div>
                        <div class="col-md-10">
                          <input type="" name="accountnum" class="form-control" id="" value="">
                        </div>
                      </div>
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
    <script src="js/modify_account_admin.js"></script>
    <script>
      var data = {
  <?php
    require_once '../Accounts/account_bo.php';
    $accountbo = new AccountBO();
    if($accounts = $accountbo->getIDAggregated($_GET["id"])) {
      if($accountrow = $accounts->fetch_assoc()) {
        printf('"ID":"%s",
          "name":"%s",
          "email":"%s",
          "phonenum":"%s",
          "zipcode":"%s",
          "address1":"%s",
          "address2":"%s",
          "type":"%s",
          "BusinessNumber":"%s",
          "bankcode":"%s",
          "accountnum":"%s"',  
            $_GET["id"], $accountrow["name"],
            $accountrow["email"], $accountrow["phonenum"],
            $accountrow["zipcode"], $accountrow["address1"],
            $accountrow["address2"], $accountrow["type"],
            $accountrow["BusinessNumber"], $accountrow["bankcode"],
            $accountrow["accountnum"]);
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
      fillHiddenForm(data);
    </script>
  </body>
</html>