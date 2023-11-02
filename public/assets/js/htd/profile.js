const currentUserId = localStorage.getItem('userId');
const targetUserId = localStorage.getItem('userTargetId');
const ipnFileElement = document.querySelector('#upload-photo')
const resultElement = document.querySelector('#showImage')
const validImageTypes = ['image/gif', 'image/jpeg', 'image/png']
let imageList = [];
let postJustCreate = '';
let changeAvt = '';
$(document).ready(function () {
    GetNewFeed();
    GetInforUser();
    imageList.length = 0;
});

function GetInforUser() {
    $.ajax({
        url: 'https://localhost:7131/v1/api/users/' + targetUserId,
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        async: false,
        xhrFields: {
            withCredentials: true,
        },
        success: function (user) {
            document.getElementById("avtPostText").src = user.avatar;
            document.getElementById("postUser").textContent = user.fullName;
            
        }
    });
}

function GetNewFeed() {
    $.ajax({
        url: 'https://localhost:7131/v2/api/Posts/users/' + targetUserId,
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        async: false,
        xhrFields: {
            withCredentials: true,
        },
        error: function () {
            console.log("Loi bai viet");
        },
        success: function (post) {
            var newfeed = '';
            for (var i = 0, len = post.length; i < len; i++) {
                newfeed += CreatePost(post[i]);
            }
            document.getElementById('PostList').innerHTML = newfeed;
        }
    });
}

