<?php
	require 'sql.php';
	$id = $_GET['id'];

	$result = sqlMycart($id);
	$count = mysqli_num_rows($result);
	if($count == 0){
		echo 0;
	}
	else{
		$row = mysqli_fetch_assoc($result);
		$seller = $row['seller'];
		$total = 0;
		$sellerCount = 1;
		$tmpHTML = '<div class="panel panel-default"><div class="panel-heading"><div class="panel-title"><div class="row"><div class="col-xs-6"><h5><span class="glyphicon glyphicon-user"></span><strong> 판매자명 : '.$seller.'</strong></h5></div></div></div></div><div class="panel-body">';
		$tmpHTML .= '<div class="row"><div class="hidden-xs col-sm-2"><img class="img-responsive" src="http://placehold.it/100x70"></div><div class="col-xs-4 col-sm-4"><h4 class="product-name"><strong>'.$row['productname'].'</strong></h4><h4><small class="hidden-xs">'.$row['description'].'</small></h4></div><div class="col-xs-8 col-sm-6"><div class="col-xs-6"><h5>&#8361 '.$row['price'].'</h5></div><div class="col-xs-3"><h5>'.$row['qty'].'</h5></div><div class="col-xs-3"><button type="button" class="btn btn-link btn-xs" style="margin-top:5px;"><span class="glyphicon glyphicon-trash" onclick="delcart('.$row['productid'].')"></span></button></div></div></div><hr>';
		$total += $row['price'] * $row['qty'];
		for($i=1;$i<$count;$i++){
			$row = mysqli_fetch_assoc($result);
			if($seller == $row['seller']){
				$tmpHTML .= '<div class="row"><div class="hidden-xs col-sm-2"><img class="img-responsive" src="http://placehold.it/100x70"></div><div class="col-xs-4 col-sm-4"><h4 class="product-name"><strong>'.$row['productname'].'</strong></h4><h4><small class="hidden-xs">'.$row['description'].'</small></h4></div><div class="col-xs-8 col-sm-6"><div class="col-xs-6"><h5>&#8361 '.$row['price'].'</h5></div><div class="col-xs-3"><h5>'.$row['qty'].'</h5></div><div class="col-xs-3"><button type="button" class="btn btn-link btn-xs" style="margin-top:5px;"><span class="glyphicon glyphicon-trash" onclick="delcart('.$row['productid'].')"></span></button></div></div></div><hr>';
				$total += $row['price'] * $row['qty'];
			}
			else{
				$seller = $row['seller'];
				$tmpHTML .= '</div></div><div class="panel panel-default"><div class="panel-heading"><div class="panel-title"><div class="row"><div class="col-xs-6"><h5><span class="glyphicon glyphicon-user"></span><strong> 판매자명 : '.$seller.'</strong></h5></div></div></div></div><div class="panel-body">';
				$tmpHTML .= '<div class="row"><div class="hidden-xs col-sm-2"><img class="img-responsive" src="http://placehold.it/100x70"></div><div class="col-xs-4 col-sm-4"><h4 class="product-name"><strong>'.$row['productname'].'</strong></h4><h4><small class="hidden-xs">'.$row['description'].'</small></h4></div><div class="col-xs-8 col-sm-6"><div class="col-xs-6"><h5>&#8361 '.$row['price'].'</h5></div><div class="col-xs-3"><h5>'.$row['qty'].'</h5></div><div class="col-xs-3"><button type="button" class="btn btn-link btn-xs" style="margin-top:5px;"><span class="glyphicon glyphicon-trash" onclick="delcart('.$row['productid'].')"></span></button></div></div></div><hr>';
				$total += $row['price'] * $row['qty'];
				$sellerCount++;
			}
		}
		$tmpHTML .= '</div></div>';
		echo $sellerCount.'?'.$total.'?'.$tmpHTML;	
	}
?>
