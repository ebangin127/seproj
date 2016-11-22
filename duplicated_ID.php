// for ajax check duplicated ID
<?php
	$id = $_GET['id'];

	$db = mysqli_connect("box708.bluehost.com", "naraeonn_se", "vG,:B2\"*7rp4RUe,", "naraeonn_se");

	$sql = "SELECT * FROM Accounts";
	$result = mysqli_query($db, $sql);
	$count = mysqli_num_rows($result);

	for($i=0;$i<$count;$i++){
		$row = mysqli_fetch_assoc($result);
		if($id == $row[?]){
			echo "<script> alert('이미 사용중인 아이디입니다.'); history.go(-1); </script>";
			return false;
		}
	}

	echo "<script> alert('사용할 수 있는 아이디입니다.'); history.go(-1); </script>";
	return true;
?>
