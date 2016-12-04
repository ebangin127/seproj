<?php
	require 'sql.php';
	$id = $_GET['id'];
	$result = sqlMypage($id);

	$row = mysqli_fetch_assoc($result);

	echo $row['name']."?".$row['ID']."?".$row['address1']." ".$row['address2']."?".$row['phonenum']."?".$row['email'];
?>