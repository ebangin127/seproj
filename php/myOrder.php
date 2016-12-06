<?php
	require 'sql.php';

	function state($state){
		if($state == 'preparingship'){
			return '배송 준비중';
		}
		if($state == 'shipping'){
			return '배송 중';
		}
		if($state == 'completed'){
			return '배송 완료';
		}
		if($state == 'exchangewaiting'){
			return '교환 준비중';
		}
		if($state == 'refundwaiting'){
			return '환불 준비중';
		}
		if($state == 'exchangeshipped'){
			return '교환 완료';
		}
		if($state == 'refundshipped'){
			return '환불 완료';
		}
		return null;
	};


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
		$productname .= $prerow['productname'];
		for($i=1;$i<$count;$i++){
			$row = mysqli_fetch_assoc($result);
			if($prerow['seller'] == $row['seller'] && $prerow['orderid'] == $row['orderid']){
				$productname .= ', '.$row['productname'];
				$prerow = $row;
			}
			else{
				$state = state($prerow['state']);
				$tmpHTML .= '<tr><td class="ellipsis">'.$productname.'</td><td class="ellipsis">'.$prerow['shipmethod4sending'].'</td><td class="ellipsis">'.$prerow['trackno4sending'].'</td><td class="ellipsis">'.$state.'</td><td style="padding-left:3px; padding-top:5px;"><button type="button" class="btn btn-default btn-sm" id="exchange-refund" onclick="er('.$prerow['orderid'].')"><span class="glyphicon glyphicon-list-alt"></span></button></td></tr>';
				$productname = $row['productname'];
				$prerow = $row;
			}
		}
		$state = state($prerow['state']);
		$tmpHTML .= '<tr><td class="ellipsis">'.$productname.'</td><td class="ellipsis">'.$prerow['shipmethod4sending'].'</td><td class="ellipsis">'.$prerow['trackno4sending'].'</td><td class="ellipsis">'.$state.'</td><td style="padding-left:3px; padding-top:5px;"><button type="button" class="btn btn-default btn-sm" id="exchange-refund" onclick="er('.$prerow['orderid'].')"><span class="glyphicon glyphicon-list-alt"></span></button></td></tr>';
		echo $tmpHTML;
	}

?>


