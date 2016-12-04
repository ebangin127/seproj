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
?>
