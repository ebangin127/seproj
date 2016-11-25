<?php
	require 'sql.php'
	$buyer = $_POST['buyer']			// buyer id
	$productid = $_POST['productid']
	$db = mysqli_connect("box708.bluehost.com", "naraeonn_se", "vG,:B2\"*7rp4RUe,", "naraeonn_se");

	function addCart(){
		$qty = $_POST['qty']
		$result = mysqli_query($connection, $addCart_sql);

		if($result){
			echo "<script> alert('추가되었습니다.'); history.go(-1); </script>";
		}
		else{
			// error
		}
	}

	function delCart(){
		$result = mysqli_query($connection, $delCart_sql);

		if($result){
			echo "<script> alert('삭제되었습니다.'); history.go(-1); </script>";
		}
		else{
			// error
		}
	}
}?>
