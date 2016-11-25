<?php
	require 'sql.php';
	$dup = $_GET['dup'];

	$ID = $_POST['id'];
	$PW = $_POST['password'];
	$email = $_POST['email'];
	$name = $_POST['name'];
	$phonenum = $_POST['phonenum'];
	$zipcode = $_POST['zipcode'];
	$address1 = $_POST['address1'];
	$address2 = $_POST['address2'];
	$type = 'buyer';

	$result = sqlSign($ID, $PW, $email, $name, $phonenum, $zipcode, $address1, $address2, $type);

	if($result){
		session_start();
		$_SESSION['ID'] = $ID;
		echo "<script> alert('회원가입이 완료되었습니다.'); history.go(-2); </script>";
	}
	else{
		echo "<script> alert('회원가입에 실패했습니다.'); history.go(-2); </script>";
	}
?>
