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

$(document).ready(function(){
    var paramsMap = getParamsMap();
    orderid = paramsMap['orderid']; 
    $("input#orderid").val(orderid);
    $("form#erfrm").bind("submit", function() {
        return checkEmpty();
    });

    $.ajax({
            url:'../php/setSeller.php?orderid='+orderid,
            success:function(data){
                temp = data.split("?");
                $("#sellerName").val(temp[0]);
                $("#sellerAddress").val(temp[1]);
                $("#sellerPhone").val(temp[2]);
            }
    });
});


function checkEmpty() {
    if ($.trim($("input#trackingnum").val()) == "") {
        alert("송장번호를 입력하세요.");
        $("input#trackingnum").focus();
        return false;
    }
    return true;
};