function CreatePost(post) {
    var postContent = '';
    var username = '';
    var avatar = '';
    var myAvatar = '';
    var imageUrl = [];
    $.ajax({
        url: 'https://localhost:7131/v1/api/Users/' + post.userId,
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        async: false,
        xhrFields: {
            withCredentials: true
        },
        success: function (user) {
            username = user.fullName;
            avatar = user.avatar;
        },
        error: function () {
            console.log("Loi user khi lay post " + post.userId);
        }
    });
    $.ajax({
        url: 'https://localhost:7131/v1/api/Users/' + currentUserId,
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        async: false,
        xhrFields: {
            withCredentials: true
        },
        success: function (me) {

            myAvatar = me.avatar;
        },
        error: function () {
            console.log("Loi user khi lay post " + post.userId);
        }
    });
    $.ajax({
        url: 'https://localhost:7131/vi/api/Image/' + post.postId,
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        async: false,
        xhrFields: {
            withCredentials: true
        },
        success: function (image) {
            for (var i = 0, len = image.length; i < len; i++) {
                imageUrl.push(image[i].url);
            }
        },
        error: function () {
            console.log("Loi user khi lay anh ");
        }
    });
    postContent += `<div id="post" class="card w-100 shadow-xss rounded-xxl border-0 p-4 mb-3">
        <div class="card-body p-0 d-flex">
            <figure class="avatar me-3">
                <img style="cursor: pointer; width: 50px; height: 50px;"
                    src="${avatar}"
                    alt="image"
                    class="shadow-sm rounded-circle"/>
            </figure>
            <h4 class="fw-700 text-grey-900 font-xssss mt-1">
                ${username}
                <span
                    class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">
                    ${post.createAt}
                </span>
                <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">${post.accessModifier}</span>
            </h4>
            <a style="cursor: pointer;"
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

    if (currentUserId == post.userId) {
        postContent += `<div class="card-body p-0 d-flex" style="cursor: pointer;">
                    <i
                        class="feather-trash-2 text-grey-500 me-3 font-lg">
                    </i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4" onclick ="DeleteThisPost('${post.postId}')">
                        Delete Post
                        <span
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                            Delete this post
                        </span
                        >
                    </h4>
                </div>
                <div class="card-body p-0 d-flex mt-2" style="border-bottom: 1px solid #dcdcdc; cursor: pointer;">
                    <i
                        class="feather-edit text-grey-500 me-3 font-lg">
                    </i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4" onclick ="UpdateThisPost('${post.postId}','${post.content}')" >Edit Post
                        <span
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                            Edit Post
                        </span
                        >
                    </h4>
                </div>`;
    }

    postContent += `
                <div class="card-body p-0 d-flex mt-2" style="cursor: pointer;">
                    <i
                        class="feather-bookmark text-grey-500 me-3 font-lg">
                    </i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">
                        Save this post
                        <span
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                            Save to your saved items
                        </span
                        >
                    </h4>
                </div>
                <div class="card-body p-0 d-flex mt-2" style="cursor: pointer;" onclick="HiddenPost('${post.postId}')">
                    <i
                        class="feather-x-square text-grey-500 me-3 font-lg">
                    </i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4" >
                        Hidden this post
                        <span
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                            Remove posts from your newsfeed
                        </span
                        >
                    </h4>
                </div>
                <div class="card-body p-0 d-flex mt-2" style="cursor: pointer;">
                    <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                    <h4 id="report-btn"
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
                ${post.content}
            </p>
        </div>
        <div class="card-body d-block p-0">
            <div class="row ps-2 pe-2">`;

    for (var j = 0, len = imageUrl.length; j < len; j++) {
        var url = imageUrl[j].lastIndexOf('.');
        var value = imageUrl[j].slice(url);
        if (value == ".mp4") {
            postContent += `<div class="col-xs-4 col-sm-4 p-2">
                    <a href="${imageUrl[j]}" data-lightbox="roadtrip">
                        <video controls with="300px" height="300px">
                            <source src="${imageUrl[j]}">
                        </video>
                    </a></div>`;
        }
        else {
            if (len == 1) {
                postContent += `<div class="">
                    <a href="${imageUrl[j]}" data-lightbox="roadtrip">
                        <img
                            src="${imageUrl[j]}"
                            style ="height: 100%"
                            class="rounded-3 w-100"
                            alt="image"/>
                    </a></div>`;
            } else {
                postContent += `<div class="col-xs-4 col-sm-4 p-1">
                    <a href="${imageUrl[j]}" data-lightbox="roadtrip">
                        <img
                            src="${imageUrl[j]}"
                            style ="height: 100%"
                            class="rounded-3 w-100"
                            alt="image"/>
                    </a></div>`;
            }
            
        }

    }


    postContent += `</div>
        </div>
         <div class="card-body mt-3" style="display: flex; justify-content: space-between; border-top: 1px solid #dcdcdc; padding: 10px 0 0;">
                            <a id="Like_${post.postId}" style="color: black; cursor: pointer;" onclick="LikePost('${post.postId}')">
                                <i class="feather-thumbs-up">
                                </i>
                                <span class="like-button-post">Like</span>
                            </a>
                            <a style="cursor: pointer;" onclick="cmtBoxFocus('${post.postId}')">
                                <i class="feather-message-square"></i>
                                <span > Comment</span>
                            </a>
                            <a style ="cursor: pointer;">
                                <i class="feather-share-2">
                                </i><span >Share</span>
                            </a>

                        </div>
                    <div class="chat-body" style="padding-top: 10px; border-top: 1px solid #dcdcdc;">
                                <div id="cmtContent_${post.postId}" class="messages-content">

                                </div>
                            </div>
                        <div id="cmtBox_${post.postId}" class="chat-bottom dark-bg shadow-none theme-dark-bg" style="width: 90%; padding: 15px 0; z-index: 0">
                           <div class="chat-form"  style="border: 5px">
                                <img src="${myAvatar}" alt="image" style="width: 35px; height: 35px; border-radius: 50px;">
                                <div style="display:inline-block; width: 80%;"><input  id="inputCmt_${post.postId}" type="text" placeholder="Start typing.." style="color:#000; border: 1px solid #dcdc"></div>
                                <button id="send_${post.postId}" onclick="NewComment('${post.postId}')" class="bg-current"><i class="ti-arrow-right text-white"></i></button>
                            </div>
                        </div>
                    </div>`;
    return postContent;
}

function cmtBoxFocus(id) {
    document.getElementById("inputCmt_" + id).focus();
    GetCmtlv1(id);
}

function GetCmtlv1(postId) {
    var cmtContent = '';
    var cmt = '';
    var username = '';
    var avatar = '';
    var myAvatar = '';
    $.ajax({
        url: "https://localhost:7131/v1/api/Comment/" + postId,
        method: 'GET',
        dataType: 'json',
        async: false,
        xhrFields: {
            withCredentials: true
        },
        success: function (comment) {
            for (var i = 0, len = comment.length; i < len; i++) {
                cmt = comment[i].content;
                $.ajax({
                    url: 'https://localhost:7131/v1/api/Users/' + comment[i].userId,
                    method: 'GET',
                    contentType: 'json',
                    dataType: 'json',
                    async: false,
                    xhrFields: {
                        withCredentials: true
                    },
                    success: function (user) {
                        username = user.fullName;
                        avatar = user.avatar;
                    },
                    error: function () {
                    }
                });
                $.ajax({
                    url: 'https://localhost:7131/v1/api/Users/' + currentUserId,
                    method: 'GET',
                    contentType: 'json',
                    dataType: 'json',
                    async: false,
                    xhrFields: {
                        withCredentials: true
                    },
                    success: function (me) {

                        myAvatar = me.avatar;
                    },
                    error: function () {
                    }
                });
                cmtContent += `
                    <div id="cmtlv1_${comment[i].commentId}" class="message-item" style="display: flex; flex-direction: column;">
                        <div style="display: flex; flex-direction: row">
                            <div class="message-user" style="display: inline-block">
                                <figure class="avatar">
                                    <img src="${avatar}" alt="image">
                                </figure>
                            </div>
                            <div style="display: inline-block; border-radius: 10px;padding: 5px;background: #f2f2f2;">
                                <a href="" style="color: #000; font-weight: bold; ">${username}</a>
                                <div style="font-size: 14px">
                                    ${cmt}
                                </div>
                            </div>
                            <a style="cursor: pointer;" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss">
                                </i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg" aria-labelledby="dropdownMenu2">`;
                if (comment[i].userId == currentUserId) {
                    cmtContent += `<div class="card-body p-0 d-flex mt-2" style="cursor: pointer;" onclick="Replycmt1Text('${comment[i].commentId}', '${cmt}')">
                                    <i class="feather-edit text-grey-500 me-3 font-lg">
                                    </i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">
                                        Edit this comment
                                        <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                                            Edit content of your comment
                                        </span>
                                    </h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2" style="cursor: pointer;" onclick="DeleteReplyCmt('${postId}', '${comment[i].commentId}')">
                                    <i class="feather-trash-2 text-grey-500 me-3 font-lg">
                                    </i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">
                                        Delete this comment
                                        <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                                            Delete your comment
                                        </span>
                                    </h4>
                                </div>`;
                }
                cmtContent += `
                                <div class="card-body p-0 d-flex mt-2" style="cursor: pointer;">
                                    <i class="feather-x-square text-grey-500 me-3 font-lg">
                                    </i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">
                                        Hidden this comment
                                        <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                                            Remove comment 
                                        </span>
                                    </h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2" style="cursor: pointer;">
                                    <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                                    <h4 id="report-btn" class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">
                                        Report this comment
                                        <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                                            Report if you see any problem
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: row; align-items: center;">
                            `+ CheckLikeCmt(comment[i].commentId) + `
                            <span style="margin-left: 10px; cursor: pointer" onclick="ReplyCmtlv1('${comment[i].commentId}')">Reply</span>
                        </div>
                        <div id="replyCmt_${comment[i].commentId}" class="replyCmtlv1" style="display: none; flex-direction: row; align-items: center; width: 30vw; margin-left: 50px;">
                            <div style="width: 90%;">
                                <div class="chat-form" style="border: 5px">
                                    <img src="${myAvatar}" alt="image" style="width: 35px; height: 35px; border-radius: 50px;">
                                        <div style="display:inline-block; width: 80%;"><input id="replyCmtInput_${comment[i].commentId}" type="text" placeholder="Start typing.." style="color:#000; border: 1px solid #dcdcdc"></div>
                                        <button id="replyCmtSend_${comment[i].commentId}" onclick="NewCommentReply1('${postId}','${comment[i].commentId}')" class="bg-current"><i class="ti-arrow-right text-white"></i></button>
                                        <button id="replyCmtEdit_${comment[i].commentId}" onclick="EditCommentReply1('${postId}', '${comment[i].commentId}')" style="display:none" class="bg-current"><i class="feather-edit text-white"></i></button>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column;  margin-left: 50px;">
                            `+ GetCmtlv2(postId, comment[i].commentId) + `
                        </div>
                    </div>`;
            }
            document.getElementById("cmtContent_" + postId).innerHTML = cmtContent;
        }
    });
}

