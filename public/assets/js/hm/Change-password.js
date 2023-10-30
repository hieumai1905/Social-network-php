function checkValidation(){
    $("#notification1").remove();
    let oldPassword = $("#old-password");
    let newPassword = $("#new-password");
    let confirmPassword = $("#confirm-password");

    if(!validateName(oldPassword.val())){
        showError('Old password is required');
        oldPassword.focus();
        return false;
    }
    if(!validatePassword(oldPassword.val())){
        showError('Old password must be at least 6 characters!');
        oldPassword.focus();
        return false;
    }

    if(!validatePassword(newPassword.val())){
        showError('New password must be at least 6 characters!');
        newPassword.focus();
        return false;
    }

    if(!validateName(newPassword.val())){
        showError('New password is required');
        newPassword.focus();
        return false;
    }

    if(!validateName(confirmPassword.val())){
        showError('Confirm password is required');
        confirmPassword.focus();
        return false;
    }

    if (!validatePassword(confirmPassword.val())) {
        showError('Confirm password must be at least 6 characters!');
        confirmPassword.focus();
        return false;
    }

    if(newPassword.val() !== confirmPassword.val()){
        showError('Confirm password is not match');
        newPassword.focus();
        newPassword.val('');
        confirmPassword.val('');
        return false;
    }
    return true;
}

function showError(err) {
    $("#notification").text(err);
    $("#notification").show();
}