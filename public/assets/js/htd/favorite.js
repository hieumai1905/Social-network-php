const currentUserId = $("#userCurrent").text();
$(document).ready(function() {
    loadFavoritePost();
});

function loadFavoritePost() {
    $.ajax({
        url: 'http://localhost:8080/api/favorite',
        method: 'GET',
        contentType: 'application/json',
        dataType: 'json',
        async: false,
        error: function (post){
            console.log("Loi bai viet yeu thich");
        },
        success: function (post) {
            var favorite = '';
            var content = 'Bài viết có chứa nội dung ảnh';
            var author = 'BronieSW';
            var avatar = 'BronieSW.jpg';
            for (var i = 0; i < post.data.length; i++) {
                $.ajax({
                    url: 'http://localhost:8080/api/post/' + post.data[i].postId,
                    method: 'GET',
                    contentType: 'application/json',
                    dataType: 'json',
                    async: false,
                    error: function (error) {
                        console.log(error, 'Loi lay bau viet');
                    },
                    success: function (result){
                        content = result.data.content;
                        $.ajax({
                            url: 'http://localhost:8080/api/users/' + result.data.userId,
                            method: 'GET',
                            contentType: 'application/json',
                            dataType: 'json',
                            async: false,
                            error: function (error) {
                                console.log(error, 'Loi lay user');
                            },
                            success: function (user){
                                author = user.data.fullName;
                                avatar = user.data.avatar;
                            }
                        });
                    }
                });
                if (content.length > 50){
                    content = content.slice(1,47) + '...';
                }
                if (content.length == 0){
                    content = 'Bài viết có chứa nội dung ảnh'
                }
                console.log(content);
                console.log(avatar);
                console.log(author);
                favorite += `                            <div class='col-md-12 col-sm-4 pe-2 ps-2 phong1'>
                                <div class='card d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3 phong2'>
                                    <div class='card-body w-100 ps-3 pe-3 pb-4 phong3' style="display: flex; flex-direction: row; align-items: center; height: 150px">
                                        <figure class='avatar mb-0 position-relative w65 z-index-1 phong4'>
                                            <img style='width:65px; height:65px; border-radius:10px;' src='public/images/${avatar}' alt='image' class='phong5'>
                                        </figure>
                                        <div class='clearfix phong6'></div>
                                        <h4 class='fw-700 font-xsss phong7'>${content}</h4>
                                        <p class='fw-500 font-xsssss text-grey-500 phong8'>${author}</p>
                                        <a style="cursor: pointer;"
                                           class="ms-auto"
                                           id="dropdownMenu2"
                                           data-bs-toggle="dropdown"
                                           aria-expanded="false">
                                            <i
                                                class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss" style = "display: flex;flex-direction: row;align-items: center;justify-content: center;">
                                            </i
                                            >
                                        </a>
                                        <div
                                            class="dropdown-menu dropdown-menu-end rounded-xxl border-0 shadow-lg" style="padding: 5px"
                                            aria-labelledby="dropdownMenu2">
                                            <div class="card-body p-0 d-flex mt-2" style="cursor: pointer" onclick="UnsaveThisPost('${post.postId}')" ')">
                                            <i
                                                class="feather-bookmark text-grey-500 me-3 font-lg">
                                            </i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">
                                                UnSave this post
                                                <span
                                                    class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                            Save to your saved items
                        </span
                        >
                                            </h4>
                                        </div>
                                    </div>

                                </div>
                            </div>`;
            }
            $('#favoritePost').html(favorite);
        }
    });
}

function UnsaveThisPost(postId){
    $.ajax({
        url: 'http://localhost:8080/api/favorite/' + postId,
        method: 'DELETE',
        error: function (error) {
            console.log(error, "Loi bo luu post");
        },
        success: function () {
            ShowLoader();
            loadFavoritePost();
        }

    });
}