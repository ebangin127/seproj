function showSellerOnlyForms(){
	var els = document.getElementsByClassName("seller-only");
	[].forEach.call(els, function (e) {
		e.style.display = 'block';
	});
}
function hideSellerOnlyForms(){
	var els = document.getElementsByClassName("seller-only");
	[].forEach.call(els, function (e) {
		e.style.display = 'none';
	});
}
function validateOne($formid, $formhumanname) {
  var value = document.forms["register"][$formid].value;
  if (value == "") {
      alert("검증 오류: 빈 " + $formhumanname);
      return false;
  }
  return true;
}
function validateBasicForm() {
  return (validateOne("id", "아이디") &&
    validateOne("pw", "비밀번호") &&
    validateOne("pw_confirm", "비밀번호 확인") &&
    validateOne("email", "이메일 주소") &&
    validateOne("email_confirm", "이메일 주소 확인") &&
    validateOne("name", "이름") &&
    validateOne("phonenum", "전화번호") &&
    validateOne("zipcode", "우편번호") &&
    validateOne("address1", "주소 (앞)") &&
    validateOne("address2", "주소 (뒤)"));
}
function IsSeller() {
  var SELLER = "0";
  return document.forms["register"]["accounttype"].value == SELLER;
}
function validateSellerForm() {
  return (!IsSeller()) ||
    (validateOne("businessnum", "사업자등록번호") &&
     validateOne("bankcode", "금융결제원 은행코드") &&
     validateOne("accountnum", "계좌번호"));
}
function validateConfirmOne($lhsformid, $rhsformid, $formhumanname) {
  var lhsvalue = document.forms["register"][$lhsformid].value;
  var rhsvalue = document.forms["register"][$rhsformid].value;
  if (lhsvalue != rhsvalue) {
      alert("검증 오류: " + $formhumanname + " 불일치");
      return false;
  }
  return true;
}
function validateConfirmPassword() {
  return validateConfirmOne("pw", "pw_confirm", "비밀번호");
}
function validateConfirmEmail() {
  return validateConfirmOne("email", "email_confirm", "이메일 주소");
}
function validateConfirm() {
  return (validateConfirmPassword() &&
    validateConfirmEmail());
};
function validateForm() {
  return (validateBasicForm() &&
    validateSellerForm() &&
    validateConfirm());
}
function hashPassword() {
  var passwd = document.forms["register"]["pw"].value;
  passwd = CryptoJS.SHA1(passwd);
  document.forms["register"]["pw"].value = passwd;
}
function OnSubmitEvent() {
  var validationResult = validateForm();
  if(!validationResult)
    return false;

  hashPassword();
  return true;
}