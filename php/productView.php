<?php
	require "sql.php";
	$pid = $_GET['pid'];
	$result = sqlProductView($pid);
	$temp = '';
	if($result){
		$row = mysqli_fetch_assoc($result);
		$temp .= $row['productid'].'?';
		$temp .= $row['seller'].'?';
		$temp .= $row['productname'].'?';
		$temp .= $row['price'].'?';
		$temp .= $row['imageurl'].'?';
		$temp .= $row['description'].'?';

		$result = sqlBenchmarkData($pid);
		if($result){
			$count = mysqli_num_rows($result);
			for($i = 0; $i < $count; $i++){
				$row = mysqli_fetch_assoc($result);
				$temp .= '<tr>';
				$temp .= '<td class="table_spec_left col-xs-2">'.$row['reviewer'].'</td>';
				$temp .= '<td class="table_spec_right col-xs-2">'.$row['minval'].'</td>';
				$temp .= '<td class="table_spec_right col-xs-2">'.$row['avgval'].'</td>';
				$temp .= '<td class="table_spec_right col-xs-2">'.$row['maxval'].'</td>';
				$temp .= '<td class="table_spec_right col-xs-2">'.$row['freezingval'].'</td>';
				$temp .= '<td class="table_spec_right col-xs-2">'.$row['imageurl'].'</td>';
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