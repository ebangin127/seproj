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
      (isset($_POST['shippingmethod'])) &&
      (isset($_POST['trackingnumber']));
  }

  if(CheckForm()) {
    require_once '../Orders/order_bo.php';
    $orderbo = new OrderBO();
    $orderbo->setTrackingNumber($_POST['orderid'], $_POST['shippingmethod'], $_POST['trackingnumber']);
  }
  printf("<script>window.location.href = '%s';</script>", $_SERVER['HTTP_REFERER']);
?>
  </body>
</html>