$(document).ready(function () {
    CheckFollow();
    CheckFriend();
    CheckBlock();
    CheckRequest();
    CheckWaiting();
});
var currentUrl = window.location.href;
var urlParts = currentUrl.split('/');
var userId = urlParts[urlParts.length - 1];
function SendFriendRequest(id) {
    $.ajax({
        url: "http://localhost:8080/api/relation/sendfriendrequest/"+id,
        method: "POST",
        contentType: "json",
        error: function (response) {

        },
        success: function (response) {
            console.log(response)
            $('#addfriend').html("Waiting");
            document.getElementById('addfriend').style.backgroundColor = "yellow";
            $('#follow').html("UnFollow");
        }
    })
}
function AcceptFriendRequest(id) {
    $.ajax({
        url: 'http://localhost:8080/api/relation/acceptfriendrequest/' + id,
        method: 'PUT',
        contentType: 'json',
        error: function (reponse) {
        },
        success: function (reponse) {
            $('#addfriend').html("Unfriend");
            document.getElementById('addfriend').style.backgroundColor = "green";
            $('#follow').html("UnFollow");
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
            $('#addfriend').html("Add Friend");
            document.getElementById('addfriend').style.backgroundColor = "green";
            $('#follow').html("Follow");
        }
    });
}
function Unfriend(id) {
    $.ajax({
        url: "http://localhost:8080/api/relation/unfriend/" + id,
        method: "DELETE",
        contentType: "json",
        error: function (response) {

        },
        success: function (response) {
            console.log(response)
            $('#addfriend').html("Add Friend");
            $('#follow').html("Follow");
        }
    })
}
function CancelFriendRequest(id) {
    $.ajax({
        url: "http://localhost:8080/api/relation/cancelfriendrequest/"+id,
        method: "DELETE",
        contentType: "json",
        async: false,
        error: function (response) {
            window.location.href = 'https://localhost:7261/404';
        },
        success: function (response) {
            console.log(response)
            $('#addfriend').html("Add Friend");
            document.getElementById('addfriend').style.backgroundColor = "green";
            $('#follow').html("Follow");
        }
    })
}
function Block(id) {
    $.ajax({
        url: "http://localhost:8080/api/relation/block/"+id,
        method: "POST",
        contentType: "json",
        async: false,
        error: function (response) {

        },
        success: function (response) {
            console.log(response)
            $('#block').html("UnBlock");
            document.getElementById('block').style.backgroundColor = "red";
            document.getElementById('addfriend').style.display = "none";
            document.getElementById('follow').style.display = "none";
        }
    })
}
function Unblock(id) {
    $.ajax({
        url: "http://localhost:8080/api/relation/unblock/"+id,
        method: "DELETE",
        contentType: "json",
        async: false,
        error: function (response) {

        },
        success: function (response) {
            console.log(response);
            $('#block').html("Block");
            $('#addfriend').html("Add Friend");
            $('#follow').html("Follow");
            document.getElementById('block').style.backgroundColor = "green";
            document.getElementById('addfriend').style.backgroundColor = "green";
            document.getElementById('follow').style.backgroundColor = "green";
            document.getElementById('addfriend').style.display = "block";
            document.getElementById('follow').style.display = "block";
        }
    })
}
function Follow(id) {
    $.ajax({
        url: "http://localhost:8080/api/relation/follow/"+id,
        method: "POST",
        contentType: "json",
        error: function (response) {

        },
        success: function (response) {
            console.log(response)
            $('#follow').html("UnFollow");
        }
    })
}
function Unfollow(id) {
    $.ajax({
        url: "http://localhost:8080/api/relation/unfollow/"+id,
        method: "DELETE",
        contentType: "json",
        error: function (response) {

        },
        success: function (response) {
            console.log(response);
            $('#follow').html("Follow");
        }
    })
}

