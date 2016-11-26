$(document).ready(function(){
	$.ajax({
		url:'../php/productList.php',
		success:function(data){
			$("#tbody").html(data);
		}
	});
});
