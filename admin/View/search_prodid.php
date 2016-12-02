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
    <div class="table-responsive">
      <table id="products" class="table table-striped">
        <thead>
          <th>상품명</th>
          <th>상품 번호</th>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
    <script src="/View/js/search_prodid.js"></script>
    <script>
      var data = [
  <?php
    require_once '../Products/product_bo.php';
    $productbo = new ProductBO();
    if($products = $productbo->findProduct($_GET["name"])) {
      if($productrow = $products->fetch_assoc()) {
        printf('{"productname":"<a href=\"\" onclick=\"applyProductId(%s);\">%s</a>",
          "productid":"%s"},',
          $productrow["productid"],
          $productrow["productname"],
          $productrow["productid"]);
      }
    }
  ?>
      ];
      printTable("products", data);
    </script
  </body>
</html>