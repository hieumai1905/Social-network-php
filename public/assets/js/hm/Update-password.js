function checkValidation() {
    let password = $("#new-password-reset");
    let confirmPassword = $("#confirm-password-reset");
    let error = $("#error-reset-password");
    if (!validateName(password.val())) {
        password.focus();
        error.text('Password is not empty');
        return false;
    }
    if (!validateName(confirmPassword.val())) {
        confirmPassword.focus();
        error.text('Confirm password is not empty');
        return false;
    }

    if (!validatePassword(password.val())) {
        password.val('');
        password.focus();
        error.text('Password must be at least 6 characters long.');
        return false;
    }
    if (!validatePassword(password.val())) {
        confirmPassword.val('');
        password.focus();
        error.text('Password must be at least 6 characters long.');
        return false;
    }

    if (password.val() !== confirmPassword.val()) {
        password.val('');
        confirmPassword.val('');
        password.focus();
        error.text('Confirm password is not match');
        return false;
    }
    return true;
}