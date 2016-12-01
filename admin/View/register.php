<?php
  require_once '../Accounts/required_admin.php';
?>
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
    <script src="http://d1p7wdleee1q2z.cloudfront.net/post/search.min.js"></script>
    <script src="js/3rdparty/cryptojs/sha1.js"></script>
    <script src="js/register.js"></script>
    <script> $(function() { $("#postcodify_search_button").postcodifyPopUp(); }); </script>
  </head>
  <body>
    <form name="register" action=/Accounts/register_process.php method=post onsubmit="return OnSubmitEvent();">
      <div class="container-fluid">
        <section class="container">
          <div class="container-page">        
            <h3 class="dark-grey">가입</h3>
            
            <div class="form-group row">
              <div class="no-gutter col-md-12">
                <label>사용자 타입</label>
              </div>
              <div class="no-gutter radio">
                <label><input type="radio" name="accounttype" value="0" checked="checked">판매자</label>
                <label><input type="radio" name="accounttype" value="1">리뷰어</label>
              </div>
            </div>

            <div class="form-group row">
              <div class="no-gutter col-md-12">
                <label>아이디</label>
              </div>
              <div class="col-md-10 no-gutter">
                <input type="" name="id" class="form-control" id="" value="">
              </div>
              <div class="col-md-2 no-gutter">
                <button type="button" id="verify_id" class="btn col-md-12 btn-primary">중복 ID 확인</button>
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
              <input type="" name="name" class="form-control" id="" value="">
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
              <input type="" name="businessnum" class="form-control" id="" value="">
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
                <button type="submit" class="btn btn-primary col-md-12">가입 신청</button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </form>
    <script>
      $('input[type="radio"][name="accounttype"]').on('change', function(e) {
        if($(this).val() === "0")
          showSellerOnlyForms();
        else
          hideSellerOnlyForms();
      });
      $('#verify_id').click(function() {
        $.ajax({
          type: 'get',
          dataType: 'text',
          url: '/Accounts/check_id.php',
          data: {id: document.forms["register"]["id"].value},
          success: function (data) {
            alert(data);
          },
          error: function (request, status, error) {
            console.log('code: '+request.status+"\n"+'message: '+request.responseText+"\n"+'error: '+error);
          }
        });
      });
    </script>
  </body>
</html>