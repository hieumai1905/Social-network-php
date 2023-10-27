$(document).ready(function () {
    getUserName();
    let btnSave = $("#btnSave");
    btnSave.click(function () {
        console.log(document.getElementById('uDob').value);
        if (document.getElementById('uDob').value == '') {
            document.getElementById('error').innerHTML = 'Invalid';
        }
        else {
            UpdateUserInfor();
            
        }
    });
});
let createAt = '';
let dob = '';
const userId = localStorage.getItem('userId');
function getUserName() {
    var format = '';
    var str = '';
    var getUrl = '';
    getUrl += `https://localhost:7131/v1/api/users/${userId}/profile`;
    $.ajax({
        url: getUrl,
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        async: false,
        xhrFields: {
            withCredentials: true
        },
        error: function (reponse) {
        },
        success: function (reponse) {
            str += `<img style="height:100px; border-radius: 50px" src="${reponse.avatar}" alt="image" class="shadow-sm w-100">`;
            var arrTime = reponse.userInfo.registerAt.split(/[-T:.Z]/);
            for (let i = 0; i < arrTime.length - 3; i++) {
                createAt += arrTime[i] + "-";
            }
            createAt = createAt.slice(0, -1);
            document.getElementById("uRegisterAt").innerHTML = createAt;
            if (reponse.userInfo.dob != null) {
                var arr = reponse.userInfo.dob.split(/[-T:.Z]/); 
                for (let i = 0; i < arr.length - 3; i++) {
                    dob += arr[i] + "-";
                }
                dob = dob.slice(0, -1);
                document.getElementById("uDob").value = dob;
            } 
            
            document.getElementById("uImg").innerHTML = str;
            document.getElementById("uFullName").value = reponse.fullName;
            document.getElementById("uName").innerHTML = reponse.fullName;
            document.getElementById("uEmail").value = reponse.userInfo.email;
            document.getElementById("uPhone").value = reponse.userInfo.phone;
            document.getElementById('uGender').value = reponse.userInfo.gender;
            document.getElementById("uAddress").value = reponse.userInfo.address;
            document.getElementById("uAboutMe").value = reponse.userInfo.aboutMe;
            document.getElementById("uAvatar").value = reponse.avatar;
            document.getElementById("uUserInfoId").value = reponse.userInfo.userInfoId;
            document.getElementById("uPassword").value = reponse.userInfo.password;
            document.getElementById("uStatus").value = reponse.userInfo.status;
            document.getElementById("uUserRole").value = reponse.userInfo.userRole;
            document.getElementById("uCoverImage").value = reponse.userInfo.coverImage;
        }
    });
}


function UpdateUserInfor() {
    var getUrl = '';
    getUrl = 'https://localhost:7131/v1/api/users/' + userId;
    console.log(userId);
    $.ajax({
        url: getUrl,
        method: 'PUT',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        xhrFields: {
            withCredentials: true
        },
        data: JSON.stringify({
            "fullName": document.getElementById('uFullName').value,
            "avatar": document.getElementById('uAvatar').value,
            "userId": userId,
            "userInfoId": document.getElementById('uUserInfoId').value,
            "userInfo": {
                "userInfoId": document.getElementById('uUserInfoId').value,
                "password": document.getElementById('uPassword').value,
                "email": document.getElementById('uEmail').value,
                "dob": document.getElementById('uDob').value,
                "address": document.getElementById('uAddress').value,
                "gender": document.getElementById('uGender').value,
                "phone": document.getElementById('uPhone').value,
                "status": document.getElementById('uStatus').value,
                "userRole": document.getElementById('uUserRole').value,
                "aboutMe": document.getElementById('uAboutMe').value,
                "coverImage": document.getElementById('uCoverImage').value,
                "registerAt": createAt
            }
        }),
        error: function () {
            alert('fail');
        },
        success: function () {
            alert('Update Infor Success!');
            getUserName();
        }
    });

}
