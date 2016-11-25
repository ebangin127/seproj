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

	function sqlProductList(){
		$db = mysqli_connect("localhost", "root", "", "test");
		$productlist_sql = "SELECT Products.productid, Products.productname, Products.price, Products.imageurl, Benchmarks.freezingval
							FROM Products INNER JOIN Benchmarks ON Products.productid = Benchmarks.productid
							ORDER BY Products.productid";
		$result = mysqli_query($db, $productlist_sql);
		return $result;
	}

	function sqlAddcart($buyer, $productid, $qty){
		$db = mysqli_connect("localhost", "root", "", "test");
		$addCart_sql = "INSERT INTO Cart (buyer, productid, qty) VALUES ('$buyer, $productid, $qty')";
		$result = mysqli_query($db, $addCart_sql);
		return $result;
	}

	function sqlDuplicatedID($ID){
		$db = mysqli_connect("localhost", "root", "", "test");
		$login_sql = "SELECT * FROM Accounts WHERE ID = '$ID'";
		$result = mysqli_query($db, $login_sql);
		return $result;
	}
?>
