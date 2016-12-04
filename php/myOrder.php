<?php
	require 'sql.php';

	$id = $_GET['id'];

	$result = sqlMyOrder($id);
	$count = mysqli_num_rows($result);
	if($count == 0){
		echo 0;
	}
	else{
		$tmpHTML = '';
		$productname = '';
		$prerow = mysqli_fetch_assoc($result);
		$seller = $prerow['seller'];
		$productname .= $prerow['productname'];
		for($i=1;$i<$count;$i++){
			$row = mysqli_fetch_assoc($result);
			if($seller != $row['seller']){
				$tmpHTML .= '<tr><td class="ellipsis">'.$productname.'</td><td class="ellipsis">'.$prerow['shipmethod4sending'].'</td><td class="ellipsis">'.$prerow['trackno4sending'].'</td><td style="padding-left:3px; padding-top:5px;"><button type="button" class="btn btn-default btn-sm" id="exchange-refund" onclick="er('.$prerow['orderid'].')"><span class="glyphicon glyphicon-list-alt"></span></button></td></tr>';
				$productname = $row['productname'];
				$prerow = $row;
			}
			else{
				$productname .= ', '.$row['productname'];
				$prerow = $row;
			}
		}
		$tmpHTML .= '<tr><td class="ellipsis">'.$productname.'</td><td class="ellipsis">'.$row['shipmethod4sending'].'</td><td class="ellipsis">'.$row['trackno4sending'].'</td><td style="padding-left:3px; padding-top:5px;"><button type="button" class="btn btn-default btn-sm" id="exchange-refund" onclick="er('.$row['orderid'].')"><span class="glyphicon glyphicon-list-alt"></span></button></td></tr>';
		echo $tmpHTML;
	}
?>


