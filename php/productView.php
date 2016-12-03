<?php
	require "sql.php";
	$pid = $_GET['pid'];
	$result = sqlProductView($pid);
	$temp = '';
	if($result){
		$row = mysqli_fetch_assoc($result);
		$temp .= 'productid = '.$row['productid'].'<br>';
		$temp .= 'seller = '.$row['seller'].'<br>';
		$temp .= 'productname = '.$row['productname'].'<br>';
		$temp .= 'price = '.$row['price'].'<br>';
		$temp .= 'imageurl = '.$row['imageurl'].'<br>';
		$temp .= 'description = '.$row['description'].'<br>?';

		$result = sqlBenchmarkData($pid);
		if($result){
			$count = mysqli_num_rows($result);
			for($i = 0; $i < $count; $i++){
				$row = mysqli_fetch_assoc($result);
				$temp .= '<tr class="hidden-sm hidden-xs">';
				$temp .= '<td>'.$row['reviewer'].'</td>';
				$temp .= '<td>'.$row['imageurl'].'</td>';
				$temp .= '<td>'.$row['maxval'].'</td>';
				$temp .= '<td>'.$row['minval'].'</td>';
				$temp .= '<td>'.$row['avgval'].'</td>';
				$temp .= '<td>'.$row['freezingval'].'</td>';
				$temp .= '</tr>';
			}
			echo $temp;
		}
		else
			echo"<script>console.log('BenchmarkData error');</script>";
	}
	else
		echo"<script>console.log('productView error');</script>";

?>
