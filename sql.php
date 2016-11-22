<?php
	$sign_sql = "INSERT INTO Accounts (ID, PW, email, name, phonenum, zipcode, address1, address2, type)
			VALUES ('$ID', SHA1('$PW'), '$email', '$name', '$phonenum', '$zipcode', '$address1', '$address2', '$type')";
	$login_sql = "SELECT * FROM Accounts WHERE ID = '$ID' AND PW = SHA1('$PW')";
	$productlist_sql = "SELECT Products.productid, Products.productname, Products.price, Products.imageurl, Benchmarks.freezingval
						FROM Products INNER JOIN Benchmarks ON Products.productid = Benchmarks.productid
						ORDER BY Products.productid"
?>
