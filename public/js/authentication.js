$(document).ready(function () {
    checkAuthentication()
});

function checkAuthentication() {
    let userId = localStorage.getItem('userId');
    if (userId == null) {
        if (location.pathname == 'https://localhost:7261/login') {
            return;
        }
        if (location.pathname == 'https://localhost:7261/register') {
            return;
        }
        location.href = 'https://localhost:7261/login';
    }
}