const currentUserIdPost = localStorage.getItem('userId');
const currentPostId = '76c3191a-6c19-4db6-b745-86cfc1b30499';
$(document).ready(function () {
    GetThePosts(currentPostId);

});

function GetThePosts(postId) {
    $.ajax({
        url: 'https://localhost:7131/v2/api/Posts/' + postId,
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        async: false,
        xhrFields: {
            withCredentials: true
        },
        error: function (reponse) {
            window.location.href = 'https://localhost:7261/404';
            return;
        },
        success: function (reponse) {
            console.log(reponse);
            const postCount = reponse.length;
            let post = '';
            let username = '';
            let avatar = '';
            let imageUrl = [];
                $.ajax({
                    url: 'https://localhost:7131/v1/api/Users/' + reponse.userId,
                    method: 'GET',
                    contentType: 'json',
                    dataType: 'json',
                    xhrFields: {
                        withCredentials: true
                    },
                    async: false,
                    success: function (user) {
                        username = user.fullName;
                        avatar = user.avatar;
                    }
                });
                $.ajax({
                    url: 'https://localhost:7131/vi/api/Image/' + reponse.postId,
                    method: 'GET',
                    contentType: 'json',
                    dataType: 'json',
                    xhrFields: {
                        withCredentials: true
                    },
                    async: false,
                    success: function (image) {
                        for (let j = 0, len = image.length; j < len; j++) {
                            imageUrl.push(image[j].url);
                        }
                    }
                });
                post += `<div id="post" class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
        <div class="card-body p-0 d-flex">
            <figure class="avatar me-3">
                <img
                    src="${avatar}"
                    alt="image"
                    class="shadow-sm rounded-circle w45"/>
            </figure>
            <h4 class="fw-700 text-grey-900 font-xssss mt-1">
                ${username}
                <span
                    class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">
                    ${reponse.createAt}
                </span>
                <span style="display: none">${reponse.postId}</span>
            </h4>
            <a
                href="#"
                class="ms-auto"
                id="dropdownMenu2"
                data-bs-toggle="dropdown"
                aria-expanded="false">
                <i
                    class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss">
                </i
                >
            </a>
            <div
                class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                aria-labelledby="dropdownMenu2">
                `;

                if (currentUserId == reponse.userId) {
                    post += `<div class="card-body p-0 d-flex">
                    <i
                        class="feather-bookmark text-grey-500 me-3 font-lg">
                    </i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4" onclick ="DeleteThisPost('${reponse.postId}','${reponse.userId}')">
                        Delete Post
                        <span
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                            Delete this post
                        </span
                        >
                    </h4>
                </div>
                <div class="card-body p-0 d-flex mt-2">
                    <i
                        class="feather-alert-circle text-grey-500 me-3 font-lg">
                    </i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4" onclick ="UpdateThisPost('${reponse.postId}','${reponse.userId}','${reponse.content}')" >Edit Post
                        <span
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                            Edit Post
                        </span
                        >
                    </h4>
                </div>`;
                }

                post += `
                <div class="card-body p-0 d-flex mt-2">
                    <i
                        class="feather-alert-octagon text-grey-500 me-3 font-lg">
                    </i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">
                        Hide all from Group
                        <span
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                            Save to your saved items
                        </span
                        >
                    </h4>
                </div>
                <div class="card-body p-0 d-flex mt-2">
                    <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                    <h4
                        class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">
                        Unfollow Group
                        <span
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                            Save to your saved items
                        </span
                        >
                    </h4>
                </div>
            </div>
        </div>
        <div class="card-body p-0 me-lg-5">
            <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">
                ${reponse.content}
                <a href="#" class="fw-600 text-primary ms-2">See more</a>
            </p>
        </div>
        <div class="card-body d-block p-0">
            <div class="row ps-2 pe-2">`;

                for (let j = 0, len = imageUrl.length; j < len; j++) {
                    post += `<div class="col-xs-4 col-sm-4 p-1">
                    <a href="${imageUrl[j]}" data-lightbox="roadtrip">
                        <img
                            src="${imageUrl[j]}"
                            class="rounded-3 w-100"
                            alt="image"/>
                    </a></div>`;
                }

                post += `</div>
        </div>
        <div class="card-body d-flex p-0 mt-3">
            <a
                href="#"
                class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2">
                <i
                    class="feather-thumbs-up text-white bg-primary-gradiant me-1 btn-round-xs font-xss">
                </i>
                <i
                    class="feather-heart text-white bg-red-gradiant me-2 btn-round-xs font-xss">
                </i
                >${reponse.likeCount} Like
            </a
            >
            <div class="emoji-wrap">
                <ul class="emojis list-inline mb-0">
                    <li class="emoji list-inline-item">
                        <i class="em em---1"></i>
                    </li>
                    <li class="emoji list-inline-item">
                        <i class="em em-angry"></i>
                    </li>
                    <li class="emoji list-inline-item">
                        <i class="em em-anguished"></i>
                    </li>
                    <li class="emoji list-inline-item">
                        <i class="em em-astonished"></i>
                    </li>
                    <li class="emoji list-inline-item">
                        <i class="em em-blush"></i>
                    </li>
                    <li class="emoji list-inline-item">
                        <i class="em em-clap"></i>
                    </li>
                    <li class="emoji list-inline-item">
                        <i class="em em-cry"></i>
                    </li>
                    <li class="emoji list-inline-item">
                        <i class="em em-full_moon_with_face"></i>
                    </li>
                </ul>
            </div>
            <a
                href="#"
                class="d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss">
                <i
                    class="feather-message-circle text-dark text-grey-900 btn-round-sm font-lg">
                </i
                ><span class="d-none-xss">${reponse.commnetCount} Comment</span>
            </a
            >
            <a
                href="#"
                id="dropdownMenu21"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                class="ms-auto d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss">
                <i
                    class="feather-share-2 text-grey-900 text-dark btn-round-sm font-lg">
                </i
                ><span class="d-none-xs">Share</span>
            </a
            >
            <div
                class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg"
                aria-labelledby="dropdownMenu21">
                <h4
                    class="fw-700 font-xss text-grey-900 d-flex align-items-center">
                    Share
                    <i
                        class="feather-x ms-auto font-xssss btn-round-xs bg-greylight text-grey-900 me-2">
                    </i>
                </h4>
                <div class="card-body p-0 d-flex">
                    <ul
                        class="d-flex align-items-center justify-content-between mt-2">
                        <li class="me-1">
                            <a href="#" class="btn-round-lg bg-facebook">
                                <i class="font-xs ti-facebook text-white">
                                </i
                                >
                            </a>
                        </li>
                        <li class="me-1">
                            <a href="#" class="btn-round-lg bg-twiiter">
                                <i class="font-xs ti-twitter-alt text-white">
                                </i
                                >
                            </a>
                        </li>
                        <li class="me-1">
                            <a href="#" class="btn-round-lg bg-linkedin">
                                <i class="font-xs ti-linkedin text-white">
                                </i
                                >
                            </a>
                        </li>
                        <li class="me-1">
                            <a href="#" class="btn-round-lg bg-instagram">
                                <i class="font-xs ti-instagram text-white">
                                </i
                                >
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn-round-lg bg-pinterest">
                                <i class="font-xs ti-pinterest text-white">
                                </i
                                >
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-0 d-flex">
                    <ul
                        class="d-flex align-items-center justify-content-between mt-2">
                        <li class="me-1">
                            <a href="#" class="btn-round-lg bg-tumblr">
                                <i class="font-xs ti-tumblr text-white">
                                </i
                                >
                            </a>
                        </li>
                        <li class="me-1">
                            <a href="#" class="btn-round-lg bg-youtube">
                                <i class="font-xs ti-youtube text-white">
                                </i
                                >
                            </a>
                        </li>
                        <li class="me-1">
                            <a href="#" class="btn-round-lg bg-flicker">
                                <i class="font-xs ti-flickr text-white">
                                </i
                                >
                            </a>
                        </li>
                        <li class="me-1">
                            <a href="#" class="btn-round-lg bg-black">
                                <i class="font-xs ti-vimeo-alt text-white">
                                </i
                                >
                            </a>
                        </li>
                        <li>
                            <a href="#" class="btn-round-lg bg-whatsup">
                                <i class="font-xs feather-phone text-white">
                                </i
                                >
                            </a>
                        </li>
                    </ul>
                </div>
                <h4
                    class="fw-700 font-xssss mt-4 text-grey-500 d-flex align-items-center mb-3">
                    Copy Link
                </h4>
                <i
                    class="feather-copy position-absolute right-35 mt-3 font-xs text-grey-500">
                </i>
                <input
                    type="text"
                    value="https://socia.be/1rGxjoJKVF0"
                    class="bg-grey text-grey-500 font-xssss border-0 lh-32 p-2 font-xssss fw-600 rounded-3 w-100 theme-dark-bg"/>
            </div>
        </div>
        </div>`;
            console.log(post);
            document.getElementById('mainContentPost').innerHTML = post;
        }
    });
}

