<?php
	//login
	require 'sql.php';

	$ID= $_POST['id'];
	$PW = $_POST['password'];

	$result = sqlLogin($ID, $PW);
	if(mysqli_num_rows($result) == 0){
		echo "<script> alert('아이디 또는 패스워드가 잘못 입력되었습니다. 다시 확인하여 입력해주세요.'); history.go(-1); </script>";
	}
	else{
		echo "<script src='http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js'></script>";
		echo "<script src='../js/jquery.session.js'></script>";
		echo "<script> $.session.set('user_id', '$ID'); alert('로그인되었습니다.'); history.go(-1);</script>";
	}
?>
