$(document).ready(function() {
    var paramsMap = getParamsMap();
    total = paramsMap['total'];
    $("#total").html(total);
    id = $.session.get('user_id');
    if(paramsMap['pid']){
        $("input#directOrder").val(paramsMap['pid']);
        $("input#qty").val(paramsMap['qty']);
        console.log($("input#directOrder").val());
        console.log($("input#qty").val());
    }
    else{
        $("input#orderDirect").val(0);
        $("input#qty").val(0);
    }
    $("input#buyer").val(id);
    $("form#orderfrm").bind("submit", function() {
        return checkEmpty();
    });
    
});

function checkEmpty() {
    if ($.trim($("input#id").val()) == "") {
        alert("이름을 입력하세요.");
        $("input#id").focus();
        return false;
    }
    if ($.trim($("input#zipcode").val()) == "") {
        alert("주소를 입력하세요.");
        $("input#zipcode").focus();
        return false;
    }
    if ($.trim($("input#address2").val()) == "") {
        alert("상세 주소를 입력하세요.");
        $("input#address2").focus();
        return false;
    }
    if ($.trim($("input#phonenum").val()) == "") {
        alert("휴대폰 번호를 입력하세요.");
        $("input#phonenum").focus();
        return false;
    }
    if ($.trim($("input#email").val()) == "") {
        alert("이메일을 입력하세요.");
        $("input#email").focus();
        return false;
    }
    if ($.trim($("#card").val()) == "00") {
        alert("카드를 골라주세요.");
        $("#card").focus();
        return false;
    }
    if ($.trim($("#cardnum").val()) == "") {
        alert("카드 번호를 골라주세요.");
        $("#cardnum").focus();
        return false;
    }
    if ($.trim($("#expiry-month").val()) == "00") {
        alert("유효기간을 골라주세요.");
        $("#expiry-month").focus();
        return false;
    }
    if ($.trim($("#expiry-year").val()) == "00") {
        alert("유효기간을 골라주세요.");
        $("#expiry-year").focus();
        return false;
    }
    if ($.trim($("#CVC").val()) == "") {
        alert("CVC를 입력해주세요.");
        $("#CVC").focus();
        return false;
    }
    return true;
};

function getParamsMap() {
    var temp = window.location.href.split("?");
    if(!temp[1])
        return false;
    var params = temp[1].split("&");
    var paramsMap = {};
    params.forEach(function (p) {
        var v = p.split("=");
        paramsMap[v[0]]=decodeURIComponent(v[1]);
    });
    return paramsMap;
};

function findAddress() {
    new daum.Postcode({
        oncomplete: function(data) {
            var fullAddr = '';
            var extraAddr = '';

            if (data.userSelectedType === 'R') {
                fullAddr = data.roadAddress;

            } else {
                fullAddr = data.jibunAddress;
            }

            if (data.userSelectedType === 'R') {
                if (data.bname !== '') {
                    extraAddr += data.bname;
                }
                if (data.buildingName !== '') {
                    extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                fullAddr += (extraAddr !== '' ? ' (' + extraAddr + ')' : '');
            }

            document.getElementById('sample6_postcode').value = data.zonecode;
            document.getElementById('address').value = fullAddr;

            document.getElementById('address2').focus();
        }
    }).open();
}