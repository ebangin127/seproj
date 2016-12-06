$(document).ready(function(){
	id = $.session.get('user_id');
	$.ajax({
		url:'../php/myPage.php?id='+id,
		success:function(data){
			temp = data.split("?");
			$("#name").append(temp[0]);
			$("#id").append(temp[1]);
			$("#address").append(temp[2]);
			$("#phonenum").append(temp[3]);
			$("#email").append(temp[4]);
		}
	});
	$.ajax({
		url:'../php/myOrder.php?id='+id,
		success:function(data){
			if(data == 0){
				$("#tbody").html('<tr><td colspan="5">주문 내역이 없습니다.</td></tr>');
			}
			else
				$("#tbody").html(data);
		}
	})
});

function er($orderid){
	$(location).attr("href","../htm/exchangeRefund.html?orderid="+$orderid);
}
