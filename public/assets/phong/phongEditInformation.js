function EditProfile() {
    $.ajax({
        url: 'http://localhost:8080/api/updateuser',
        method: 'PUT',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify({
            "full_name": document.getElementById('uFullName').value,
            "dob": document.getElementById('uDob').value,
            "address": document.getElementById('uAddress').value,
            "gender": document.getElementById('uGender').value,
            "about_me": document.getElementById('uAboutMe').value,
            "phone" : document.getElementById('uPhone').value
        }),
        error: function (reponse) {
            console.log('error');
        },
        success: function (reponse) {
            alert('Update Infor Success!');
            document.location.reload();
        }
    });
}
function validateFullName() {
    var fullName = document.getElementById('uFullName').value;
    var fullNameError = document.getElementById('fullNameError');

    if (fullName.trim() === '') {
        fullNameError.textContent = 'Full name cannot be empty';
        fullNameError.style.display = 'block';
        return false;
    }

    fullNameError.style.display = 'none';
    return true;
}

function validatePhoneNumber() {
    var phoneInput = document.getElementById('uPhone');
    var phoneValue = phoneInput.value.trim();
    var phoneError = document.getElementById('phoneError');

    if (phoneValue === '') {
        return true;
    } else {
        if (phoneValue.length !== 10 || phoneValue.charAt(0) !== '0') {
            phoneError.textContent = 'Invalid phone number. Please enter a valid phone number starting with 0 or enough 10 numbers.';
            phoneError.style.display = 'block';
            return false;
        }
    }

    phoneError.style.display = 'none';
    return true;
}

document.getElementById('btnSave').addEventListener('click', function () {
    var isFullNameValid = validateFullName();
    var isPhoneNumberValid = validatePhoneNumber();

    if (!isFullNameValid || !isPhoneNumberValid) {
        return;
    }

    EditProfile();
});