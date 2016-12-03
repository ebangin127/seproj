$(document).ready(function(){
	$("form#form-signin").bind("submit", function(){
		return checkEmpty();
	});
});

function checkEmpty(){
	if($.trim($("input#id").val()) == ""){
		alert("ID를 입력하세요.");
		$("input#id").focus();
		return false;
	}
	if($.trim($("input#password").val()) == ""){
		alert("비밀번호를 입력하세요.");
		$("input#password").focus();
		return false;
	}
	return true;
}