function GetCmtlv2(postId, commentId) {
    var cmtContent = '';
    var cmt = '';
    var username = '';
    var avatar = '';
    var myAvatar = '';
    $.ajax({
        url: "https://localhost:7131/v1/api/Comment/" + postId + "/" + commentId,
        method: 'GET',
        dataType: 'json',
        async: false,
        xhrFields: {
            withCredentials: true
        },
        success: function (comment) {
            for (var i = 0, len = comment.length; i < len; i++) {
                cmt = comment[i].content;
                $.ajax({
                    url: 'https://localhost:7131/v1/api/Users/' + comment[i].userId,
                    method: 'GET',
                    contentType: 'json',
                    dataType: 'json',
                    async: false,
                    xhrFields: {
                        withCredentials: true
                    },
                    success: function (user) {
                        username = user.fullName;
                        avatar = user.avatar;
                    },
                    error: function () {
                        console.log("Loi user khi lay post " + post.userId);
                    }
                });
                $.ajax({
                    url: 'https://localhost:7131/v1/api/Users/' + currentUserId,
                    method: 'GET',
                    contentType: 'json',
                    dataType: 'json',
                    async: false,
                    xhrFields: {
                        withCredentials: true
                    },
                    success: function (me) {

                        myAvatar = me.avatar;
                    },
                    error: function () {
                        console.log("Loi user khi lay post " + post.userId);
                    }
                });
                cmtContent += `
                    <div id="cmtlv1_${comment[i].commentId}" class="message-item" style="display: flex; flex-direction: column;">
                        <div style="display: flex; flex-direction: row">
                            <div class="message-user" style="display: inline-block">
                                <figure class="avatar">
                                    <img src="${avatar}" alt="image">
                                </figure>
                            </div>
                            <div style="display: inline-block; border-radius: 10px;padding: 5px;background: #f2f2f2;">
                                <a href="" style="color: #000; font-weight: bold; ">${username}</a>
                                <div style="font-size: 14px">
                                    ${cmt}
                                </div>
                            </div>
                            <a style="cursor: pointer;" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ti-more-alt text-grey-900 btn-round-md bg-greylight font-xss">
                                </i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg" aria-labelledby="dropdownMenu2">`;
                if (comment[i].userId == currentUserId) {
                    cmtContent += `<div class="card-body p-0 d-flex mt-2" style="cursor: pointer;" onclick="Replycmt2Text('${comment[i].commentId}', '${cmt}')">
                                    <i class="feather-edit text-grey-500 me-3 font-lg">
                                    </i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">
                                        Edit this comment
                                        <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                                            Edit content of your comment
                                        </span>
                                    </h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2" style="cursor: pointer;" onclick="DeleteReplyCmt('${postId}', '${comment[i].commentId}')">
                                    <i class="feather-trash-2 text-grey-500 me-3 font-lg">
                                    </i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">
                                        Delete this comment
                                        <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                                            Delete your comment
                                        </span>
                                    </h4>
                                </div>`;
                }
                cmtContent += `
                                <div class="card-body p-0 d-flex mt-2" style="cursor: pointer;">
                                    <i class="feather-x-square text-grey-500 me-3 font-lg">
                                    </i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">
                                        Hidden this comment
                                        <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                                            Remove comment 
                                        </span>
                                    </h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2" style="cursor: pointer;">
                                    <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                                    <h4 id="report-btn" class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-4">
                                        Report this comment
                                        <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                                            Report if you see any problem
                                        </span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: row; align-items: center;">
                            `+ CheckLikeCmt(comment[i].commentId) + `
                            <span style="margin-left: 10px; cursor: pointer" onclick="ReplyCmtlv1('${comment[i].commentId}')">Reply</span>
                        </div>
                        <div id="replyCmt_${comment[i].commentId}" class="replyCmtlv1" style="display: none; flex-direction: row; width: 25vw;  margin-left: 50px;">
                            <div style="width: 90%;">
                                <div class="chat-form" style="border: 5px">
                                    <img src="${myAvatar}" alt="image" style="width: 35px; height: 35px; border-radius: 50px;">
                                        <div style="display:inline-block; width: 80%;"><input id="replyCmt2Input_${comment[i].commentId}" type="text" placeholder="Start typing.." style="color:#000; border: 1px solid #dcdcdc"></div>
                                        <button id="reply2CmtSend_${comment[i].commentId}" onclick="NewCommentReply2('${postId}', '${commentId}','${comment[i].commentId}')" class="bg-current"><i class="ti-arrow-right text-white"></i></button>
                                        <button id="reply2CmtEdit_${comment[i].commentId}" onclick="EditCommentReply2('${postId}', '${comment[i].commentId}')" style="display:none" class="bg-current"><i class="feather-edit text-white"></i></button>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: row; align-items: center; margin-left: 50px;">

                        </div>
                    </div>`;
            }

        }
    });
    return cmtContent;
}

