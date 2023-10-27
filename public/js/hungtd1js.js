$(document).ready(function () {
    GetAllPosts();

    document.getElementById("exitButton").addEventListener('click', () => {
        TextInputDisappear();
        document.getElementById("postContent").value = '';
        imageList.length = 0;
    });
    document.getElementById("postButton").addEventListener('click', () => { Post(); });

});
const currentUserId = localStorage.getItem('userId');
let imageList = [];
let postJustCreate = '';

function GetAllPosts() {
    $.ajax({
        url: 'https://localhost:7131/v2/api/Posts/home/posts',
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        xhrFields: {
            withCredentials: true
        },
        error: function (reponse) {
        },
        success: function (reponse) {
            postJustCreate = reponse[0].postId;
            const postCount = reponse.length;
            //console.log(postCount);
            let post = '';
            let username = '';
            let avatar = '';
            let imageUrl = [];
            for (let i = 0; i < postCount; ++i) {
                $.ajax({
                    url: 'https://localhost:7131/v1/api/Users/' + reponse[i].userId,
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
                    url: 'https://localhost:7131/vi/api/Image/' + reponse[i].postId,
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
                    ${reponse[i].createAt}
                </span>
                <span style="display: none">${reponse[i].postId}</span>
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

                if (currentUserId == reponse[i].userId) {
                    post += `<div class="card-body p-0 d-flex">
                    <i
                        class="feather-bookmark text-grey-500 me-3 font-lg">
                    </i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4" onclick ="DeleteThisPost('${reponse[i].postId}','${reponse[i].userId}')">
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
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4" onclick ="UpdateThisPost('${reponse[i].postId}','${reponse[i].userId}','${reponse[i].content}')" >Edit Post
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
                    <h4 id="report-btn" onclick="OpenReportDialog()"
                        class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">
                        Report this Post
                        <span 
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                            Report if you see any problem
                        </span
                        >
                    </h4>
                </div>
            </div>
        </div>
        <div class="card-body p-0 me-lg-5">
            <p class="fw-500 text-grey-500 lh-26 font-xssss w-100">
                ${reponse[i].content}
                <a href="#" class="fw-600 text-primary ms-2">See more</a>
            </p>
        </div>
        <div class="card-body d-block p-0">
            <div class="row ps-2 pe-2">`;

                for (let j = 0, len = imageUrl.length; j < len; j++) {
                    let item = imageUrl[j];
                    let urlNew = item.lastIndexOf('.');
                    let value = item.slice(urlNew);
                    if (value === ".mp4") {
                        post += `<div class="col-xs-4 col-sm-4 p-1">
                    <a href="${imageUrl[j]}" data-lightbox="roadtrip">
                        <video controls width="100px" height="100px">
                             <source src="${imageUrl[j]}">
                        </video>
                    </a></div>`;
                    } else {
                        post += `<div class="col-xs-4 col-sm-4 p-1">
                    <a href="${imageUrl[j]}" data-lightbox="roadtrip">
                        <img width="100px" height="100px"
                            src="${imageUrl[j]}"
                            class="rounded-3 w-100"
                            alt="image"/>
                    </a></div>`;
                    }
                }


                post += `</div>
        </div>
        <div class="card-body d-flex p-0 mt-3">
            <a
                class="emoji-bttn d-flex align-items-center fw-600 text-grey-900 text-dark lh-26 font-xssss me-2">
                <p class="like-button-post" id="like-button-post-${reponse[i].postId}" onclick="likePost('${reponse[i].postId}')">Like</p>
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
                href="#" class="open-modal" >
                <p class="comment-button"  id="comment-button-post-${reponse[i].postId}" onclick="GetAllComments('${reponse[i].postId}')"> Comment</p>
            </a>
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
        </div>
                    <div id="report-dialog" class="dialog">
  <div class="dialog-content-rp">
    <span class="close">&times;</span>
    <h2 class="title">Report Post</h2>
    <!-- <form id="report-form"> -->
      <label>
        <input type="radio" name="report-reason" value="spam" required>
        Spam
      </label>
      <label>
        <input type="radio" name="report-reason" value="inappropriate">
        Inappropriate content
      </label>
      <label>
        <input type="radio" name="report-reason" value="erotic" required>
        Erotic Content
      </label>
      <label>
        <input type="radio" name="report-reason" value="wrong" required>
        Wrong Information
      </label>
      <label>
        <input type="radio" name="report-reason" value="terrorism" required>
        Content That Promotes Terrorism
      </label>
      <label>
        <input type="radio" name="report-reason" value="Copyright">
        Content That Infringes Copyright
      </label>
      <h3 class="info">
        For flagged posts and users, Olala's team reviews them 24/7 to determine if the post/user is in violation of the Community Guidelines.
        Accounts will be penalized for violating Community Guidelines, and severe or repeated violations may result in account termination.
      </h3>
      <p class="btn-rp" onclick="SubmitReport('${reponse[i].postId}')" >Submit</p>
    <!-- </form> -->
  </div>
</div>
                `;
                post += ` <div id="commentModal" class="modal">
  <!-- Modal content -->
  <div class="modal-content" style="position: relative;">
    <div style="position: absolute; right: 2px; top:2px">
      <span class="close ">&times;</span>
    </div>

       <div id="CommentList"></div>
      <div class="comment-input">
      <img src="${avatar}" alt="User Avatar" />
      <textarea id="comment-text" placeholder="Write a comment..." required data-validation-message="Please enter a comment"></textarea>
      <button id="comment-submit" onclick="AddNewComment('${reponse[i].postId}')">Send</button>
      </div>
    </div>
  </div>`;

                imageUrl.length = 0;
            }
            document.getElementById('PostList').innerHTML = post;
        }
    });
}

function GetPost(id) {
    $.ajax({
        url: 'https://localhost:7131/v2/api/Posts/users/' + id,
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        xhrFields: {
            withCredentials: true
        },
        error: function (reponse) {
        },
        success: function (reponse) {
            postJustCreate = reponse[0].postId;
            const postCount = reponse.length;
            let post = '';
            let username = '';
            let avatar = '';
            let imageUrl = [];
            for (let i = 0; i < postCount; ++i) {
                $.ajax({
                    url: 'https://localhost:7131/v1/api/Users/' + reponse[i].userId,
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
                    url: 'https://localhost:7131/vi/api/Image/' + reponse[i].postId,
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
                    style="width:50px; height:50px; border-radius:50px;"
                    src="${avatar}"
                    alt="image"
                    />
            </figure>
            <h4 class="fw-700 text-grey-900 font-xssss mt-1">
                ${username}
                <span
                    class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">
                    ${reponse[i].createAt}
                </span>
                <span style="display: none">${reponse[i].postId}</span>
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
                <div class="card-body p-0 d-flex">
                    <i
                        class="feather-bookmark text-grey-500 me-3 font-lg">
                    </i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4" onclick ="DeleteThisPost('${reponse[i].postId}','${reponse[i].userId}')">
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
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4" onclick ="UpdateThisPost('${reponse[i].postId}','${reponse[i].userId}','${reponse[i].content}')" >Edit Post
                        <span
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                            Edit Post
                        </span
                        >
                    </h4>
                </div>
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
                ${reponse[i].content}
                <a href="#" class="fw-600 text-primary ms-2">See more</a>
            </p>
        </div>
        <div class="card-body d-block p-0">
            <div class="row ps-2 pe-2">`;

                for (let j = 0, len = imageUrl.length; j < len; j++) {
                    let item = imageUrl[j];
                    let urlNew = item.lastIndexOf('.');
                    if (item.slice(urlNew) === "mp4") {
                        post += `<div class="col-xs-4 col-sm-4 p-1">
                    <a href="${imageUrl[j]}" data-lightbox="roadtrip">
                        <video controls>
                             <source src="${imageUrl[j]}">
                        </video>
                    </a></div>`;
                    } else {
                        post += `<div class="col-xs-4 col-sm-4 p-1">
                    <a href="${imageUrl[j]}" data-lightbox="roadtrip">
                        <img
                            src="${imageUrl[j]}"
                            class="rounded-3 w-100"
                            alt="image"/>
                    </a></div>`;
                    }
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
                >${reponse[i].likeCount} Like
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
                ><span class="d-none-xss">${reponse[i].commnetCount} Comment</span>
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
                imageUrl.length = 0;
            }
            document.getElementById('PostListId').innerHTML = post;
        }
    });
}
function CreateNewPost() {
    let content = document.getElementById("postContent").value;
    $.ajax({
        url: 'https://localhost:7131/v2/api/Posts',
        method: 'POST',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        xhrFields: {
            withCredentials: true
        },
        data: JSON.stringify({
            commnetCount: 100,
            likeCount: 10,
            content: content,
            accessModifier: "public",
            postType: "string",
            userId: currentUserId
        }),
        success: function () {
            AddImagesToPost();
            Loader();
        },
        error: function (err) {
            if (err.status == 400)
                alert("Bài viết của bạn có những từ ngữ nhạy cảm, xúc phạm hoặc gây hiểu lầm");
            if (err.status == 403)
                alert("Tài khoản của bạn đã bị ban do vi phạm điều khoản cộng đồng của chúng tôi");
            document.getElementById('createPost').value = "";
        }
    });
}

function Loader() {
    document.getElementById("loadingScreen").style.display = "flex";
    setTimeout(function () {
        document.getElementById("loadingScreen").style.display = "none";
        GetAllPosts();
        GetPost(localStorage.getItem("userTargetId"));
    }, 3000);
    document.getElementById("postContent").value = '';
}

function DeleteThisPost(postId, userId) {
    console.log(userId);
    if (userId != currentUserId) {
        alert("Bạn không phải tác giả của bài viết này");
        return;
    }
    $.ajax({
        url: 'https://localhost:7131/vi/api/Image/' + postId,
        method: 'DELETE',
        async: false,
        xhrFields: {
            withCredentials: true
        },
        success: function (data) {
            $.ajax({
                url: 'https://localhost:7131/v2/api/Posts/' + postId,
                method: 'DELETE',
                async: false,
                xhrFields: {
                    withCredentials: true
                },
                success: function (data) {
                    Loader();
                }
            });
        }
    });
}

function TextInputAppear() {
    document.getElementById('testText').style.display = "flex";
}
function TextInputDisappear() {
    document.getElementById('testText').style.display = "none";
    document.getElementById("postButton").style.display = "block";
    document.getElementById("editButton").style.display = "none";
    $(".preview").empty();
}

function Post() {
    TextInputDisappear();
    CreateNewPost();
}
function UpdateThisPost(postId, userId, postContent) {
    if (userId != currentUserId) {
        alert("Bạn không phải tác giả của bài viết này");
        return;
    }
    document.getElementById("postButton").style.display = "none";
    document.getElementById("editButton").style.display = "block";
    TextInputAppear();
    document.getElementById("postContent").value = postContent;
    document.getElementById("editButton").onclick = function () {
        $.ajax({
            url: 'https://localhost:7131/v2/api/Posts/' + postId,
            method: 'PUT',
            dataType: 'json',
            contentType: "application/json; charset=utf-8",
            xhrFields: {
                withCredentials: true
            },
            data: JSON.stringify({
                postId: postId,
                commnetCount: 100,
                likeCount: 10,
                content: document.getElementById("postContent").value,
                accessModifier: "public",
                postType: "string",
                userId: userId
            }),
            success: function () {
                TextInputDisappear();
                Loader();
            }
        });
    };

}

const ipnFileElement = document.querySelector('input')
const resultElement = document.querySelector('.preview')
const validImageTypes = ['image/gif', 'image/jpeg', 'image/png']

ipnFileElement.addEventListener('change', function (e) {
    const files = e.target.files
    const file = files[0]
    const fileType = file['type']
    console.log(files[0])

    //if (!validImageTypes.includes(fileType)) {
    //    resultElement.insertAdjacentHTML(
    //        'beforeend',
    //        '<span class="preview-img">Chọn ảnh đi :3</span>'
    //    )
    //    return
    //}

    const fileReader = new FileReader()
    fileReader.readAsDataURL(file)

    fileReader.onload = function () {

        const url = fileReader.result
        resultElement.insertAdjacentHTML(
            'beforeend',

            `<img src="${url}" alt="${file.name}" class="preview-img"/>
            <video controls width="100px" height="100px">
             <source src="${url}">
            </video>
                `
        )
        imageList.push(file.name);
        console.log(imageList);
    }
})

function AddImagesToPost(idNewPost = '') {
    if (idNewPost == '') {
        $.ajax({
            url: 'https://localhost:7131/v2/api/Posts',
            method: 'GET',
            contentType: 'json',
            dataType: 'json',
            async: false,
            xhrFields: {
                withCredentials: true
            },
            success: function (reponse) {
                idNewPost = reponse[0].postId;
                console.log(idNewPost);
            }
        });
    }

    if (imageList.length > 0) {
        for (var i = 0, len = imageList.length; i < len; i++) {
            console.log(imageList[i])
            $.ajax({
                url: 'https://localhost:7131/vi/api/Image',
                method: 'POST',
                async: false,
                dataType: 'json',
                contentType: "application/json; charset=utf-8",
                xhrFields: {
                    withCredentials: true
                },
                data: JSON.stringify({
                    url: 'images/' + imageList[i],
                    type: 'string',
                    postId: idNewPost,
                }),
                success: function (data) {
                    console.log(idNewPost);
                },
                error: function () {
                    console.log("Loi nay");
                    window.location.href = 'https://localhost:7261/404';
                }
            });
        }
        imageList.length = 0;
        console.log(imageList)
    }

}
