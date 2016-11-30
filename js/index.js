function isLogined(){
	if($.session.get('user_id'))
		return true;
	else
		return false;
}

function logout(){
	$.session.remove('user_id');
	alert('로그아웃되었습니다.');
	$(location).attr('href', 'index.html');
}

$(document).ready(function(){
	if(!isLogined()){
		var tmpHTML = '';
		tmpHTML += '<input type="text" id="id" name="id" class="form-control" placeholder="ID">';
		tmpHTML += '<input type="password" id="password" name="password" class="form-control" placeholder="Password">'
		tmpHTML += '<button class="btn btn-lg btn-primary btn-block" type="submit">로그인</button>'
		tmpHTML += '<button type="button" class="btn btn-lg btn-primary btn-block" onclick="location.href=\'../htm/signup.htm\'">회원가입</button>'
		$('#div-signin').html(tmpHTML);
	}
	else{
		$('#div-signin').append("<br><br>"+String($.session.get('user_id')));
		$('#div-signin').append('<button type="button" class="btn btn-lg btn-primary btn-bloc" onclick="logout()">로그아웃</button>');
	}
});
