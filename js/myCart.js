$(document).ready(function(){
	id = $.session.get('user_id');
	$.ajax({
			url:'../php/myCart.php?id='+id,
			success:function(data){
				temp = data.split("?");
				if(temp[0] == 0){
					$("#nothing").html("<br><br><br><br><br>카트가 비어있습니다.<br><br><br><br><br><br><br>");
					$("#cart").html('<div class="panel-footer text-center"><div class="row"><div class="col-xs-4 continue-shopping"><button type="button" class="btn btn-default btn-block" onclick="$(location).attr(\'href\',\'initialPage.html\')"><strong>계속 쇼핑하기</strong></button></div>')
				}
				else{
					total = parseInt(temp[1]) + parseInt(temp[0]) * 2500;
					$("#cart").html(temp[2]+'<div class="panel-footer text-center"><div class="row"><div class="col-xs-4 continue-shopping"><button type="button" class="btn btn-default btn-block" onclick="$(location).attr(\'href\',\'initialPage.html\')"><strong>계속 쇼핑하기</strong></button></div><div class="col-xs-5 total"><h4 class="text-center" >총 금액 : <strong>&#8361 '+temp[1]+' + 배송비(<strong>&#8361 </strong>2500 * '+temp[0]+')</strong></h4></div><div class="col-xs-3 payment"><button type="button" class="btn btn-default btn-sm" onclick="$(location).attr(\'href\', \'../htm/payment.html?total='+total+'\')"><span class="glyphicon glyphicon-ok"></span><strong>결제</strong></button></div></div></div>');
				}
			}
	});
});


function delcart(pid){
	var user = $.session.get('user_id');
	$.post("../php/Cart.php?flag=1", {productid:pid, buyer:user},
		function(data){
			if(data == true){
				alert("삭제되었습니다.");
				$(location).attr("href", window.location.href);
			}
			else
				console.log("delCart error");
	});
}