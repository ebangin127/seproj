<?php
	class Product{
		public $productid, $productname, $price, $imageurl, $avgfreezing = 0, $cnt = 1;

		function __construct($pi, $pn, $pr, $img, $fr){
			$this->productid = $pi;
			$this->productname = $pn;
			$this->price = $pr;
			$this->imageurl = $img;
			$this->avgfreezing = $fr;
		}
		public function cal_freezing($value){
			$this->cnt = $this->cnt + 1;
			$this->avgfreezing = (($this->avgfreezing * ($this->cnt - 1)) + $value) / $this->cnt;
		}
	}

	require 'sql.php';

	$tmpHTML = '';
	$result = sqlProductList();
	if($result){
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
		$product = new Product($row['productid'], $row['productname'], $row['price'], $row['imageurl'], $row['freezingval']);
		$sort_list = array();
		$p_list = array($product);
		for($i = 1; $i<$count; $i++){
			$row = mysqli_fetch_assoc($result);
			if($row['productid'] == $product->productid){
				$product->cal_freezing($row['freezingval']);
			}
			else{
				array_push($p_list, $product);
				$sort_list[$product->productid] = $product->avgfreezing;
				$product = new Product($row['productid'], $row['productname'], $row['price'], $row['imageurl'], $row['freezingval']);
			}
		}
		array_push($p_list, $product);
		$sort_list[$product->productid] = $product->avgfreezing;

		asort($sort_list);
		$count = count($p_list);

		foreach($sort_list as $pid => $freeval){
			for($i = 0; $i < $count; $i++){
				if($p_list[$i]->productid == $pid){
					$temp = '<tr class="hidden-sm hidden-xs">';
					$temp .= '<td><a href = "../htm/view.htm#pid='.$pid.'">'.$p_list[$i]->productname.'</a></td>';
					$temp .= '<td>'.$p_list[$i]->price.'</td>';
					$temp .= '<td>'.$p_list[$i]->imageurl.'</td>';
					$temp .= '<td>'.$p_list[$i]->avgfreezing.'</td>';
					$temp .= '</tr>';
					$tmpHTML .= $temp;
					break;
				}
			}
		}
		echo $tmpHTML;
	}
	else
		echo"<script>console.log('productList error');</script>";

?>
