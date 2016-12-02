<?php
  require_once '../Orders/order_dao.php';
  class OrderBO {
    private $orderdao;
    function __construct() {
      $this->orderdao = new OrderDAO();
    }
    function getByOrderID($OrderID) {
      $result = $this->orderdao->selectByID($OrderID);
      if(!$result)
        return 0;
      else
        return $result;
    }
    function getAll() {
      return $this->orderdao->selectAll($_SESSION["type"], $_SESSION['id']);
    }
    function getStatusInString($original) {
      switch($original) {
      case "preparingship":
        return "배송 준비중";
      case "shipping":
        return "배송중";
      case "completed":
        return "완료";
      case "exchangewaiting":
        return "교환 발송 준비중 (구매자측)";
      case "refundwaiting":
        return "반품 발송 준비중 (구매자측)";
      case "exchangeshipped":
        return "교환 발송 완료 (구매자측)";
      case "refundshipped":
        return "반품 발송 완료 (구매자측)";
      }
    }
    function setTrackingNumber($OrderID, $ShippingMethod, $TrackingNumber) {
      return $this->orderdao->updateTrackingNumber($OrderID, $ShippingMethod, $TrackingNumber);
    }
  }
?>