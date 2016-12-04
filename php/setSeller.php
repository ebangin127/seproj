<?php
	require 'sql.php';

	$orderid = $_GET['orderid'];
	$result = sqlFindorder($orderid);
	$row = 	mysqli_fetch_assoc($result);
	$result = sqlDuplicatedID($row['seller']);
	$row = 	mysqli_fetch_assoc($result);
	echo $row['name'].'?'.$row['address1'].' '.$row['address2'].'?'.$row['phonenum'];
?>