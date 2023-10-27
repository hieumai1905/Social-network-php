$(document).ready(function () {
    GetCountNotification();
    const noti = document.getElementById("ringNotification");
    noti.addEventListener('click', () => { UpdateNotification(); });

});
const userTargetId = localStorage.getItem('userId');
let notiCreate = '';
let CountNotification = '';
function GetCountNotification() {

    var getUrl = '';
    getUrl += `https://localhost:7131/api/Notification/userTarget/${userTargetId}`;
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
            notiCreate = reponse[0].notificationId;
            const notiCount1 = reponse.length;
            $.ajax({
                url: 'https://localhost:7131/api/Notification/count/' + userTargetId,
                method: 'GET',
                contentType: 'json',
                dataType: 'json',
                xhrFields: {
                    withCredentials: true
                },
                async: false,
                success: function (count) {
                    console.log(count);
                    if (count > 0) {
                        document.getElementById('showNotification').innerHTML = count;
                    }
                    else {
                        document.getElementById('showNotification').innerHTML = '';
                    }
                }
            });
        }
    });
}
function UpdateNotification() {
    var getUrl = '';
    getUrl += `https://localhost:7131/api/Notification/userTarget/${userTargetId}`;
    $.ajax({
        url: getUrl,
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        async: false,
        xhrFields: {
            withCredentials: true
        },
        error: function () {
            alert("sai roi");
        },
        success: function (response) {
            for (let i = 0; i < response.length; ++i) {
                if (response[i].status == "NEW") {
                    $.ajax({
                        url: 'https://localhost:7131/api/Notification/' + response[i].userTargetId,
                        method: 'PUT',
                        contentType: 'application/json',
                        dataType: 'json',
                        xhrFields: {
                            withCredentials: true
                        },
                        data: (`
                            {   "notificationId": "${response[i].notificationId}",
                                "content": "${response[i].content}",
                                "notificationsAt": "${response[i].notificationsAt}",
                                "status": "UNSEEN",
                                "userId": "${response[i].userId}",
                                "userTargetId": "${response[i].userTargetId}"}`
                        ),
                        async: false,
                        success: function (response) {
                            console.log("update noti success!")
                        }
                        , error: function () {
                        }

                    });
                    }

            }
        }
    });
    GetCountNotification();
}