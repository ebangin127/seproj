function getParamsMap() {
	var temp = window.location.href.split("?");
	var params = temp[1].split("&");
	var paramsMap = {};
	params.forEach(function (p) {
		var v = p.split("=");
		paramsMap[v[0]]=decodeURIComponent(v[1]);
	});
	return paramsMap;
};

$(document).ready(function(){
	var paramsMap = getParamsMap();
	if(paramsMap['page']){
		$.ajax({
			url:'../php/productList.php?search='+paramsMap['search'],
			success:function(data){
				console.log(temp);
				temp = data.split("?");
				if(temp[0]==0){
					console.log("!!!");
					$("#noResult").html("검색결과가 없습니다.");
				}
				else{
					page = parseInt(paramsMap['page']);
					$cnt = (temp[0] - (temp[0]%9)) / 9 + 1;
					for($i=1;$i<=$cnt;$i++){
						$("#pages").append("<li><a href='../htm/searchProduct.html?search="+paramsMap['search']+"&page="+$i+"'>"+$i+"</a></li>");
					}
					
					for($n=1;$n<=9;$n++){
						if(!temp[(page-1) * 9 + $n]){
							break;
						}
						$("#products").append(temp[(page-1) * 9 + $n]);
					}
				}
			}
		});
	}
	else{
		$.ajax({
			url:'../php/productList.php?search='+paramsMap['search'],
			success:function(data){
				temp = data.split("?");
				console.log(temp);
				if(temp[0]==0){
					$("#noResult").html("검색결과가 없습니다.");
				}
				else{
					$cnt = (temp[0] - (temp[0]%9)) / 9 + 1;
					for($i=1;$i<=$cnt;$i++){
						console.log(paramsMap['search']);
						$("#pages").append("<li><a href='../htm/searchProduct.html?search="+paramsMap['search']+"&page="+$i+"'>"+$i+"</a></li>");
					}

					for($n=1;$n<=9;$n++){
						console.log(temp[$n]);
						if(!temp[$n]){
							break;
						}
						$("#products").append(temp[$n]);
					}
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