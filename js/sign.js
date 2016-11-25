var dupFlag = false;

$(document).ready(function(){

	$('input#id').change(function() {
		console.log("make false");
		dupFlag = false;
	});

	$("form#signfrm").bind("submit", function(){
		if(dupFlag == false){
			alert('아이디 중복확인을 해주세요.');
			return false;
		}
		else
			return checkEmpty();
	});

});

function checkEmpty(){
	if($("input#id").val().trim() == ""){
		alert("ID를 입력하세요.");
		$("input#id").focus();
		return false;
	}
	if($("input#password").val().trim() == ""){
		alert("비밀번호를 입력하세요.");
		$("input#password").focus();
		return false;
	}
	if($("input#email").val().trim() == ""){
		alert("이메일을 입력하세요.");
		$("input#email").focus();
		return false;
	}
	if($("input#name").val().trim() == ""){
		alert("이름을 입력하세요.");
		$("input#name").focus();
		return false;
	}
	if($("input#phonenum").val().trim() == ""){
		alert("휴대폰 번호를 입력하세요.");
		$("input#phonenum").focus();
		return false;
	}
	if($("input#zipcode").val().trim() == ""){
		alert("주소를 입력하세요.");
		$("input#zipcode").focus();
		return false;
	}
	return true;
};

function checkDuplicateID(){
	if($("input#id").val().trim() == ""){
		alert("ID를 입력하세요.");
		$("input#id").focus();
		return false;
	}
	$.ajax({
		url:'php/duplicated_ID.php?id='+$('input#id').val(),
		success:function(data){
			if(!data){
				alert('이미 사용중인 아이디입니다.');
				$('#id').val("");
			}
			else{
				console.log("make true");
				alert('사용할 수 있는 아이디입니다.');
				dupFlag = true;
			}
		}
	});
};
