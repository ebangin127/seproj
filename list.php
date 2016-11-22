// listing product
<?php
	class Product{
		var $productid;
		var $productname;
		var $price;
		var $imageurl;
		var $avgfreezing = 0;
		var $cnt = 1;

		function __construct($pi, $pn, $pr, $img, $fr){
			$this->productid = $pi;
			$this->productname = $pn;
			$this->price = $pr;
			$this->imageurl = $img;
			$this->avgfreezing = $fr;
		}
		public function cal_freezing($value){
			$this->cnt = $this->cnt + 1;
			$this->avgfreezing = (($this->avgfreezing * ($this->cnt - 1)) + $value) / $this->cnt
		}
	}

	$db = mysqli_connect("box708.bluehost.com", "naraeonn_se", "vG,:B2\"*7rp4RUe,", "naraeonn_se");
	require 'sql.php'
	$result = mysqli_query($connection, $productlist_sql);
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
			array_push($p_list, $product)
			$sort_list[$product->productid] = $product->avgfreezing;
			$product = new Product($row['productid'], $row['productname'], $row['price'], $row['imageurl'], $row['freezingval']);
		}
	}
	ksort($sort_list)
	$count = count($p_list)
	foreach ($sort_list as $pid => $freeval) {
		for($i = 0; $i < $count; $i++){
			if($p_list[$i]->productid == $pid){
				echo "출력!!"
				break;
			}
		}
	}


	mysqli_close($connection);
?>
