<?php
	function addCart(){
		require 'sql.php';
		$buyer = $_POST['buyer'];			// buyer id
		$productid = $_POST['productid'];
		$qty = $_POST['qty'];
		$result = sqlAddcart($buyer, $productid, $qty);
		if($result){
			echo true;
		}
		else{
			echo false;
		}
	}

	function delCart(){
		require 'sql.php';
		$buyer = $_POST['buyer'];			// buyer id
		$productid = $_POST['productid'];
		$result = sqlDelcart($buyer, $productid);
		if($result){
			echo "true";
		}
		else{
			echo "false";
		}
	}

	$flag = $_GET['flag'];
	if($flag == 0)
		addCart();
	else
		delCart();
?>
