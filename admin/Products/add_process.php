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
  </head>
  <body>
<?php
  function CheckForm() {
    return
      (isset($_POST['productname'])) &&
      (isset($_POST['price']));
  }
  function BuildProductObject() {
    require_once '../Products/product_vo.php';
    session_start();
    return new ProductVO(
      $_SESSION['id'],
      $_POST['productname'],
      $_POST['price'],
      $_POST['imageurl'],
      $_POST['contents']);
  }

  if(CheckForm()) {
    require_once '../Products/product_bo.php';
    $productbo = new ProductBO();
    $product = BuildProductObject();
    $productbo->add($product);
  }
  printf("%s", "<script>opener.location.reload(); self.opener = self; window.close();</script>");
?>
  </body>
</html>