function CheckFriend() {
    $.ajax({
        url: 'http://localhost:8080/api/relation/friendlist',
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        error: function (response) {

        },
        success: function (response) {
            console.log(response);
            const len = response.data.length;
            for (var i = 0; i < len; i++) {
                if (response.data[i].userTargetId === userId) {
                    $('#addfriend').html("Unfriend");
                }
            }
        }
    })
}
function CheckFollow() {
    $.ajax({
        url: 'http://localhost:8080/api/relation/followlist',
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        error: function (response) {

        },
        success: function (response) {
            console.log(response);
            const len = response.data.length;
            for (var i = 0; i < len; i++) {
                if (response.data[i].userTargetId === userId) {
                    $('#follow').html("UnFollow");
                }
            }
        }
    })
}
function CheckBlock() {
    $.ajax({
        url: 'http://localhost:8080/api/relation/blocklist',
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        error: function (response) {

        },
        success: function (response) {
            console.log(response);
            const len = response.data.length;
            for (var i = 0; i < len; i++) {
                if (response.data[i].userTargetId === userId) {
                    $('#block').html("UnBlock");
                    document.getElementById('block').style.backgroundColor = "red";
                    document.getElementById('addfriend').style.display = "none";
                    document.getElementById('follow').style.display = "none";
                }
            }
        }
    })
}
function CheckWaiting() {
    $.ajax({
        url: 'http://localhost:8080/api/relation/friendrequest',
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        error: function (response) {

        },
        success: function (response) {
            console.log(response);
            const len = response.data.length;
            for (var i = 0; i < len; i++) {
                if (response.data[i].userTargetId === userId) {
                    document.getElementById('addfriend').innerHTML = "Response";
                    document.getElementById('addfriend').style.backgroundColor = "blue";
                }
            }
        }
    })
}
function CheckRequest() {
    $.ajax({
        url: 'http://localhost:8080/api/relation/requestlist',
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        error: function (response) {

        },
        success: function (response) {
            console.log(response);
            const len = response.data.length;
            for (var i = 0; i < len; i++) {
                if (response.data[i].userTargetId === userId) {
                    $('#addfriend').html("Waiting");
                    document.getElementById('addfriend').style.backgroundColor = "yellow";
                }
            }
        }
    })
}

document.getElementById('follow').addEventListener("click", function () {
    if (document.getElementById('follow').innerHTML === "UnFollow") {
        Unfollow(userId);
    }
    else if (document.getElementById('follow').innerHTML === "Follow") {
        Follow(userId);
    }
})
// Xử lý modal cho block
var modalBlock = document.getElementById("ModalBlock");
document.getElementById("block").onclick = function () {
    if (document.getElementById("block").innerHTML === "Block") {
        $('#notifyBlock').html('Do you want block');
    }
    else {
        $('#notifyBlock').html('Do you want unblock');
    }
    modalBlock.style.display = "block";
}
document.getElementById('confirmBlock').addEventListener("click", function () {
    if (document.getElementById("block").innerHTML === "Block") {
        Block(userId);
        modalBlock.style.display = "none";
    }
    else if (document.getElementById("block").innerHTML === "UnBlock") {
        Unblock(userId);
        modalBlock.style.display = "none";
    }
})
document.getElementById('cancleBlock').addEventListener("click", function () {
    modalBlock.style.display = "none";
})
// Xử lý modal cho add friend,cancle,accept,reject friend request và unfriend
var modalFriend = document.getElementById("ModalFriend");
var modalResponseFriend = document.getElementById("ModalResponseFriend");
document.getElementById("addfriend").onclick = function () {
    if (document.getElementById('addfriend').innerHTML === "Add Friend") {
        SendFriendRequest(userId);
    }
    else if (document.getElementById("addfriend").innerHTML === "Waiting") {
        $('#notifyFriend').html('Do you want cancle friend request');
        modalFriend.style.display = "block";
    }
    else if (document.getElementById("addfriend").innerHTML === "Unfriend") {
        $('#notifyFriend').html('Do you want unfriend');
        modalFriend.style.display = "block";
    }
    else if (document.getElementById("addfriend").innerHTML === "Response") {
        modalResponseFriend.style.display = "block";
    }
}
document.getElementById('confirmFriend').addEventListener("click", function () {
    if (document.getElementById("addfriend").innerHTML === "Waiting") {
        CancelFriendRequest(userId);
        modalFriend.style.display = "none";
    }
    else if (document.getElementById("addfriend").innerHTML === "Unfriend") {
        Unfriend(userId);
        modalFriend.style.display = "none";
    }
})
document.getElementById('cancleFriend').addEventListener("click", function () {
    modalFriend.style.display = "none";
})
document.getElementById('acceptrequest').addEventListener("click", function () {
    AcceptFriendRequest(userId);
    modalResponseFriend.style.display = "none";
})
document.getElementById('rejectrequest').addEventListener("click", function () {
    RejectFriendRequest(userId);
    modalResponseFriend.style.display = "none";
})
window.onclick = function (event) {
    if (event.target == modalFriend) {
        modalFriend.style.display = "none";
    }
    else if (event.target == modalBlock) {
        modalBlock.style.display = "none";
    }
    else if (event.target == modalResponseFriend) {
        modalResponseFriend.style.display = "none";
    }
}