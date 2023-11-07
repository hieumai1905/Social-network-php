$(document).ready(function () {
    loadData();
});

function loadData() {
    $.ajax({
        url: 'http://localhost:8080/api/admin/users-all',
        type: 'GET',
        contentType: "application/json",
        success: function (response) {
            if(response.status === 200){
                usersData = response.data;
                const totalRecords = usersData.length;
                $("#count-users").text(totalRecords);
            }
        },
        error: function (error) {

        }
    });
    $.ajax({
        url: 'http://localhost:8080/api/admin/users-all/month',
        type: 'GET',
        contentType: "application/json",
        success: function (response) {
            if(response.status === 200){
                usersData = response.data;
                const totalRecords = usersData.length;
                $("#count-new-users").text(totalRecords);
            }
        },
        error: function (error) {

        }
    });
    $.ajax({
        url: 'http://localhost:8080/api/admin/post',
        type: 'GET',
        contentType: "application/json",
        success: function (response) {
            if(response.status === 200){
                postsData = response.data;
                const totalRecords = postsData.length;
                $("#count-posts").text(totalRecords);
            }
        },
        error: function (error) {

        }
    });
    $.ajax({
        url: 'http://localhost:8080/api/admin/post/month',
        type: 'GET',
        contentType: "application/json",
        success: function (response) {
            if(response.status === 200){
                postsData = response.data;
                const totalRecords = postsData.length;
                $("#count-posts-per-month").text(totalRecords);
            }
        },
        error: function (error) {

        }
    });
}
