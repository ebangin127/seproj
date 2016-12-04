<?php
	class Product{
		public $productid, $productname, $price, $imageurl, $avgfreezing = 0.0, $cnt = 1;

		function __construct($pi, $pn, $pr, $img, $fr, $des){
			$this->productid = $pi;
			$this->productname = $pn;
			$this->price = $pr;
			$this->imageurl = $img;
			$this->avgfreezing = $fr;
			$this->description = $des;
		}
		public function cal_freezing($value){
			$this->cnt = $this->cnt + 1;
			$this->avgfreezing = (($this->avgfreezing * ($this->cnt - 1)) + $value) / $this->cnt;
		}
	}

	require 'sql.php';

	$tmpHTML = '';
	if(isset($_GET['search'])){
		$search = $_GET['search'];
		$result = sqlProductList($search);
	}
	else{
		$result = sqlProductList(false);
	}
	if($result){
		$count = mysqli_num_rows($result);
		if($count == 0){ 
			echo "0";
			return;
		}
		else{
			$row = mysqli_fetch_assoc($result);
			$product = new Product($row['productid'], $row['productname'], $row['price'], $row['imageurl'], $row['freezingval'], $row['description']);
			$sort_list = array();
			$p_list = array();
			for($i = 1; $i<$count; $i++){
				$row = mysqli_fetch_assoc($result);
				if($row['productid'] == $product->productid){
					$product->cal_freezing($row['freezingval']);
				}
				else{
					array_push($p_list, $product);
					$sort_list[$product->productid] = $product->avgfreezing;
					$product = new Product($row['productid'], $row['productname'], $row['price'], $row['imageurl'], $row['freezingval'], $row['description']);
				}
			}
			array_push($p_list, $product);
			$sort_list[$product->productid] = $product->avgfreezing;

			asort($sort_list);
			$count = count($p_list);
			$tmpHTML .= $count."?";
			foreach($sort_list as $pid => $freeval){
				for($i = 0; $i < $count; $i++){
					if($p_list[$i]->productid == $pid){
						$temp = '<div class="col-sm-4 col-lg-4 col-md-4"><div class="thumbnail">';
						$temp .= '<img src="../public/images/'.$p_list[$i]->imageurl.'" alt=""><div class="caption">';
						$temp .= '<h4 class="pull-right">'.$p_list[$i]->price.'원</h4>';
						$temp .= '<h4><a href="../htm/selectProduct.html#pid='.$p_list[$i]->productid.'">'.$p_list[$i]->productname.'</a>';
						$temp .= '</h4><p class="pull-right">Average Freezing : '.$p_list[$i]->avgfreezing.'</p><br><p>'.$p_list[$i]->description.'</p>';
						$temp .= '</div></div></div>?';
						$tmpHTML .= $temp;
						break;
					}
				}
			}
			echo $tmpHTML;
		}
	}
	else
		echo"<script>console.log('productList error');</script>";

?>