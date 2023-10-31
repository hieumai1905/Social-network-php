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
            "about_me": document.getElementById('uAboutMe').value
        }),
        error: function (reponse) {
        },
        success: function (reponse) {
            alert('Update Infor Success!');
            document.location.reload();
        }
    });
}
document.getElementById('btnSave').addEventListener('click',function () {
    EditProfile();
})