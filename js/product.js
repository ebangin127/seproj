$(document).ready(function(){
	var paramsMap = getParamsMap();
	if(paramsMap['page']){
		$.ajax({
			url:'../php/productList.php',
			success:function(data){
				temp = data.split("?");
				page = parseInt(paramsMap['page']);
				$cnt = (temp[0] - (temp[0]%9)) / 9 + 1;
				for($i=1;$i<=$cnt;$i++){
					$("#pages").append("<li><a href='../htm/index.html?page="+$i+"'>"+$i+"</a></li>");
				}
				
				for($n=1;$n<=9;$n++){
					if(!temp[(page-1) * 9 + $n]){
						break;
					}
					$("#products").append(temp[(page-1) * 9 + $n]);
				}
			}
		});
	}
	else{
		$.ajax({
			url:'../php/productList.php',
			success:function(data){
				temp = data.split("?");
				$cnt = (temp[0] - (temp[0]%9)) / 9 + 1;
				for($i=1;$i<=$cnt;$i++){
					$("#pages").append("<li><a href='../htm/index.html?page="+$i+"'>"+$i+"</a></li>");
				}
				page = 1;
				for($n=1;$n<=9;$n++){
					if(!temp[(page-1) * 9 + $n]){
						break;
					}
					$("#products").append(temp[(page-1) * 9 + $n]);
				}
			}
		});
	}

	$("#searchbtn").click(function(){
		if($.trim($("input#search").val()) == ""){
			alert("검색어를 입력하세요.");
			$("input#search").focus();
			return false;
		}
		$(location).attr("href","../htm/searchProduct.html?search="+$("input#search").val());
	});

});

function getParamsMap() {
	var temp = window.location.href.split("?");
	if(!temp[1])
		return false;
	var params = temp[1].split("&");
	var paramsMap = {};
	params.forEach(function (p) {
		var v = p.split("=");
		paramsMap[v[0]]=decodeURIComponent(v[1]);
	});
	return paramsMap;
};