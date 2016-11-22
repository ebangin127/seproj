<?php
	$db = mysqli_connect("box708.bluehost.com", "naraeonn_se", "vG,:B2\"*7rp4RUe,", "naraeonn_se");

	$ID = $_POST['ID'];
	$PW = $_POST['PW'];
	$email = $_POST['email'];
	$name = $_POST['name'];
	$phonenum = $_POST['phonenum'];
	$zipcode = $_POST['zipcode'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$type = 'buyer';

	require 'sql.php'
	mysqli_query($db, $sign_sql);

	session_start();
	$_SESSION['ID'] = $ID;
	echo "<script> alert('회원가입이 완료되었습니다.'); history.go(-2); </script>";

	mysqli_close($db);
?>
