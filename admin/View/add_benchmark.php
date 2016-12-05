<?php
  require_once '../Accounts/required_revieweronly.php';
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
    <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>
  </head>
  <body>
    <form name="newbenchmark" action=/Benchmarks/add_process.php method=post onsubmit="return OnSubmitEvent();">
      <div class="container-fluid">
        <section class="container">
          <div class="container-page">        
            <h3 class="dark-grey">상품 등록</h3>
                      
            <div class="form-group row">
              <div class="no-gutter col-md-12">
                <label>검색할 상품명</label>
              </div>
              <div class="col-md-10 no-gutter">
                <input type="" name="productname" class="form-control" id="productname" value="">
              </div>
              <div class="col-md-2 no-gutter">
                <button type="button" id="search_id" class="btn col-md-12 btn-primary">상품 번호 검색</button>
              </div>
            </div>

            <div class="form-group row">
              <label>상품 번호</label>
              <div id="productid">검색을 통해 입력해주세요</div>
              <input type="hidden" name="productid" class="form-control" id="productid_form" value="">
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
              <label>대표 사진</label>
              <input type="" name="imageurl" class="form-control" id="" value="">
            </div>      

            <div class="form-group row">
              <div class="row-sm-offset-2">
                <button type="submit" class="btn btn-primary col-md-12">등록</button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </form>
    <script>
      $('#search_id').click(function() {
        window.open('/View/search_prodid.php?name=' + document.forms["newbenchmark"]["productname"].value);
      });
    </script>
  </body>
</html>