function CheckLikeCmt(commentId) {
    var show = '';
    $.ajax({
        url: 'https://localhost:7131/v1/api/Like/comment/' + commentId,
        method: 'GET',
        contentType: 'json',
        dataType: 'json',
        async: false,
        xhrFields: {
            withCredentials: true,
        },
        error: function () {
            console.log("Loi like");
        },
        success: function (like) {
            var check = like.length;
            if (check > 0) {
                show = `<span id="Like_${commentId}" style="margin-left: 50px; cursor: pointer; color: blue; font-weight: bold;" onclick="LikePost('${commentId}')"><i class="feather-thumbs-up"></i>Like</span>`;
            }
            else {
                show = `<span id="Like_${commentId}" style="margin-left: 50px; cursor: pointer; color: black ; font-weight: normal;" onclick="LikePost('${commentId}')"><i class="feather-thumbs-up"></i>Like</span>`;
            }
        }
    });
    return show;
}

function NewComment(postId) {
    var contentInput = document.getElementById("inputCmt_" + postId).value;
    $.ajax({
        url: 'https://localhost:7131/v1/api/Comment/' + postId,
        method: 'POST',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        xhrFields: {
            withCredentials: true
        },
        data: JSON.stringify({
            content: contentInput,
            postId: postId,
            userId: currentUserId
        }),
        success: function () {
            GetCmtlv1(postId);
            document.getElementById("inputCmt_" + postId).value = "";
        },
        error: function (err) {
        }
    });
}

