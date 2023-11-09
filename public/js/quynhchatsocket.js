$(document).ready(function () {


    getChatSocket();
});
function getChatSocket() {
    var conn = new WebSocket('ws://localhost:8081');
    $(document).ready(function () {
        conn.onopen = function (e) {
            console.log("Connection established!");
        };
        conn.onmessage = function (e) {
            console.log(e.data);
            let data = JSON.parse(e.data);
            if (data.userId == $('#riendId').val()) {

                let strHTML = `<div class="message-item">
                                    <div class="message-wrap" style="display: inline-block;">${data.message}</div>
                                </div>`;
                $('#conversation').append(strHTML);
                $('#chat_message').val('');
            }
            console.log(data);

        };

    });
    $('#sendBtn').click(function (event) {
        event.preventDefault();
        var data = {
            userId: $('#userId').val(),
            message: $('#chat_message').val()
        };
        let strMessage = `<div class="message-item outgoing-message" style="margin-left: 500px;">
                                        <div class="message-wrap">${$('#chat_message').val()}</div>
                                    </div>`
        $('#conversation').append(strMessage);
        $('#chat_message').val('');
        conn.send(JSON.stringify(data));

        $.ajax({
            url: 'http://localhost:8080/api/message/create', // URL của máy chủ hoặc tệp xử lý yêu cầu
            method: 'POST', // Phương thức HTTP (POST hoặc GET)
            data: {
                ...data,
                conver: $('#conver').val()

            }, // Dữ liệu gửi đi (có thể là đối tượng hoặc chuỗi JSON)
            success: function (response) {
                // Xử lý dữ liệu trả về từ máy chủ sau khi yêu cầu thành công
                console.log(response);
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi nếu yêu cầu thất bại
                console.error(error);
            }
        });

    });
}