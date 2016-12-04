var a;

function getParamsMap() {
	var temp = window.location.hash.split("#");
	var params = temp[1].split("&");
	var paramsMap = {};
	params.forEach(function (p) {
		var v = p.split("=");
		paramsMap[v[0]]=decodeURIComponent(v[1]);
	});
	return paramsMap;
};

$(document).ready(function() {
	var paramsMap = getParamsMap();
	var pid = parseInt(paramsMap['pid']);

	$.ajax({
		url:'../php/productView.php?pid='+pid,
		success:function(data){
			var temp = data.split("?");
			$("#seller").html(temp[1]);
			$("#seller").html(temp[1]);
			$("#name").html(temp[2]);
			$("#price").html(temp[3]+"원");
			//$("#image").attr("src", "../public/images/"+temp[4]);
			$("#description").html(temp[5]);
			$("#tbody").html(temp[6]);
		}
	});

	$("#addCart").click(function(){
		if($.session.get('user_id')){
			var user = $.session.get('user_id');
			var formData = {productid:pid, buyer:user, qty:1};
			$.post("../php/Cart.php?flag=0", {productid:pid, buyer:user, qty:1},
				function(data){
					if(data == true){
						$("#modalBtn").trigger("click");
					}
					else
						console.log("addCart error");
			});
		}
		else
			alert("먼저 로그인해주세요.");
	});
});