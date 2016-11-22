// login
<?php
	session_start();
	$ID = $_POST['ID'];
	$PW = $_POST['PW'];

	$db = mysqli_connect("box708.bluehost.com", "naraeonn_se", "vG,:B2\"*7rp4RUe,", "naraeonn_se");

	require 'sql.php'
	$result = mysqli_query($db, $login_sql);

	if(mysqli_num_rows($result) == 0){
		echo "<script> alert('아이디 또는 패스워드가 잘못 입력되었습니다. 다시 확인하여 입력해주세요.'); history.go(-1); </script>";
	}
	else{
		$_SESSION['user_id'] = $id;
		echo "<script> alert('로그인되었습니다.'); history.go(-2); </script>";
	}

	mysqli_close($db);
?>
