<?php
    require_once "Layout-Header.php";
?>
<!-- main content -->
    <div id="modalSpinner" class="modalHtd">
        <div id="loadingSrc">
            <div class="loader">
                <span>Loading...</span>
            </div>
        </div>
    </div>
    <div id="modalInput" class="modalHtd">
        <div id="testText">
            <div id="textInner" class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
                <div id="postTitle">
                    <span id="postTitleContent" style="font-weight: bold;">Create Post</span>
                    <i id="exitButton" class="btn-round-sm font-xs text-primary feather-x-circle me-2 bg-greylight" onclick="ClosePostText()" style="cursor: pointer">
                    </i>
                </div>
                <div id="postInfor">
                    <img id="avtPostText" src="~/images/astofol.png" class="postAvt">
                    <span>
                    <span id="postUser" style="display: block;  margin-right: 10px;">James Moriarty</span>
                    <select id="selectType">
                        <option value="public">Public</option>
                        <option value="private">Private</option>
                    </select>
                </span>
                </div>
                <div class="card-body p-0 mt-3 position-relative">
                <textarea id="postContent"
                          name="message"
                          class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-grey-500 fw-500 border-light-md theme-dark-bg"
                          cols="30"
                          rows="10"
                          placeholder="What's on your mind?"></textarea>
                </div>
                <div class="card-body d-flex p-0 mt-0" style="border-bottom: 3px">
                    <label class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4">
                        <i class="font-md text-success feather-image me-2"></i>
                        <span class="d-none-xs" style="cursor: pointer">Photo/Video</span>
                        <input type="file" name="photo" id="upload-photo" class="upload-photo" />
                    </label>
                    <label class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4">
                        <i class="font-md text-danger feather-video me-2">
                        </i><span class="d-none-xs">Live Video</span>
                    </label>
                    <label class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4">
                        <i class="font-md text-warning feather-camera me-2">
                        </i><span class="d-none-xs">Feeling/Activity</span>
                    </label>
                </div>
                <div id="showImage" class="preview" style="display: flex"></div>
                <button onclick="NewPost()" id="postButton" style="display: block" type="button" class="btn btn-primary">Post</button>
                <button id="editButton" style="display: none" type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
    <div id="modalChangeAvt" class="modalHtd">
        <div id="changeAvt">
            <div id="textInner" class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
                <div id="postTitle">
                    <span id="postTitleContent" style="font-weight: bold;">Change Avatar</span>
                    <i id="exitButton" class="btn-round-sm font-xs text-primary feather-x-circle me-2 bg-greylight" onclick="CloseAvtText()" style="cursor: pointer">
                    </i>
                </div>
                <div id="postInfor" style="display: flex; align-items: center; justify-content: center;">
                    <img id="avatarChange" src="~/images/female-profile.png" class="postAvt">
                </div>
                <div class="card-body " style="margin: 10px; display: flex; align-items: center; justify-content: center;">
                    <label class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4" style="background: #dcdcdc; border-radius: 10px; padding: 5px;">
                        <i class="font-md text-success feather-image me-2"></i>
                        <span class="d-none-xs" style="cursor: pointer">Photo</span>
                        <input type="file" name="photo" id="upload-avatar" class="upload-photo" />
                    </label>
                </div>
                <div id="showImage" class="preview" style="display: flex"></div>
                <button onclick="NewAvt()" id="avtButton" style="display: block" type="button" class="btn btn-primary">Change</button>
            </div>
        </div>
    </div>
    <div id="modalCoverImage" class="modalHtd">
        <div id="changeImg">
            <div id="textInner" class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
                <div id="postTitle">
                    <span id="postTitleContent" style="font-weight: bold;">Change Cover Image</span>
                    <i id="exitButton" class="btn-round-sm font-xs text-primary feather-x-circle me-2 bg-greylight" onclick="CloseImgText()" style="cursor: pointer">
                    </i>
                </div>
                <div  style="display: flex; align-items: center; justify-content: center;">
                    <div class="card-body h250 rounded-xxl overflow-hidden m-3" style="position: relative; padding-bottom:50px;">
                        <img id="coverImg" src="images/u-bg.jpg" alt="image" style="border-radius: 20px; width: 60vw; height: 30vh">
                        <figure class="avatar position-absolute w100 z-index-1" style="bottom:-20px; left: 3vw;">
                            <img style="width:75px; height:100px; border-radius:50px;" id="avatar1" src="images/anhdep.png" alt="image" class="float-right p-1 bg-white rounded-circle w-100" onclick="OpenAvtText()">
                        </figure>
                    </div>
                </div>
                <div class="card-body " style="display: flex; align-items: center; justify-content: center;">
                    <label class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4" style="background: #dcdcdc; border-radius: 10px; padding: 5px;">
                        <i class="font-md text-success feather-image me-2"></i>
                        <span class="d-none-xs" style="cursor: pointer">Photo</span>
                        <input type="file" name="photo" id="upload-img" class="upload-photo" />
                    </label>
                </div>
                <button onclick="NewImg()" id="avtButton" style="display: block" type="button" class="btn btn-primary">Change</button>
            </div>
        </div>
    </div>
    <div class="main-content right-chat-active ">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card w-100 border-0 p-0 bg-white shadow-xss rounded-xxl">
                            <div class="card-body h250 p-0 rounded-xxl overflow-hidden m-3">
                                <img id="coverImage" src="images/u-bg.jpg" alt="image" onclick="OpenImgText()" style="width: 60vw; height: 30vh;">
                            </div>
                            <div class="card-body p-0 position-relative">
                                <a href="#" class="hover">
                                    <figure class="avatar position-absolute w100 z-index-1" style="top:-40px; left: 30px;">
                                        <img style="width:75px; height:100px; border-radius:50px;" id="avatar" src="images/female-profile.png" alt="image" class="float-right p-1 bg-white rounded-circle w-100" onclick="OpenAvtText()">
                                    </figure>
                                </a>
                                <h4 id="nameuser" class="fw-700 font-sm mt-2 mb-lg-5 mb-4 pl-15"><span id="usermail" class="fw-500 font-xssss text-grey-500 mt-1 mb-3 d-block">support@gmail.com</span></h4>
                                <div class="d-flex align-items-center justify-content-center position-absolute-md right-15 top-0 me-2">
                                    <a style="cursor:pointer;background-color:green; margin-right:10px" id="block" class="p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">Block</a>
                                    <a style="cursor:pointer;background-color:green; margin-right:10px" id="follow" class="p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">Follow</a>
                                    <a style="cursor:pointer;background-color:green" id="addfriend" class="p-3 z-index-1 rounded-3 text-white font-xsssss text-uppercase fw-700 ls-3">Add Friend</a>
                                    <a id="message" href="#" class="bg-greylight btn-round-lg ms-2 rounded-3 text-grey-700">
                                        <i class="feather-mail font-md"></i>
                                    </a>
                                    <a href="#" id="dropdownMenu4" class="d-none d-lg-block bg-greylight btn-round-lg ms-2 rounded-3 text-grey-700" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="ti-more font-md tetx-dark"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end p-4 rounded-xxl border-0 shadow-lg" aria-labelledby="dropdownMenu4">
                                        <div class="card-body p-0 d-flex">
                                            <i class="feather-bookmark text-grey-500 me-3 font-lg"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-0">Save Link <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Add this to your saved items</span></h4>
                                        </div>
                                        <div class="card-body p-0 d-flex mt-2">
                                            <i class="feather-alert-circle text-grey-500 me-3 font-lg"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-0">Hide Post <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
                                        </div>
                                        <div class="card-body p-0 d-flex mt-2">
                                            <i class="feather-alert-octagon text-grey-500 me-3 font-lg"></i>
                                            <h4 class="fw-600 text-grey-900 font-xssss mt-0 me-0">Hide all from Group <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
                                        </div>
                                        <div class="card-body p-0 d-flex mt-2">
                                            <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                                            <h4 class="fw-600 mb-0 text-grey-900 font-xssss mt-0 me-0">Unfollow Group <span class="d-block font-xsssss fw-500 mt-1 lh-3 text-grey-500">Save to your saved items</span></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body d-block w-100 shadow-none mb-0 p-0 border-top-xs">
                                <ul class="nav nav-tabs h55 d-flex product-info-tab border-bottom-0 ps-4" id="pills-tab" role="tablist">
                                    <li class="active list-inline-item me-5">
                                        <a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block active" href="#navtabs1" data-toggle="tab">About</a>
                                    </li>
                                    <li class="list-inline-item me-5">
                                        <a href="Friend.php" class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block">Membership</a>
                                    </li>
                                    <li class="list-inline-item me-5">
                                        <a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs3" data-toggle="tab">Discussion</a>
                                    </li>
                                    <li class="list-inline-item me-5">
                                        <a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs4" data-toggle="tab">Video</a>
                                    </li>
                                    <li class="list-inline-item me-5">
                                        <a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs3" data-toggle="tab">Group</a>
                                    </li>
                                    <li class="list-inline-item me-5">
                                        <a class="fw-700 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs1" data-toggle="tab">Events</a>
                                    </li>
                                    <li class="list-inline-item me-5">
                                        <a class="fw-700 me-sm-5 font-xssss text-grey-500 pt-3 pb-3 ls-1 d-inline-block" href="#navtabs7" data-toggle="tab">Media</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-xxl-3 col-lg-4 pe-0">

                        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                            <div class="card-body d-block p-4">
                                <h4 class="fw-700 mb-3 font-xsss text-grey-900">About</h4>
                                <p id="aboutme" class="fw-500 text-grey-500 lh-24 font-xssss mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi nulla dolor, ornare at commodo non, feugiat non nisi. Phasellus faucibus mollis pharetra. Proin blandit ac massa sed rhoncus</p>
                            </div>
                            <div class="card-body border-top-xs d-flex">
                                <i class="feather-lock text-grey-500 me-3 font-lg"></i>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-0">Private <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">What's up, how are you?</span></h4>
                            </div>

                            <div class="card-body d-flex pt-0">
                                <i class="feather-eye text-grey-500 me-3 font-lg"></i>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-0">Visble <span class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500">Anyone can find you</span></h4>
                            </div>
                            <div class="card-body d-flex pt-0">
                                <i class="feather-map-pin text-grey-500 me-3 font-lg"></i>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-1">Flodia, Austia </h4>
                            </div>
                            <div class="card-body d-flex pt-0">
                                <i class="feather-users text-grey-500 me-3 font-lg"></i>
                                <h4 class="fw-700 text-grey-900 font-xssss mt-1">Genarel Group</h4>
                            </div>
                        </div>
                        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                            <div class="card-body d-flex align-items-center  p-4">
                                <h4 class="fw-700 mb-0 font-xssss text-grey-900">Photos</h4>
                                <a href="#" class="fw-600 ms-auto font-xssss text-primary">See all</a>
                            </div>
                            <div class="card-body d-block pt-0 pb-2">
                                <div id="allimages" class="row">

                                </div>
                            </div>
                            <div class="card-body d-block w-100 pt-0">
                                <a href="#" class="p-2 lh-28 w-100 d-block bg-grey text-grey-800 text-center font-xssss fw-700 rounded-xl"><i class="feather-external-link font-xss me-2"></i> More</a>
                            </div>
                        </div>

                        <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                        </div>
                    </div>
                    <div class="col-xl-8 col-xxl-9 col-lg-8">
                        <div class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
                            <div class="card-padding>
                            <i class="btn-round-sm font-xs text-primary feather-edit-3 me-2 bg-greylight"></i>Create Post
                        </div>
                        <div class="card-body p-0 mt-3 position-relative" onclick="NewPostText()">
                            <div id="createPost">
                                <p style="padding:10px">What's on your mind?</p>
                            </div>
                        </div>
                    </div>

                    <div id='PostList'></div>

                    <div id="ModalBlock" class="modal">
                        <!-- Modal Block content -->
                        <div style="width:20%" class="modal-content">
                            <p id="notifyBlock" style="margin:0 auto">Do you want block</p>
                            <button id="confirmBlock" style="width:50%;margin:0 auto" type="button" class="btn btn-success">Yes</button>
                            <button id="cancleBlock" style="width:50%;margin:0 auto" type="button" class="btn btn-danger">No</button>
                        </div>
                    </div>
                    <div id="ModalFriend" class="modal">
                        <!-- Modal Friend content -->
                        <div style="width:20%" class="modal-content">
                            <p id="notifyFriend" style="margin:0 auto">Do you want cancle friend request</p>
                            <button id="confirmFriend" style="width:50%;margin:0 auto" type="button" class="btn btn-success">Yes</button>
                            <button id="cancleFriend" style="width:50%;margin:0 auto" type="button" class="btn btn-danger">No</button>
                        </div>
                    </div>
                    <div id="ModalResponseFriend" class="modal">
                        <!-- Modal Response Friend content -->
                        <div style="width:20%" class="modal-content">
                            <p id="notifyResponseFriend" style="margin:0 auto">Response friend request</p>
                            <button id="acceptrequest" style="width:50%;margin:0 auto" type="button" class="btn btn-success">Accept</button>
                            <button id="rejectrequest" style="width:50%;margin:0 auto" type="button" class="btn btn-danger">Reject</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </div>
</div>


<!-- main content -->
<?php
    require "Layout-Footer.php";
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!--<script src="assets/phong/phongProfile.js"></script>-->
<!--<script src="/assets/htd/profile.js"></script>-->
<script src="public/js/plugin.js"></script>
<script src="public/js/lightbox.js"></script>
<script src="public/js/scripts.js"></script>
<!--<script src="/assets/htd/contact.js"></script>-->
</body>

</html>
<!--<script src="/assets/phong/phongLayoutSocial.js"></script>-->