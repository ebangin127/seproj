$(document).ready(function(){
	if(isLogined()){
		var tmpHTML = '';
		tmpHTML += '<li><a class="navbar-brand">'+$.session.get('user_id')+'</a></li>';
		tmpHTML += '<li><a href="#">My Page</a></li><li><a href="#">My Cart</a></li><li><a href="javascript:void(0)" onclick="logout()">로그아웃</a></li>';
		$("#Logined").html(tmpHTML);
	}
	else{
		var tmpHTML = '<li id="login_or_logout"><a href="../htm/login.html">로그인</a></li><li id="login_or_logout"><a href="../htm/signup.html">회원 가입</a></li>';
		tmpHTML += ''
		$("#Logined").html(tmpHTML);
	}
});

function isLogined(){
	if($.session.get('user_id'))
		return true;
	else
		return false;
}
