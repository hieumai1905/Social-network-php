let usersData; // Biến để lưu trữ dữ liệu người dùng
let currentPage = 1; // Số trang hiện tại
const recordsPerPage = 9; // Số bản ghi trên mỗi trang

$(document).ready(function () {
    loadUsers();

    $(document).on('click', '.lock-user', function () {
        let id = $(this).closest('tr').find('td:first').text();
        lockUser(id);
        if ($(this).text() === "LOCK") {
            $(this).text("UNLOCK");
            $(this).css("background-color", "red");

        } else {
            $(this).text("LOCK");
            $(this).css("background-color", "green");
        }
    });
});

function lockUser(id) {
    $.ajax({
        url: 'http://localhost:8080/api/admin/lock-user',
        method: 'PUT',
        data: JSON.stringify({
            "user_id": id
        }),
        contentType: 'application/json',
        error: function (reponse) {
        },
        success: function (reponse) {
            console.log(reponse);
        }
    });
}
function loadUsers() {
    $.ajax({
        url: 'http://localhost:8080/api/admin/users-all',
        type: 'GET',
        contentType: "application/json",
        success: function (response) {
            if (response.status === 200) {
                usersData = response.data;
                const totalRecords = usersData.length;
                const totalPages = Math.ceil(totalRecords / recordsPerPage);

                let html = '';
                let startIndex = (currentPage - 1) * recordsPerPage;
                let endIndex = startIndex + recordsPerPage;

                if (endIndex > totalRecords) {
                    endIndex = totalRecords;
                }

                if (totalRecords === 0) {
                    html += '<tr><td colspan="5">No users found.</td></tr>';
                } else {
                    for (let i = startIndex; i < endIndex; i++) {
                        let user = usersData[i];

                        html += '<tr>';
                        html += '<td style="text-align: center;">' + user.userId + '</td>';
                        html += '<td>' + user.fullName + '</td>';
                        html += '<td>' + user.email + '</td>';
                        html += '<td style="text-align: center;">' + user.phone + '</td>';
                        html += '<td style="text-align: center;">';
                        if (user.status === "LOCK") {
                            status = "UNLOCK";
                            html += '<button style="width: 80px; height: 28px; background-color: red; border: none; color: white;" class="lock-user">' + status + '</button> ';
                        } else {
                            status = "LOCK";
                            html += '<button style="width: 80px; height: 28px; background-color: green; border: none; color: white;" class="lock-user">' + status + '</button> ';
                        }
                        html += '</td>';
                        html += '</tr>';
                    }
                }
                $("#body-content").html(html);

                // Hiển thị phân trang
                let paginationHtml = '';
                paginationHtml += '<li class="paginate_button page-item previous ' + (currentPage === 1 ? 'disabled' : '') + '"><a href="#" aria-controls="products" data-dt-idx="prev" tabindex="0" class="page-link">Previous</a></li>';

                for (let i = 1; i <= totalPages; i++) {
                    paginationHtml += '<li class="paginate_button page-item ' + (currentPage === i ? 'active' : '') + '"><a href="#" aria-controls="products" data-dt-idx="' + i + '" tabindex="0" class="page-link">' + i + '</a></li>';
                }

                paginationHtml += '<li class="paginate_button page-item next ' + (currentPage === totalPages ? 'disabled' : '') + '"><a href="#" aria-controls="products" data-dt-idx="next" tabindex="0" class="page-link">Next</a></li>';

                $("#products_paginate ul.pagination").html(paginationHtml);

                // Sự kiện click cho các trang phân trang
                $(".paginate_button.page-item a").on("click", function () {
                    const index = $(this).data("dt-idx");

                    if (index === "prev") {
                        if (currentPage > 1) {
                            currentPage--;
                            loadUsers();
                        }
                    } else if (index === "next") {
                        if (currentPage < totalPages) {
                            currentPage++;
                            loadUsers();
                        }
                    } else {
                        currentPage = index;
                        loadUsers();
                    }
                });
            } else {
                console.log(response.message);
            }
        },
        error: function (error) {
            if (error.status === 401) {
                window.location.href = 'http://localhost:8080/login';
                return;
            } else if (error.status === 403) {
                window.location.href = 'http://localhost:8080/403';
            }
            window.location.href = 'http://localhost:8080/error';
        }
    });
}