function NewCommentReply1(postId, commentId) {
    var contentInput = document.getElementById("replyCmtInput_" + commentId).value;
    $.ajax({
        url: 'https://localhost:7131/v1/api/Comment/' + postId + "/" + commentId,
        method: 'POST',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        xhrFields: {
            withCredentials: true
        },
        data: JSON.stringify({
            commentReply: commentId,
            content: contentInput,
            postId: postId,
            userId: currentUserId
        }),
        success: function () {
            GetCmtlv1(postId);
            document.getElementById("replyCmtInput_" + commentId).value = "";
            document.getElementById("replyCmt_" + commentId).style.display = "none";
        },
        error: function (err) {
        }
    });
}

function EditCommentReply1(postId, commentId) {
    var contentInput = document.getElementById("replyCmtInput_" + commentId).value;
    $.ajax({
        url: 'https://localhost:7131/v1/api/Comment/' + postId + "/" + commentId,
        method: 'PUT',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        xhrFields: {
            withCredentials: true
        },
        data: JSON.stringify({
            content: contentInput,
            postId: postId,
            userId: currentUserId
        }),
        success: function () {
            GetCmtlv1(postId);
            document.getElementById("replyCmtInput_" + commentId).value = "";
            document.getElementById("replyCmt_" + id).style.display = "none";

        },
        error: function (err) {
        }
    });
}

function Replycmt1Text(id, content) {
    document.getElementById("replyCmt_" + id).style.display = "flex";
    document.getElementById("replyCmtInput_" + id).value = content;
    document.getElementById("replyCmtSend_" + id).style.display = "none";
    document.getElementById("replyCmtEdit_" + id).style.display = "inline";

}

function NewCommentReply2(postId, commentId, commentText) {
    var contentInput = document.getElementById("replyCmt2Input_" + commentText).value;
    $.ajax({
        url: 'https://localhost:7131/v1/api/Comment/' + postId + "/" + commentId,
        method: 'POST',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        xhrFields: {
            withCredentials: true
        },
        data: JSON.stringify({
            commentReply: commentId,
            content: contentInput,
            postId: postId,
            userId: currentUserId
        }),
        success: function () {
            GetCmtlv1(postId);
            document.getElementById("replyCmt2Input_" + commentId).value = "";
            document.getElementById("replyCmt_" + id).style.display = "none";
        },
        error: function (err) {
        }
    });
}

