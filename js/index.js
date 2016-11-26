function isLogined(){
	if($.session.get('user_id'))
		return true;
	else
		return false;
}

function logout(){
	$.session.remove('user_id');
	alert('로그아웃되었습니다.');
	$(location).attr('href', 'index.htm');
}

$(document).ready(function(){
	if(!isLogined()){
		$('h1').html('로그인');
		var tmpHTML = '';
		tmpHTML += '<input type="text" class="form-control" id="id" name="id" placeholder="ID" style="width:300px; margin:auto;">';
		tmpHTML += '<input type="password" class="form-control" id="password" name="password" placeholder="PASSWORD" style="width:300px;margin:auto;">';
		tmpHTML += '<button type="submit" class="btn btn-default" name : "srhbtn">로그인</button>';
		tmpHTML += '<button type="button" class="btn btn-default" onclick="location.href=\'sign.htm\'">회원 가입</button>'
		$('#form').html(tmpHTML);
	}
	else{
		$('h1').html(String($.session.get('user_id')));
		$('#container').append('<button type="button" class="btn btn-default" onclick="logout()">로그아웃</button>');
	}
});
