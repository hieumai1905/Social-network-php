$(document).ready(function () {
    GetCountNotificationUnSeen();
});
$('#searchuser').keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        var content = document.getElementById('searchuser').value;
        var encodedContent = encodeURIComponent(content);
        var url = "http://localhost:8080/users/" + encodedContent + "/findusers";
        window.location.replace(url);
    }
});
function GetCountNotificationUnSeen() {
    $.ajax({
        url: 'http://localhost:8080/api/notification/countnotificationunseen',
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        async: false,
        error: function (response) {
        },
        success: function (response) {
            var count = response.data;
            if (count !== 0) {
                var html = `<span class="notification-count" style="position: absolute;
    top: -5px;
    right: -5px;
    background-color: red;
    color: white;
    font-size: 12px;
    padding: 2px 5px;
    border-radius: 50%;">${count}</span>`;
                $('#countnotificationunseen').html(html);
            }
        },
        fail: function (response) {
        }
    });
}