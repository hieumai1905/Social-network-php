const currentUserId = $("#userCurrent").text();
const ipnFileElement = document.querySelector('#upload-photo')
const resultElement = document.querySelector('#showImage')
const validImageTypes = ['image/gif', 'image/jpeg', 'image/png']
let imageList = [];
let postJustCreate = '';
let myFullName = '';
let myAvatar = '';
$(document).ready(function () {
    GetInforUser();
    GetNewFeed();
    imageList.length = 0;
});

function GetInforUser() {
    $.ajax({
        url: 'http://localhost:8080/api/users/' + currentUserId,
        method: 'GET',
        contentType: 'application/json',
        dataType: 'json',
        success: function (user) {
            console.log('ok');
            console.log(user);
            myFullName = user.data.fullName;
            myAvatar = 'public/images/' + user.data.avatar;
            $('#avtPostText').attr('src', myAvatar);
            $('#postUser').text(myFullName);
        },
        error: function(){
            console.log('faild in user api');
        }
    });
}

function GetNewFeed() {
    $.ajax({
        url: 'http://localhost:8080/api/post/home',
        method: 'GET',
        contentType: 'application/json',
        dataType: 'json',
        error: function (post){
            console.log("Loi bai viet");
        },
        success: function (post) {
            console.log(post);
            console.log(myAvatar);
            var newfeed = '';
            for (var i = 0, len = post.data.length; i < len; i++) {
                newfeed += CreatePost(post.data[i]);
            }
            $('#PostList').html(newfeed);
        }
    });
}