function EditCommentReply2(postId, commentId) {
    var contentInput = document.getElementById("replyCmt2Input_" + commentId).value;
    $.ajax({
        url: 'https://localhost:7131/v1/api/Comment/' + postId + "/" + commentId,
        method: 'PUT',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        xhrFields: {
            withCredentials: true
        },
        data: JSON.stringify({
            content: contentInput,
            postId: postId,
            userId: currentUserId
        }),
        success: function () {
            GetCmtlv1(postId);
            document.getElementById("replyCmt2Input_" + commentId).value = "";
            document.getElementById("replyCmt_" + id).style.display = "none";

        },
        error: function (err) {
        }
    });
}

function Replycmt2Text(id, content) {
    document.getElementById("replyCmt_" + id).style.display = "flex";
    document.getElementById("replyCmt2Input_" + id).value = content;
    document.getElementById("reply2CmtSend_" + id).style.display = "none";
    document.getElementById("reply2CmtEdit_" + id).style.display = "inline";

}

function DeleteReplyCmt(postId, commentId) {
    $.ajax({
        url: 'https://localhost:7131/v1/api/Comment/' + postId + "/" + commentId,
        method: 'Delete',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        xhrFields: {
            withCredentials: true
        },
        success: function () {
            GetCmtlv1(postId);
        },
        error: function (err) {
        }
    });
}

function ReplyCmtlv1(id) {
    var replyDisplay = document.getElementById("replyCmt_" + id);
    if (replyDisplay.style.display == "none") {
        replyDisplay.style.display = "flex";
        document.getElementById("reply2CmtSend_" + id).style.display = "inline";
        document.getElementById("reply2CmtEdit_" + id).style.display = "none";
    }
    else {
        replyDisplay.style.display = "none";
    }
}

function NewPostText() {
    document.getElementById("modalInput").style.display = "flex";
    document.getElementById("testText").style.display = "flex";
}

function ClosePostText() {
    document.getElementById("postContent").value = '';
    document.getElementById("testText").style.display = "none";
    document.getElementById("modalInput").style.display = "none";
    imageList.length = 0;
    $(".preview").empty();
}

function NewPost() {
    var content = document.getElementById("postContent").value;
    var access = document.getElementById("selectType").value;
    $.ajax({
        url: 'https://localhost:7131/v2/api/Posts',
        method: 'POST',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        xhrFields: {
            withCredentials: true
        },
        data: JSON.stringify({
            postId: "string",
            createAt: "2023-04-22T07:38:12.161Z",
            content: content,
            accessModifier: access,
            postType: "string",
            userId: currentUserId
        }),
        success: function () {
            AddImagesToPost();
            ShowLoader();
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

function UpdateThisPost(postId, postContent) {
    NewPostText();
    document.getElementById("postButton").style.display = "none";
    document.getElementById("editButton").style.display = "block";
    document.getElementById("postContent").value = postContent;
    document.getElementById("editButton").addEventListener('click', () => {
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
                createAt: "2023-04-22T07:38:12.161Z",
                content: document.getElementById("postContent").value,
                accessModifier: document.getElementById("selectType").value,
                postType: "string",
                userId: currentUserId
            }),
            success: function () {
                ShowLoader();
            },
            error: function () {
                console.log("Loi");
            }

        });
    });

}

function DeleteThisPost(postId) {
    $.ajax({
        url: 'https://localhost:7131/v1/api/Comment/' + postId,
        method: "DELETE",
        async: false,
        xhrFields: {
            withCredentials: true
        },
        success: function () {
            console.log("ok");
        }
    });
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
                    ShowLoader();
                }
            });
        }
    });
}

ipnFileElement.addEventListener('change', function (e) {
    const files = e.target.files
    const file = files[0]
    const fileType = file['type']
    console.log(files[0])
    const fileReader = new FileReader()
    fileReader.readAsDataURL(file)

    fileReader.onload = function () {
        const url = fileReader.result
        if (!validImageTypes.includes(fileType)) {
            resultElement.insertAdjacentHTML(
                'beforeend',
                `<video controls width="100px" height="100px" class="preview-img">
            < source src = "${url}" >
            </video >`
            )
        }
        else {

            resultElement.insertAdjacentHTML(
                'beforeend',
                `<img src="${url}" alt="${file.name}"  class="preview-img"/>`
            )

        }
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
                    imageId: "string",
                    url: 'images/' + imageList[i],
                    type: 'string',
                    postId: idNewPost,
                }),
                success: function (data) {
                    console.log(idNewPost);
                },
                error: function () {
                    console.log("Loi nay");

                }
            });
        }
        imageList.length = 0;
        console.log(imageList)
    }

}


