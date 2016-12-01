<?php
  require_once '../Accounts/required_selleronly.php';
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
    <form name="newproduct" action=/Products/add_product.php method=post onsubmit="return OnSubmitEvent();">
      <div class="container-fluid">
        <section class="container">
          <div class="container-page">        
            <h3 class="dark-grey">상품 등록</h3>
                            
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
              <textarea name="contents" class="form-control" id="" value=""></textarea>
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
  </body>
</html>