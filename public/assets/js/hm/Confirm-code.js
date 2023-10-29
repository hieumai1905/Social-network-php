window.onload = function () {
    runTimeCode();
    const btnReSendCode = $("#btn-resend");
    btnReSendCode.click(() => reSendCode());
}

function reSendCode() {
    $("#send-code-register").hide();
    let email = $('#email-confirm').text();
    $.ajax({
        url: "http://localhost:8080/api/refresh-code",
        type: "POST",
        data: JSON.stringify({
            "email-refresh-code": email
        }),
        contentType: "application/json",
        success: (data) => {
            runTimeCode();
        },
        error: (err) => {
            $("#error-confirm-code").text(err);
        }
    });
}


function runTimeCode() {
    let time = 30;
    let interval = setInterval(() => {
        if (time < 0) {
            clearInterval(interval);
            $("#send-code-register").show();
            return;
        }
        time--;
    }, 1000);
}

function checkValidation() {
    let code = $('#code-confirm');
    if (!validateName(code.val())) {
        $('#error-confirm-code').text('Code is not empty');
        code.focus();
        return false;
    }
    if(!validateCode(code.val())){
        $('#error-confirm-code').text('Code is not valid');
        code.val('');
        code.focus();
        return false;
    }
    return true;
}