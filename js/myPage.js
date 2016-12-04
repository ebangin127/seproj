$(document).ready(function(){
	id = $.session.get('user_id');
	$.ajax({
			url:'../php/myPage.php?id='+id,
			success:function(data){
				temp = data.split("?");
				$("#name").html(temp[0]);
				$("#id").html(temp[1]);
				$("#address").html(temp[2]);
				$("#phonenum").html(temp[3]);
				$("#email").html(temp[4]);
			}
	});
});
