<?php

//	$db = mysqli_connect("box708.bluehost.com", "naraeonn_se", "vG,:B2\"*7rp4RUe,", "naraeonn_se");

	function sqlLogin($ID, $PW){
		$db = mysqli_connect("localhost", "root", "", "test");
		$login_sql = "SELECT * FROM Accounts WHERE ID = '$ID' AND PW = SHA1('$PW')";
		$result = mysqli_query($db, $login_sql);
		return $result;
	}

	function sqlSign($ID, $PW, $email, $name, $phonenum, $zipcode, $address1, $address2, $type){
		$db = mysqli_connect("localhost", "root", "", "test");
		$sign_sql = "INSERT INTO Accounts (ID, PW, email, name, phonenum, zipcode, address1, address2, type)
				VALUES ('$ID', SHA1('$PW'), '$email', '$name', '$phonenum', '$zipcode', '$address1', '$address2', '$type')";
		$result = mysqli_query($db, $sign_sql);
		return $result;
	}

	function sqlProductList($search){
		$db = mysqli_connect("localhost", "root", "", "test");
		if($search == false){
			$productlist_sql = "SELECT Products.productid, Products.productname, Products.price, Products.imageurl, Benchmarks.freezingval, Products.description
								FROM Products INNER JOIN Benchmarks ON Products.productid = Benchmarks.productid
								ORDER BY Products.productid";
		}
		else{
			$productlist_sql = "SELECT Products.productid, Products.productname, Products.price, Products.imageurl, Benchmarks.freezingval, Products.description
								FROM Products INNER JOIN Benchmarks ON Products.productid = Benchmarks.productid WHERE productname LIKE '%$search%'
								ORDER BY Products.productid";
		}
		$result = mysqli_query($db, $productlist_sql);
		return $result;
	}

	function sqlProductView($productid){
		$db = mysqli_connect("localhost", "root", "", "test");
		$productView_sql = "SELECT * FROM Products WHERE productid = $productid";
		$result = mysqli_query($db, $productView_sql);
		return $result;
	}

	function sqlBenchmarkData($productid){
		$db = mysqli_connect("localhost", "root", "", "test");
		$benchmarkData_sql = "SELECT * FROM Benchmarks WHERE productid = $productid";
		$result = mysqli_query($db, $benchmarkData_sql);
		return $result;
	}

	function sqlAddcart($buyer, $productid, $qty){
		$db = mysqli_connect("localhost", "root", "", "test");
		$addCart_sql = "INSERT INTO Cart (buyer, productid, qty) VALUES ('$buyer', $productid, $qty)
						ON DUPLICATE KEY UPDATE qty = VALUES(qty) + qty";
		$result = mysqli_query($db, $addCart_sql);
		if($result)
			return $result;
		else
			return $addCart_sql;
	}

	function sqlDelcart($buyer, $productid){
		$db = mysqli_connect("localhost", "root", "", "test");
		$delCart_sql = "DELETE FROM Cart WHERE buyer = '$buyer' AND productid = $productid";
		$result = mysqli_query($db, $delCart_sql);
		return $result;
	}

	function sqlDuplicatedID($ID){
		$db = mysqli_connect("localhost", "root", "", "test");
		$login_sql = "SELECT * FROM Accounts WHERE ID = '$ID'";
		$result = mysqli_query($db, $login_sql);
		return $result;
	}

	function sqlMypage($ID){
		$db = mysqli_connect("localhost", "root", "", "test");
		$mypage_sql = "SELECT * FROM Accounts WHERE ID = '$ID'";
		$result = mysqli_query($db, $mypage_sql);
		return $result;
	}

	function sqlMycart($ID){
		$db = mysqli_connect("localhost", "root", "", "test");
		$mycart_sql = "SELECT Products.productid, Products.seller, Products.productname, Products.price, Products.imageurl, Products.description, Cart.qty
					   FROM Products INNER JOIN Cart ON Products.productid = Cart.productid WHERE buyer = '$ID' ORDER BY Products.seller";
		$result = mysqli_query($db, $mycart_sql);
		return $result;
	}

	function sqlAddorder($seller, $buyer, $name, $phonenum, $zipcode, $address1, $address2){
		$db = mysqli_connect("localhost", "root", "", "test");
		$addOrder_sql = "INSERT INTO Orders (state, seller, buyer, name, phonenum, zipcode, address1, address2, trackno4sending, trackno4returning, shipmethod4sending, shipmethod4returning) 
						 VALUES ('preparingship', '$seller', '$buyer', '$name', '$phonenum', '$zipcode', '$address1', '$address2', '1', '1', 'cj', 'cj')";
		$result = mysqli_query($db, $addOrder_sql);
		$sql = "SELECT orderid FROM Orders ORDER BY orderid DESC";
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($result);
		return $row['orderid'];
	}

	function sqlFindorder($orderid){
		$db = mysqli_connect("localhost", "root", "", "test");
		$findOrder_sql = "SELECT * FROM Orders WHERE orderid = $orderid";
		$result = mysqli_query($db, $findOrder_sql);
		return $result;
	}
	
	function sqlMyOrder($ID){
		$db = mysqli_connect("localhost", "root", "", "test");
		$findOrder_sql = "SELECT Orders.orderid, Products.productname, Products.seller, Orders.shipmethod4sending, Orders.trackno4sending
						  FROM Orders INNER JOIN OrderProducts ON OrderProducts.orderid = Orders.orderid 
						  INNER JOIN Products ON OrderProducts.productid = Products.productid WHERE Orders.buyer = '$ID'";
		$result = mysqli_query($db, $findOrder_sql);
		return $result;	
	}

	function sqltrunMycart($ID){
		$db = mysqli_connect("localhost", "root", "", "test");
		$mycart_sql = "DELETE FROM Cart WHERE buyer = '$ID'";
		$result = mysqli_query($db, $mycart_sql);
		return $result;	
	}

	function sqlAddop($orderid, $productid, $price, $qty){
		$db = mysqli_connect("localhost", "root", "", "test");
		$addOP_sql = "INSERT INTO OrderProducts (orderid, productid, price, qty) VALUES ($orderid, $productid, $price, $qty)";
		$result = mysqli_query($db, $addOP_sql);
		return $result;	
	}

	function sqlER($flag, $orderid, $trackingnum, $ship){
		$db = mysqli_connect("localhost", "root", "", "test");
		if($flag == 0){
			$reqER_sql = "UPDATE Orders SET state='refundwaiting', trackno4returning='$trackingnum', shipmethod4returning='$ship' WHERE orderid = $orderid";
		}
		if($flag == 1){
			$reqER_sql = "UPDATE Orders SET state='exchangewaiting', trackno4returning='$trackingnum', shipmethod4returning='$ship' WHERE orderid = $orderid";
		}
		$result = mysqli_query($db, $reqER_sql);
		return $result;
	}
?>
