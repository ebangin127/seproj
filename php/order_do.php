<?php
	require 'sql.php';

	$buyer = $_POST['buyer'];
	$name = $_POST['id'];
	$phonenum = $_POST['phonenum'];
	$zipcode = $_POST['zipcode'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$pid = $_POST['directOrder'];
	$qty = $_POST['qty'];
	if($pid == "0"){
		$cart = sqlMycart($buyer);
		$count = mysqli_num_rows($cart);

		$rowC = mysqli_fetch_assoc($cart);
		$seller = $rowC['seller'];
		$orderid = sqlAddorder($seller, $buyer, $name, $phonenum, $zipcode, $address1, $address2);
		sqlAddop($orderid, $rowC['productid'], $rowC['price'], $rowC['qty']);
		for($i=1;$i<$count;$i++){
			$rowC = mysqli_fetch_assoc($cart);
			if($seller != $rowC['seller']){
				$seller = $rowC['seller'];
				$orderid = sqlAddorder($seller, $buyer, $name, $phonenum, $zipcode, $address1, $address2);
				sqlAddop($orderid, $rowC['productid'], $rowC['price'], $rowC['qty']);
			}
			else{
				sqlAddop($orderid, $rowC['productid'], $rowC['price'], $rowC['qty']);
			}
		}
		sqltrunMycart($buyer);
		echo "<script>alert('주문이 완료되었습니다.'); location.href = '../htm/completeOrder.html';</script>";
	}
	else{
		$result = sqlProductView($pid);
		$row = mysqli_fetch_assoc($result);
		$seller = $row['seller'];
		$orderid = sqlAddorder($seller, $buyer, $name, $phonenum, $zipcode, $address1, $address2);
		sqlAddop($orderid, $row['productid'], $row['price'], $qty);
		echo "<script>alert('바로 구매가 완료되었습니다.'); location.href = '../htm/completeOrder.html';</script>";
	}
?>

