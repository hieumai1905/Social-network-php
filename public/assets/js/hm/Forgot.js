window.onload = function () {
    const btnSendCode = $("#btn-reset-password");
    btnSendCode.click(() => sendCode());
    let error = $("#error2-reset-password");
    if(error.text() !== ''){
        $(".remove-first").remove();
    }
}

function showConfirmCode() {
    $("#code-reset-password").show();
    $("#email-reset-password").hide();
    $("#btn-reset-password").hide();
    $("#btn-confirm").show();
}

function sendCode() {
    let email = $("#email-reset-password");
    let error = $("#error-reset-password");
    if (!validateName(email.val())) {
        error.text('Email is not empty');
        email.focus();
    } else if (!validateEmail(email.val())) {
        error.text('Email is not valid');
        email.val('');
        email.focus();
    } else {
        $.ajax({
            url: "http://localhost:8080/api/account/forgot",
            type: "POST",
            data: JSON.stringify({
                "email-reset": email.val()
            }),
            contentType: "application/json",
            success: (response) => {
                if (response.status === 200) {
                    showConfirmCode();
                } else {
                    error.text(response.message);
                }
            },
            error: (err) => {
                if (err.status === 404) {
                    error.text('Email is not exist');
                    email.val('');
                    email.focus();
                } else if (err.status === 403) {
                    error.text('Account locked');
                } else {
                    window.location.href = "/error";
                }
            }
        });
    }
}

function checkValidationForgot() {
    let code = $('#code-reset-password');
    let error = $("#error-reset-password");
    $("#error2-reset-password").remove();
    if (!validateName(code.val())) {
        error.show();
        error.text('Code is not empty');
        code.focus();
        return false;
    }
    if (!validateCode(code.val())) {
        error.text('Code is not valid');
        error.show();
        code.val('');
        code.focus();
        return false;
    }
    return true;
}