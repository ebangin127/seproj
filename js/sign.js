var dupFlag = false;

$(document).ready(function() {
    $('input#id').change(function() {
        console.log("make false");
        dupFlag = false;
    });

    $("form#signfrm").bind("submit", function() {
        if (dupFlag == false) {
            alert('아이디 중복확인을 해주세요.');
            return false;
        } else
            return checkEmpty();
    });
});

function checkEmpty() {
    if ($.trim($("input#id").val()) == "") {
        alert("ID를 입력하세요.");
        $("input#id").focus();
        return false;
    }
    if ($.trim($("input#password").val()) == "") {
        alert("비밀번호를 입력하세요.");
        $("input#password").focus();
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
    if ($.trim($("input#name").val()) == "") {
        alert("이름을 입력하세요.");
        $("input#name").focus();
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
    
    
    
    return true;
};

function checkDuplicateID() {
    if ($.trim($("input#id").val()) == "") {
        alert("ID를 입력하세요.");
        $("input#id").focus();
        return false;
    }
    $.ajax({
        url: '../php/duplicated_ID.php?id=' + $('input#id').val(),
        success: function(data) {
            if (!data) {
                alert('이미 사용중인 아이디입니다.');
                $('#id').val("");
            } else {
                console.log("make true");
                alert('사용할 수 있는 아이디입니다.');
                dupFlag = true;
            }
        }
    });
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