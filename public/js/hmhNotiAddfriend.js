$(document).ready(function () {
    const postNoti = document.getElementById("addfriend");
    postNoti.addEventListener('click', () => {
        if (postNoti.innerHTML==="Add Friend")
            PostNotificationAddFriend();
    });

});
const userIdadd = localStorage.getItem('userId')
const userTargetIdadd = localStorage.getItem('userTargetId');
console.log(userIdadd);
console.log(userTargetIdadd);
function PostNotificationAddFriend() {
    $.ajax({
        url: 'https://localhost:7131/api/Notification',
        method: 'POST',
        contentType: 'application/json',
        dataType: 'json',
        xhrFields: {
            withCredentials: true
        },
        data: JSON.stringify({
                "notificationId": "string",
                "content": "send friend invitator",
                "notificationsAt": "2023-04-13T08:09:58.762Z",
                "status": "string",
                "userId": userIdadd,
                "userTargetId": userTargetIdadd
        }),
        async: false,
        success: function (response) {
            console.log("post noti success!")
        }
        , error: function () {
            console.log("loi")
        }

    });
}