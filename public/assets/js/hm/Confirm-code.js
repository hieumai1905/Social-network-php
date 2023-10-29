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
        console.log(time);
        time--;
    }, 1000);
}

function checkValidation() {
    let code = $('#code-confirm');
    let error = $("#register-error");
    $("#error-confirm-code").remove();
    if (!validateName(code.val())) {
        error.text('Code is not empty');
        code.focus();
        return false;
    }
    if(!validateCode(code.val())){
        error.text('Code is not valid');
        code.val('');
        code.focus();
        return false;
    }
    return true;
}