window.onload = function () {
    GetFriendRequest();
}
function GetUser(id) {
    let data;
    $.ajax({
        url: 'http://localhost:8080/api/users/' + id,
        method: 'GET',
        contentType: 'json',
        async: false,
        error: function (response) {
        },
        success: function (response) {
            data = response.data;
        }
    });
    return data;
}
function GetFriendRequest() {
    $.ajax({
        url: 'http://localhost:8080/api/relation/friendrequest',
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        async: false,
        error: function (response) {
        },
        success: function (response) {
            console.log(response);
            const len = response.data.length;
            console.log(len);
            let table = '';
            for (var i = 0; i < len; ++i) {
                var user = GetUser(response.data[i].userTargetId);
                var avatar = '/public/images/' + user.avatar;
                var urlProfile = 'http://localhost:8080/users/' + user.userId;
                console.log(user);
                table += `<div
                    class="card-body d-flex pt-4 ps-4 pe-4 pb-0 border-top-xs bor-0">
                    <figure class="avatar me-3">
                        <img
                            src="${avatar}"
                            alt="image"
                            class="shadow-sm rounded-circle w45"/>
                    </figure>
                    <a href="${urlProfile}"><h4 style="cursor:pointer" name="${user.userId}" class="namefriendrequest fw-700 text-grey-900 font-xssss mt-1">
                                        ${user.fullName}
                        <span
                            class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">
                            ${user.email}
                        </span
                        >
                    </h4></a>
                </div>
                <div
                    class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4">
                    <a
                        onclick="AcceptFriendRequest(${user.userId});"
                        style="cursor:pointer"
                        class="p-2 lh-20 w100 bg-primary-gradiant me-2 text-white text-center font-xssss fw-600 ls-1 rounded-xl">
                        Accept
                    </a
                    >
                    <a
                        onclick="RejectFriendRequest(${user.userId});"
                        style="cursor:pointer"
                        class="p-2 lh-20 w100 bg-grey text-grey-800 text-center font-xssss fw-600 ls-1 rounded-xl">
                        Reject
                    </a>
                </div>`;
            }
            $('#friendrequest').html(table);
        },
        fail: function (response) {
        }
    });
}
function AcceptFriendRequest(id) {
    $.ajax({
        url: 'http://localhost:8080/api/relation/acceptfriendrequest/' + id,
        method: 'PUT',
        contentType: 'json',
        error: function (reponse) {
        },
        success: function (reponse) {
            GetFriendRequest();
            console.log(1);
        }
    });
}
function RejectFriendRequest(id) {
    $.ajax({
        url: 'http://localhost:8080/api/relation/rejectfriendrequest/' + id,
        method: 'DELETE',
        contentType: 'json',
        error: function (reponse) {
        },
        success: function (reponse) {
            GetFriendRequest();
            console.log(1);
        }
    });
}