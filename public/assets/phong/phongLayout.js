$('#searchuser').keypress(function (event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        var content = document.getElementById('searchuser').value;
        var encodedContent = encodeURIComponent(content);
        var url = "http://localhost:8080/users/" + encodedContent + "/findusers";
        window.location.replace(url);
    }
});