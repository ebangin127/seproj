<?php
	require 'sql.php';

	$flag = $_POST['flag'];
	$orderid = $_POST['orderid'];
	$trackingnum = $_POST['trackingNum'];
	$shipment = $_POST['ship'];

	if($shipment == "0")
		$shipment = "cj";
	if($shipment == "1")
		$shipment = "postoffice";
	if($shipment == "2")
		$shipment = "hanjin";
	if($shipment == "3")
		$shipment = "logen";
	if($shipment == "4")
		$shipment = "kgb";

	sqlER($flag, $orderid, $trackingnum, $shipment);
	echo "<script>alert('교환/환불 요청이 완료되었습니다.'); location.href = '../htm/myPage.html';</script>";

?>