$(document).ready(function() {
    id = $.session.get('user_id');
    console.log(id);
    $("input#buyer").val(id);
    $("form#orderfrm").bind("submit", function() {
        return checkEmpty();
    });
    var paramsMap = getParamsMap();
    total = paramsMap['total'];
    $("#total").html(total);
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