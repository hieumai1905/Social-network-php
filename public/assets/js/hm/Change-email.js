window.onload = function () {
    const btnGetCodeChangeEmail = document.getElementById('btn-get-code-change-email');
    btnGetCodeChangeEmail.addEventListener('click', getCodeChangeEmail);
    let error = $("#notification2-change-email");
    if(error.text() !== ''){
        $("#dis-none").remove();
    }
};

function getCodeChangeEmail() {
    console.log('----change-email-----')
    const emailReset = $("#email-new-change");
    let email = emailReset.val();
    if (email === '') {
        showError('Email is required');
        emailReset.val('');
        emailReset.focus();
        return;
    }
    if (!validateEmail(email)) {
        showError('Email is not valid');
        emailReset.val('');
        emailReset.focus();
        return;
    }
    $.ajax({
        url: "http://localhost:8080/api/change-email/code",
        type: "POST",
        data: JSON.stringify({
            "new-email": email
        }),
        success: function (data) {
            $(".remove-after").remove();
            $("#notification2-change-email").remove();
            $(".show-after").show();
            $("#code-change-email").focus()
        },
        error: function (err) {
            if(err.status === 400) {
                showError('Email is exist');
                emailReset.val('');
                emailReset.focus();
            }
        }
    });

    console.log('----change-email-----')
}

function checkValidationChangeEmail() {
    let code = $("#code-change-email");
    if(!validateName(code.val())){
        showError('Code is required');
        code.focus();
        return false;
    }
    if(!validateCode(code.val())){
        showError('Code must be 6 digits and not contain special characters');
        code.focus();
        return false;
    }
    $("#notification2-change-email").remove;
    return true;
}

function showError(err) {
    $("#notification-change-email").text(err);
    $("#notification-change-email").show();
}