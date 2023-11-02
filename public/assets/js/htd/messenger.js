$(document).ready(function () {
    const currentUserId = localStorage.getItem('userId');
    const targetId = localStorage.getItem("userTargetId");
    MessageContent(targetId);
    $('#inputMess').keypress(function (event) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            NewMessage(targetId);
        }
    });
    document.getElementById('inputMess').addEventListener("click", function () {
        MessageContent(targetId);
    })
    document.getElementById("sendBtn").addEventListener('click', () => {
        NewMessage(targetId);
    });
    document.getElementById('messageContent').innerHTML = '';
})
function MessageContent(userTarget) {
    let userAvatar = '';
    $.ajax({
        url: 'https://localhost:7131/v1/api/users/' + userTarget,
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        xhrFields: {
            withCredentials: true
        },
        success: function (user) {
            userAvatar = user.avatar;
        }
    });
    $.ajax({
        url: 'https://localhost:7131/v2/api/Message/' + userTarget,
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        xhrFields: {
            withCredentials: true
        },
        success: function (message) {
            let type = 2;
            if (currentUserId == message[0].userTargetId) {
                type = 1;
            }
            let messageContent = '';
            for (var i = 0, len = message.length; i < len; i++) {
                if (message[i].type == type) {
                    messageContent += `<div class="message-item">
                                            <div class="message-user" style="display: inline-block">
                                                <figure class="avatar">
                                                    <img src="${userAvatar}" alt="image">
                                                </figure>
                                            </div>
                                            <div class="message-wrap" style="display: inline-block;">${message[i].content}</div>
                                        </div>`;
                }
                else {
                    messageContent += `<div class="message-item outgoing-message">
                                            <div class="message-wrap">${message[i].content}</div>
                                        </div>`;
                }
            }
            document.getElementById("messageContent").innerHTML = messageContent;
            
        }
    });
    
}
function NewMessage(userTarget) {
    let content = document.getElementById("inputMess").value;
    $.ajax({
        url: 'https://localhost:7131/v2/api/Message/send-message/' + userTarget + '/' + content,
        method: 'POST',
        xhrFields: {
            withCredentials: true
        },
        success: function () {
            MessageContent(userTarget);
            document.getElementById("inputMess").value = '';
        }
    });
}