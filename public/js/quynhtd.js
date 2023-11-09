$(document).ready(function () {
    getFriendsOfUser();
});

function getFriendsOfUser() {
    let strFriends = "";
    $.ajax({
        url: "http://localhost:8080/api/message/friendlist",
        method: "GET",
        contentType: "application/json",
        dataType: "json",
        error: function (response) {
            console.log(response);
        },
        success: function (data) {
            console.log(data);
            $.each(data.data, function (key, value) {
                // value.price = value.price;
                strFriends += `<li>
                                            <form action="/message" method="GET">
                                                <div type="submit" class="row">
                                                    <button type="submit" class="" style="border:none; display:flex; background: none; padding:10px 0;">
                                                        <div class="col-lg-3">
                                                            <img src="/public/images/${value.avatar}" alt="image" style="width:50px; height: 50px;">
                                                        </div>
                                                        <div class="col-lg-9"><p>${value.fullName}</p></div>
                                                    </button>
                                                </div>

                                                <input hidden type="text" name="userId" value="${value.userId}"/>
                                                <input hidden type="text" name="name" value="${value.fullName}"/>
                                            </form>
                                        </li>`;
            });
            $("#friendChat").html(strFriends);
        },
    });
}