function ShowLoader() {
    ClosePostText();
    document.getElementById("modalSpinner").style.display = "flex";
    document.getElementById("loadingSrc").style.display = "flex";
    setTimeout(function () {
        document.getElementById("loadingSrc").style.display = "none";
        document.getElementById("modalSpinner").style.display = "none";
        GetNewFeed();
    }, 3000);
}

function HiddenPost(postId) {
    $.ajax({
        url: 'https://localhost:7131/v3/api/Newfeed/hidden/' + postId,
        method: 'POST',
        xhrFields: {
            withCredentials: true,
        },
        error: function () {
            console.log("Loi an post");
        },
        success: function () {
            GetNewFeed();
        }

    });
}

function LikePost(postId) {
    var Like = document.getElementById("Like_" + postId);
    if (Like.style.color == "black") {
        Like.style.color = "blue";
        Like.style.fontWeight = "bold";
    }
    else {
        Like.style.color = "black";
        Like.style.fontWeight = "normal";
    }
}

const uploadAvt = document.getElementById("upload-avatar");
uploadAvt.addEventListener('change', function () {
    
    var avtReader = new FileReader()
    avtReader.readAsDataURL(uploadAvt.files[0])

    avtReader.onload = function () {
        var imgUrl = avtReader.result
        $("#postInfor").empty();
        document.getElementById("avatarChange").src = imgUrl;
    }
    changeAvt = uploadAvt.files[0].name;
    imageList[0] = uploadAvt.files[0].name;
    
});

function NewAvt() {
    if (changeAvt == "") {
        CloseAvtText();
        return;
    }
    $.ajax({
        url: 'https://localhost:7131/v2/api/Posts',
        method: 'POST',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        xhrFields: {
            withCredentials: true
        },
        data: JSON.stringify({
            postId: "string",
            createAt: "2023-04-22T07:38:12.161Z",
            content: "Da thay doi anh dai dien",
            accessModifier: "public",
            postType: "string",
            userId: currentUserId
        }),
        success: function () {
            ChangeAvt();
            AddImagesToPost();
            CloseAvtText();
            ShowLoader();
            setTimeout(function () {
                document.getElementById("avatar").src = "/images/" + changeAvt;
            }, 3000);
            
        }
    });
}
function ChangeAvt() {
    $.ajax({
        url: 'https://localhost:7131/v1/api/users/changeAvatar/' + changeAvt,
        method: 'PUT',
        xhrFields: {
            withCredentials: true
        },
        success: function () {
        },
    });
}
function OpenAvtText() {
    document.getElementById("modalChangeAvt").style.display = "flex";
}
function CloseAvtText() {
    document.getElementById("modalChangeAvt").style.display = "none";
}
function OpenImgText() {
    document.getElementById("modalCoverImage").style.display = "flex";
}
function CloseImgText() {
    document.getElementById("modalCoverImage").style.display = "none";
}

let coverImg = '';
const uploadImg = document.getElementById("upload-img");
uploadImg.addEventListener('change', function () {

    var avtReader = new FileReader()
    avtReader.readAsDataURL(uploadImg.files[0])

    avtReader.onload = function () {
        var imgUrl = avtReader.result
        document.getElementById("coverImg").src = imgUrl;
    }
    
    coverImg = uploadImg.files[0].name;
    console.log(coverImg);
    imageList[0] = uploadImg.files[0].name;

});

function ChangeImage() {
    $.ajax({
        url: 'https://localhost:7131/v1/api/users/changeCoverImage/' + coverImg,
        method: 'PUT',
        xhrFields: {
            withCredentials: true
        },
        success: function () {
            document.getElementById("coverImage").src = "images/" + coverImg;
        },
    });
}

function NewImg() {
    if (coverImg == "") {
        CloseImgText();
        return;
    }
    $.ajax({
        url: 'https://localhost:7131/v2/api/Posts',
        method: 'POST',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        xhrFields: {
            withCredentials: true
        },
        data: JSON.stringify({
            postId: "string",
            createAt: "2023-04-22T07:38:12.161Z",
            content: "Da thay doi anh bia",
            accessModifier: "public",
            postType: "string",
            userId: currentUserId
        }),
        success: function () {
            ChangeImage();
            AddImagesToPost();
            CloseImgText();
            ShowLoader();
            

        }
    });
}