function CreatePost(post) {
    var postContent = '';
    var username = '';
    var avatar = '';
    var imageUrl = [];
    var favor = '';
    $.ajax({
        url: 'http://localhost:8080/api/users/' + post.userId,
        method: 'GET',
        contentType: 'application/json',
        dataType: 'json',
        async: false,
        success: function (user) {
            console.log(user);
            username = user.data.fullName;
            avatar = 'public/images/' + user.data.avatar;
            console.log(avatar);
            console.log(username);
        },
        error: function () {
            console.log("Loi user khi lay post " + post.userId);
        }
    });

    $.ajax({
        url: 'http://localhost:8080/api/media/post/' + post.postId,
        method: 'GET',
        contentType: 'application/json',
        dataType: 'json',
        async: false,
        success: function (image) {
            for (var i = 0, len = image.data.length; i < len; i++) {
                console.log(image.data[i].url);
                imageUrl.push('public/images/' + image.data[i].url);
            }
        },
        error: function () {
            console.log("Loi user khi lay anh ");
        }
    });

    $.ajax({
        url: 'http://localhost:8080/api/favorite/' + post.postId,
        dataType: 'json',
        contentType: 'application/json',
        async: false,
        success: function(favorite){
            console.log(favorite);
            if (favorite.data[0].postId == null){
                favor = `<div class="card-body p-0 d-flex mt-2" style="cursor: pointer" onclick="SaveThisPost('${post.postId}')" ')">
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
                </div>`;
            }
            else {
                favor = `<div class="card-body p-0 d-flex mt-2" style="cursor: pointer" onclick="UnsaveThisPost('${post.postId}')"')">
                    <i
                        class="feather-x-circle text-grey-500 me-3 font-lg">
                    </i>
                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">
                        Unsave this post
                        <span
                            class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                            UnSave from your saved items
                        </span
                        >
                    </h4>
                </div>`;
            }
        },
        error: function(err) {
            console.log(err, "lỗi lấy bài ưu thích");
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
        postContent += favor;

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
    else{
        postContent +=`
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
                <div class="card-body p-0 d-flex mt-2" style="cursor: pointer" onclick="ReportPost('${post.postId}')">
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
                </div>`;
    }
    postContent += `
                
            </div>
        </div>
        <div class="card-body p-0 me-lg-5">
            <p class="fw-500 text-black-500 lh-26 w-100" style="font-size: 1.2rem;">
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
                        <div id="cmtBox_${post.postId}" class="chat-bottom dark-bg shadow-none theme-dark-bg" style="width: 90%; padding: 15px 0;">
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
    document.getElementById("inputCmt_"+id).focus();
    GetCmtlv1(id);
}

function GetCmtlv1(postId) {
    var cmtContent = '';
    var cmt = '';
    var username = '';
    var avatar = '';
    $.ajax({
        url: "http://localhost:8080/api/comment/" + postId,
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function (comment) {
            for (var i = 0, len = comment.data.length; i < len; i++) {
                cmt = comment.data[i].content;
                $.ajax({
                    url: 'http://localhost:8080/api/users/' + comment.data[i].userId,
                    method: 'GET',
                    contentType: 'json',
                    dataType: 'json',
                    async: false,
                    success: function (user) {
                        console.log(user);
                        username = user.data.fullName;
                        avatar = 'public/images/' + user.data.avatar;
                    },
                    error: function () {
                        console.log('Error cho cmt')
                    }
                });
                cmtContent += `
                    <div id="cmtlv1_${comment.data[i].commentId}" class="message-item" style="display: flex; flex-direction: column;">
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
                if (comment.data[i].userId == currentUserId) {
                    cmtContent += `<div class="card-body p-0 d-flex mt-2" style="cursor: pointer;" onclick="Replycmt1Text('${comment.data[i].commentId}', '${cmt}')">
                                    <i class="feather-edit text-grey-500 me-3 font-lg">
                                    </i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">
                                        Edit this comment
                                        <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                                            Edit content of your comment
                                        </span>
                                    </h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2" style="cursor: pointer;" onclick="DeleteCmt('${postId}', '${comment.data[i].commentId}')">
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
                            <a id="Like_cmt1_${comment.data[i].commentId}" style="color: black; cursor: pointer;" onclick="LikePost('cmt1_${comment.data[i].commentId}')">
                                <i class="feather-thumbs-up">
                                </i>
                                <span class="like-button-post">Like</span>
                            </a>
                            <span style="margin-left: 10px; cursor: pointer" onclick="ReplyCmtlv1('${comment.data[i].commentId}')">Reply</span>
                        </div>
                        <div id="replyCmt_${comment.data[i].commentId}" class="replyCmtlv1" style="display: none; flex-direction: row; align-items: center; width: 30vw; margin-left: 50px;">
                            <div style="width: 90%;">
                                <div class="chat-form" style="border: 5px">
                                    <img src="${myAvatar}" alt="image" style="width: 35px; height: 35px; border-radius: 50px;">
                                        <div style="display:inline-block; width: 80%;"><input id="replyCmtInput_${comment.data[i].commentId}" type="text" placeholder="Start typing.." style="color:#000; border: 1px solid #dcdcdc"></div>
                                        <button id="replyCmtSend_${comment.data[i].commentId}" onclick="NewCommentReply1('${postId}','${comment.data[i].commentId}')" class="bg-current"><i class="ti-arrow-right text-white"></i></button>
                                        <button id="replyCmtEdit_${comment.data[i].commentId}" onclick="EditCommentReply1('${postId}','${comment.data[i].commentId}')" style="display:none" class="bg-current"><i class="feather-edit text-white"></i></button>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: column;  margin-left: 50px;">
                            `+ GetCmtlv2(postId, comment.data[i].commentId) +`
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
    $.ajax({
        url: "http://localhost:8080/api/comment/reply/" + commentId,
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function (comment) {
            for (var i = 0, len = comment.data.length; i < len; i++) {
                cmt = comment.data[i].content;
                $.ajax({
                    url: 'http://localhost:8080/api/users/' + comment.data[i].userId,
                    method: 'GET',
                    contentType: 'json',
                    dataType: 'json',
                    async: false,
                    success: function (user) {
                        username = user.data.fullName;
                        avatar = 'public/images/' + user.data.avatar;
                    },
                    error: function () {
                        console.log("Loi user khi lay cmtreply " + comment.data[i].userId);
                    }
                });
                cmtContent += `
                    <div id="cmtlv2_${comment.data[i].commentReplyId}" class="message-item" style="display: flex; flex-direction: column;">
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
                if (comment.data[i].userId == currentUserId) {
                    cmtContent += `<div class="card-body p-0 d-flex mt-2" style="cursor: pointer;" onclick="Replycmt2Text('${comment.data[i].commentReplyId}', '${cmt}')">
                                    <i class="feather-edit text-grey-500 me-3 font-lg">
                                    </i>
                                    <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-4">
                                        Edit this comment
                                        <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">
                                            Edit content of your comment
                                        </span>
                                    </h4>
                                </div>
                                <div class="card-body p-0 d-flex mt-2" style="cursor: pointer;" onclick="DeleteReplyCmt('${postId}', '${comment.data[i].commentReplyId}')">
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
                            <a id="Like_cmt2_${comment.data[i].commentReplyId}" style="color: black; cursor: pointer;" onclick="LikePost('cmt2_${comment.data[i].commentReplyId}')">
                                <i class="feather-thumbs-up">
                                </i>
                                <span class="like-button-post">Like</span>
                            </a>
                            <span style="margin-left: 10px; cursor: pointer" onclick="ReplyCmtlv2('${comment.data[i].commentReplyId}')">Reply</span>
                        </div>
                        <div id="replyCmt1_${comment.data[i].commentReplyId}" class="replyCmtlv1" style="display: none; flex-direction: row; width: 25vw;  margin-left: 50px;">
                            <div style="width: 90%;">
                                <div class="chat-form" style="border: 5px">
                                    <img src="${myAvatar}" alt="image" style="width: 35px; height: 35px; border-radius: 50px;">
                                        <div style="display:inline-block; width: 80%;"><input id="replyCmt2Input_${comment.data[i].commentReplyId}" type="text" placeholder="Start typing.." style="color:#000; border: 1px solid #dcdcdc"></div>
                                        <button id="reply2CmtSend_${comment.data[i].commentReplyId}" onclick="NewCommentReply2('${postId}','${commentId}','${comment.data[i].commentReplyId}')" class="bg-current"><i class="ti-arrow-right text-white"></i></button>
                                        <button id="reply2CmtEdit_${comment.data[i].commentReplyId}" onclick="EditCommentReply2('${postId}','${commentId}','${comment.data[i].commentReplyId}')" style="display:none" class="bg-current"><i class="feather-edit text-white"></i></button>
                                </div>
                            </div>
                        </div>
                        <div style="display: flex; flex-direction: row; align-items: center; margin-left: 50px;">

                        </div>
                    </div>`;
            }
        },
        error: function(){
            console.log('Loi cmtlv 2');
        }
    });
    return cmtContent;
}

function NewComment(postId) {
    var contentInput = document.getElementById("inputCmt_" + postId).value;
    if (contentInput == ''){
        return;
    }
    $.ajax({
        url: 'http://localhost:8080/api/comment',
        method: 'POST',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify({
            commentId: 'I dont wanna continue',
            commentAt: 'now is 2:00 AM, i need go to sleep',
            content: contentInput,
            postId: postId,
            userId: currentUserId
        }),
        success: function () {
            ShowLoader();
            GetCmtlv1(postId);
            document.getElementById("inputCmt_" + postId).value = "";
        },
        error: function (err) {
        }
    });
}

function NewCommentReply1(postId, commentId) {
    var contentInput = document.getElementById("replyCmtInput_"+ commentId).value;
    if (contentInput == ''){
        return;
    }
    $.ajax({
        url: 'http://localhost:8080/api/comment/reply',
        method: 'POST',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify({
            commentReplyId: 'nobody know',
            replyAt: 'iwannacry',
            content: contentInput,
            userId: currentUserId,
            commentId: commentId
        }),
        success: function () {
            ShowLoader();
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
        url: 'http://localhost:8080/api/comment',
        method: 'PUT',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify({
            commentId: commentId,
            commentAt: 'many bug',
            content: contentInput,
            postId: 'hu hu',
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

function Replycmt1Text(id, content) {
    document.getElementById("replyCmt_" + id).style.display = "flex";
    document.getElementById("replyCmtInput_" + id).value = content;
    document.getElementById("replyCmtSend_" + id).style.display = "none";
    document.getElementById("replyCmtEdit_" + id).style.display = "inline";

}

function NewCommentReply2(postId, commentId, commentReplyId) {
    var contentInput = document.getElementById("replyCmt2Input_"+ commentReplyId).value;
    if (contentInput == ''){
        return;
    }
    $.ajax({
        url: 'http://localhost:8080/api/comment/reply',
        method: 'POST',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify({
            commentReplyId: 'nobody know',
            replyAt: 'iwannacry',
            content: contentInput,
            userId: currentUserId,
            commentId: commentId
        }),
        success: function () {
            ShowLoader();
            GetCmtlv1(postId);
            document.getElementById("replyCmt2Input_" + commentId).value = "";
            document.getElementById("replyCmt1_" + commentReplyId).style.display = "none";
        },
        error: function (err) {
        }
    });
}

function EditCommentReply2(postId, commentId, commentReplyId) {
    var contentInput = document.getElementById("replyCmt2Input_" + commentReplyId).value;
    $.ajax({
        url: 'http://localhost:8080/api/comment/reply',
        method: 'PUT',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        xhrFields: {
            withCredentials: true
        },
        data: JSON.stringify({
            commentReplyId: commentReplyId,
            replyAt: 'iwannacry',
            content: contentInput,
            userId: currentUserId,
            commentId: commentId
        }),
        success: function () {
            GetCmtlv1(postId);
            document.getElementById("replyCmt2Input_" + commentReplyId).value = "";
            document.getElementById("replyCmt1_" + commentReplyId).style.display = "none";

        },
        error: function (err) {
        }
    });
}

function Replycmt2Text(id, content) {
    document.getElementById("replyCmt1_" + id).style.display = "flex";
    document.getElementById("replyCmt2Input_" + id).value = content;
    document.getElementById("reply2CmtSend_" + id).style.display = "none";
    document.getElementById("reply2CmtEdit_" + id).style.display = "inline";
    
}
function DeleteCmt(postId, commentId) {
    if (confirm('Bạn có chắc muốn xoá bình luận này không?') == false) return;
    $.ajax({
        url: 'http://localhost:8080/api/comment/' + commentId,
        method: 'DELETE',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        success: function () {
            GetCmtlv1(postId);
        },
        error: function (err) {
            console.log(err, 'Khong xoa duoc nay');
        }
    });
}

function DeleteReplyCmt(postId, commentReplyId) {
    if (confirm('Bạn có chắc muốn xoá bình luận này không?') == false) return;
    $.ajax({
        url: 'http://localhost:8080/api/comment/reply/' + commentReplyId,
        method: 'DELETE',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        success: function () {
            GetCmtlv1(postId);
        },
        error: function (err) {
            console.log(err, 'Khong xoa duoc nay');
        }
    });
}

function ReplyCmtlv1(id) {
    var replyDisplay = document.getElementById("replyCmt_" + id);
    if (replyDisplay.style.display == "none") {
        replyDisplay.style.display = "flex";
        document.getElementById("replyCmtSend_" + id).style.display = "inline";
        document.getElementById("replyCmtEdit_" + id).style.display = "none";
    }
    else {
        replyDisplay.style.display = "none";
        document.getElementById("replyCmtInput_"+ id).value = '';
    }
}
function ReplyCmtlv2(id) {
    var replyDisplay = document.getElementById("replyCmt1_" + id);
    if (replyDisplay.style.display == "none") {
        replyDisplay.style.display = "flex";
        document.getElementById("reply2CmtSend_" + id).style.display = "inline";
        document.getElementById("reply2CmtEdit_" + id).style.display = "none";
    }
    else {
        replyDisplay.style.display = "none";
        document.getElementById("replyCmt2Input_"+ id).value = '';
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
    var content = $('#postContent').val();
    var access = $("#selectType").val();
    if (content == '' && imageList.length == 0) {
        ClosePostText();
    }
    $.ajax({
        url: 'http://localhost:8080/api/post',
        method: 'POST',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify({
            postId: "string",
            createAt: "string",
            content: content,
            accessModifier: access,
            postType: "POST",
            userId: currentUserId
        }),
        success: function () {
            AddImagesToPost();
            ShowLoader();
            GetNewFeed();
        },
        error: function (err) {
            if (err.status == 400)
                alert("Bài viết của bạn có những từ ngữ nhạy cảm, xúc phạm hoặc gây hiểu lầm");
            // if (err.status == 403)
            //     alert("Tài khoản của bạn đã bị ban do vi phạm điều khoản cộng đồng của chúng tôi");
            $('#createPost').val("");
        }
    });

}

function UpdateThisPost(postId, postContent) {
    NewPostText();
    document.getElementById("postButton").style.display = "none";
    document.getElementById("editButton").style.display = "block";
    document.getElementById("postContent").value = postContent;
    document.getElementById("editButton").addEventListener('click', () =>{
        $.ajax({
            url: 'http://localhost:8080/api/post',
            method: 'PUT',
            dataType: 'json',
            contentType: "application/json; charset=utf-8",

            data: JSON.stringify({
                postId: postId,
                createAt: "2023-04-22T07:38:12.161Z",
                content: document.getElementById("postContent").value,
                accessModifier: document.getElementById("selectType").value,
                postType: "POST",
                userId: currentUserId
            }),
            success: function () {
                ShowLoader();
                GetNewFeed();
            },
            error: function () {
                console.log("Loi");
            }
            
        });
    });

}

function DeleteThisPost(postId) {
    if (confirm('Bạn có chắc muốn xoá bài viết này không?') == false) return;
    $.ajax({
        url: 'http://localhost:8080/api/post/' + postId,
        method: "DELETE",
        async: false,
        success: function () {
            console.log("Xoá đc nhé");
            ShowLoader();
            GetNewFeed();
        },
        error: function(error){
            console.log(error,"Lỗi r");
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
            url: 'http://localhost:8080/api/post/profile/' + currentUserId,
            method: 'GET',
            contentType: 'application/json',
            dataType: 'json',
            async: false,
            success: function (post) {
                idNewPost = post.data[0].postId;
                console.log(idNewPost);
            }
        });
    }

    if (imageList.length > 0) {
        for (var i = 0, len = imageList.length; i < len; i++) {
            console.log(imageList[i])
            $.ajax({
                url: 'http://localhost:8080/api/media/post',
                method: 'POST',
                async: false,
                dataType: 'json',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    imageId: "string",
                    url: imageList[i],
                    type: 'IMAGE',
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

function LikePost(Id) {
    var Like = document.getElementById("Like_" + Id);
    if (Like.style.color == "black") {
        Like.style.color = "blue";
        Like.style.fontWeight = "bold";
    }
    else {
        Like.style.color = "black";
        Like.style.fontWeight = "normal";
    }
}

function ShowLoader() {
    ClosePostText();
    document.getElementById("modalSpinner").style.display = "flex";
    document.getElementById("loadingSrc").style.display = "flex";
    setTimeout(function () {
        document.getElementById("loadingSrc").style.display = "none";
        document.getElementById("modalSpinner").style.display = "none";
    } ,3000);

}
function HiddenPost(postId) {
    if (confirm('Bạn có chắc muốn ẩn bài viết này không?') == false) return;
    $.ajax({
        url: 'http://localhost:8080/api/hidden/' + postId,
        method: 'POST',
        error: function (error) {
            console.log(error, "Loi an post");
        },
        success: function () {
            ShowLoader
            GetNewFeed();
        }
    });
}

function SaveThisPost(postId){
    $.ajax({
        url: 'http://localhost:8080/api/favorite/' + postId,
        method: 'POST',
        error: function () {
            console.log("Loi an post");
        },
        success: function () {
            ShowLoader();
            GetNewFeed();
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
            GetNewFeed();
        }

    });
}

function ReportPost(postId) {
    var content = prompt('Lí do bạn báo cáo bài viết này:', 'Đừng report mà, hãy liên hệ với nhà phát triển để lấy kẹo nhé');
    if (content == null || content == '')
        return;
    $.ajax({
        url: 'http://localhost:8080/api/report',
        method: 'POST',
        dataType: 'json',
        contentType: "application/json; charset=utf-8",
        data: JSON.stringify({
            userId: currentUserId,
            postId: postId,
            content: content,
            type: 'REPORT'
        }),
        error: function (error) {
            console.log(error, "Loi report post");
        },
        success: function () {
            ShowLoader
            GetNewFeed();
        }
    });
}