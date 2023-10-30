// const userId = localStorage.getItem('userId');
// if (userId === null) {
//     window.location.href = 'https://localhost:7261/404';
//     console.log(userId)
// } else {
//     const userRole = localStorage.getItem('userRole');
//     if (userRole !== "ADMIN_ROLE") {
//         window.location.href = 'https://localhost:7261/403';
//     }
// }
window.onload = function () {
    loadUsers();
    // var viewdetailuser = document.getElementsByClassName('viewdetail');
    // for (let i = 0; i < viewdetailuser.length; i++) {
    //     viewdetailuser[i].addEventListener("click", function () {
    //         localStorage.setItem("userTargetId", viewdetailuser[i].getAttribute('name'));
    //     });
    // }
    // var lockorunlock = document.getElementsByClassName('lockorunlock');
    // for (let i = 0; i < lockorunlock.length; i++) {
    //     lockorunlock[i].addEventListener("click", function () {
    //         if (lockorunlock[i].innerHTML === "Lock") {
    //             LockUser(lockorunlock[i].getAttribute('name'));
    //             loadUsers();
    //         }
    //         else {
    //             UnLockUser(lockorunlock[i].getAttribute('name'));
    //             loadUsers();
    //         }
    //     });
    // }
}

function loadUsers() {
    $.ajax({
        url: 'http://localhost:8080/admin/users-all',
        type: 'GET',
        contentType: "application/json",
        success: function (data) {
            let html = '';
            let str = '';
            for (let i = 0; i < data.length; i++) {
                if (data[i].userId === localStorage.getItem("userId"))
                    continue;
                if (data[i].userInfo.status === "ACTIVE") {
                    html += `<tr className="odd">
                        <td className="dtr-control sorting_1" tabIndex="0">${data[i].userId}</td>
                        <td>${data[i].fullName}</td>
                        <td>${data[i].userInfo.email}</td>
                        <td>${data[i].userInfo.status}</td>
                        <td style="text-align: center;">

                            <a style="cursor:pointer" class="lockorunlock" name="${data[i].userId}">Lock</a> |
                            <a class="viewdetail" href="https://localhost:7261/profile" name="${data[i].userId}">View Detail</a>
                        </td>
                    </tr>`
                } else {
                    html += `<tr className="even">
                        <td className="dtr-control sorting_1" tabIndex="0">${data[i].userId}</td>
                        <td>${data[i].fullName}</td>
                        <td>${data[i].userInfo.email}</td>
                        <td>${data[i].userInfo.status}</td>
                        <td style="text-align: center;">

                            <a style="cursor:pointer;color:red" class="lockorunlock" name="${data[i].userId}">UnLock</a> |
                            <a class="viewdetail" href="https://localhost:7261/profile" name="${data[i].userId}">View Detail</a>
                        </td>
                    </tr>`
                }
                $("#show-user-body").html(html);
            }

        }, error: function (error) {
            if (error.status === 401) {
                window.location.href = 'https://localhost:7261/login';
                return;
            } else if (error.status === 403) {
                window.location.href = 'https://localhost:7261/403';
            }
            window.location.href = 'https://localhost:7261/404';
        }
    });
}
function LockUser(id) {
    $.ajax({
        url: 'https://localhost:7131/v1/api/admin/lock/'+id,
        method: 'PUT',
        contentType: 'json',
        error: function (reponse) {
        },
        success: function (reponse) {
            console.log(reponse);
        }
    });
}