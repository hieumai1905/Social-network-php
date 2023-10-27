$(document).ready(function () {

    GetAllNotification(userTargetIdNoti);
});
const userTargetIdNoti = localStorage.getItem('userId');
let notiJustCreate = '';
let CountNoti = '';
let status = '';
let notiJustUpdate = '';
function GetAllNotification(userTargetIdNoti) {

    var getUrl = '';
    getUrl += `https://localhost:7131/api/Notification/userTarget/${userTargetIdNoti}`;
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
            notiJustCreate = reponse[0].notificationId;
            const notiCount = reponse.length;
            let notification = '';
            let username = '';
            let avatar = '';

            for (let i = 0; i < notiCount; ++i) {
                $.ajax({
                    url: 'https://localhost:7131/v1/api/Users/' + reponse[i].userId,
                    method: 'GET',
                    contentType: 'json',
                    dataType: 'json',
                    xhrFields: {
                        withCredentials: true
                    },
                    async: false,
                    success: function (user) {
                        username = user.fullName;
                        avatar = user.avatar;
                    }
                });
                if (reponse[i].status == "NEW" || reponse[i].status == "UNSEEN") {
                    notification += `<li onclick="changePage('${reponse[i].userId}')">
                                        <a href="#" class="d-flex align-items-center p-3 rounded-3 bg-lightblue theme-light-bg">
                                            <img src="${avatar}" alt="user" class="w45 me-3">
                                            <i class="feather-heart text-white bg-red-gradiant me-2 font-xssss notification-react"></i>
                                            <h6 class="font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20"><strong>${username}</strong>${reponse[i].content}
                                    <strong>UI/UX Community</strong> : “Mobile Apps UI Designer is required for Tech…” <span class="d-block text-grey-500 font-xssss fw-600 mb-0 mt-0 0l-auto">
                                    ${reponse[i].notificationAt}</span> </h6>
                                            <i class="ti-more-alt text-grey-500 font-xs ms-auto"></i>
                                        </a>
                                    </li>`;
                    document.getElementById('NotificationList').innerHTML = notification;
                }
                else {
                    notification += `<li onclick="changePage('${reponse[i].userId}')">
                                        <a href="#" class="d-flex align-items-center p-3 rounded-3">
                                            <img src="${avatar}" alt="user" class="w45 me-3">
                                            <i class="feather-heart text-white bg-red-gradiant me-2 font-xssss notification-react"></i>
                                            <h6 class="font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20"><strong>${username}</strong>${reponse[i].content}
                                    <strong>UI/UX Community</strong> : “Mobile Apps UI Designer is required for Tech…” <span class="d-block text-grey-500 font-xssss fw-600 mb-0 mt-0 0l-auto">
                                    ${reponse[i].notificationAt}</span> </h6>
                                            <i class="ti-more-alt text-grey-500 font-xs ms-auto"></i>
                                        </a>
                                    </li>`;
                    document.getElementById('NotificationList').innerHTML = notification;
                }


            }
        }
    });
}
function changePage(url) {
    var getUrl = '';
    getUrl += `https://localhost:7131/api/Notification/userTarget/${userTargetIdNoti}`;
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
            for (let i = 0; i < reponse.length; ++i) {
                if (reponse[i].content == "send friend invitator") {
                    localStorage.setItem('userTargetId', url);
                    window.location.href = 'https://localhost:7261/profile';
                }
                if (reponse[i].content == "friend post new status") {
                    localStorage.setItem('userTargetId', url);
                    window.location.href = 'https://localhost:7261/post';
                }
            }
            
        }
    
    });
}
