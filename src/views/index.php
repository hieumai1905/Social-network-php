Î<?php
require_once "Layout-Header.php";

echo '<div id="userCurrent" type="hidden">'.unserialize($_SESSION['user-login'])->getUserId().'</div>';
?>
<!-- main content -->
<div id="modalSpinner" class="modalHtd">
    <div id="loadingSrc">
        <div class="loader">
            <span>Loading...</span>
        </div>
    </div>
</div>
<div id="modalInput" class="modalHtd" >
    <div id="testText">
        <div id="textInner" class="card w-100 shadow-xss rounded-xxl border-0 ps-4 pt-4 pe-4 pb-3 mb-3">
            <div id="postTitle">
                <span id="postTitleContent" style="font-weight: bold;">Create Post</span>
                <i id="exitButton" class="btn-round-sm font-xs text-primary feather-x-circle me-2 bg-greylight" onclick="ClosePostText()" style="cursor: pointer">
                </i>
            </div>
            <div id="postInfor">
                <img id="avtPostText" src="public/images/astofol.png" class="postAvt">
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
                          class="h100 bor-0 w-100 rounded-xxl p-2 ps-5 font-xssss text-black-500 fw-500 border-light-md theme-dark-bg"
                          cols="30"
                          rows="10"
                          placeholder="What's on your mind?"></textarea>
            </div>
            <div class="card-body d-flex p-0 mt-0" style="border-bottom: 3px">
                <label class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4">
                    <i class="font-md text-success feather-image me-2"></i>
                    <span class="d-none-xs" style="cursor: pointer">Photo/Video</span>
                    <input type="file" name="photo" id="upload-photo" />
                </label>
                <label
                        class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4">
                    <i class="font-md text-danger feather-video me-2">
                    </i><span class="d-none-xs">Live Video</span>
                </label>
                <label
                        class="d-flex align-items-center font-xssss fw-600 ls-1 text-grey-700 text-dark pe-4">
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
<div class="main-content right-chat-active bg_heart">
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <!-- loader wrapper -->
            <div class="preloader-wrap p-3">
                <div class="box shimmer">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
                <div class="box shimmer mb-3">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
                <div class="box shimmer">
                    <div class="lines">
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                        <div class="line s_shimmer"></div>
                    </div>
                </div>
            </div>
            <!-- loader wrapper -->
            <div class="row feed-body">
                <div class="col-xl-8 col-xxl-9 col-lg-8">
                    <div
                            class="card w-100 shadow-none bg-transparent bg-transparent-card border-0 p-0 mb-0">
                        <div
                                class="owl-carousel category-card owl-theme overflow-hidden nav-none">
                        </div>
                    </div>
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


                <!--Xóa bài đăng--><!--Post1 begin-->

                <div id='PostList'></div>

                <!--Post2 end-->
                <div
                        class="card w-100 text-center shadow-xss rounded-xxl border-0 p-4 mb-3 mt-3">
                    <div
                            class="snippet mt-2 ms-auto me-auto"
                            data-title=".dot-typing">
                        <div class="stage">
                            <div class="dot-typing"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-xxl-3 col-lg-4 ps-lg-0">
                <div class="card w-100 shadow-xss rounded-xxl border-0 mb-3">
                    <div class="card-body d-flex align-items-center p-4">
                        <h4 class="fw-700 mb-0 font-xssss text-grey-900">
                            Friend Request
                        </h4>
                    </div>
                    <!--Friend request-->
                    <div id="friendrequest">
<!--                        <div-->
<!--                                class="card-body d-flex pt-4 ps-4 pe-4 pb-0 border-top-xs bor-0"-->
<!--                        >-->
<!--                            <figure class="avatar me-3">-->
<!--                                <img-->
<!--                                        src="public/images/user-7.png"-->
<!--                                        alt="image"-->
<!--                                        class="shadow-sm rounded-circle w45"-->
<!--                                />-->
<!--                            </figure>-->
<!--                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">-->
<!--                                Anthony Daugloi-->
<!--                                <span-->
<!--                                        class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"-->
<!--                                >12 mutual friends</span-->
<!--                                >-->
<!--                            </h4>-->
<!--                        </div>-->
<!--                        <div-->
<!--                                class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4"-->
<!--                        >-->
<!--                            <a-->
<!--                                    href="#"-->
<!--                                    class="p-2 lh-20 w100 bg-primary-gradiant me-2 text-white text-center font-xssss fw-600 ls-1 rounded-xl"-->
<!--                            >Confirm</a-->
<!--                            >-->
<!--                            <a-->
<!--                                    href="#"-->
<!--                                    class="p-2 lh-20 w100 bg-grey text-grey-800 text-center font-xssss fw-600 ls-1 rounded-xl"-->
<!--                            >Delete</a-->
<!--                            >-->
<!--                        </div>-->
<!--                        <div-->
<!--                                class="card-body d-flex pt-4 ps-4 pe-4 pb-0 border-top-xs bor-0"-->
<!--                        >-->
<!--                            <figure class="avatar me-3">-->
<!--                                <img-->
<!--                                        src="public/images/user-7.png"-->
<!--                                        alt="image"-->
<!--                                        class="shadow-sm rounded-circle w45"-->
<!--                                />-->
<!--                            </figure>-->
<!--                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">-->
<!--                                Anthony Daugloi-->
<!--                                <span-->
<!--                                        class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"-->
<!--                                >12 mutual friends</span-->
<!--                                >-->
<!--                            </h4>-->
<!--                        </div>-->
<!--                        <div-->
<!--                                class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4"-->
<!--                        >-->
<!--                            <a-->
<!--                                    href="#"-->
<!--                                    class="p-2 lh-20 w100 bg-primary-gradiant me-2 text-white text-center font-xssss fw-600 ls-1 rounded-xl"-->
<!--                            >Confirm</a-->
<!--                            >-->
<!--                            <a-->
<!--                                    href="#"-->
<!--                                    class="p-2 lh-20 w100 bg-grey text-grey-800 text-center font-xssss fw-600 ls-1 rounded-xl"-->
<!--                            >Delete</a-->
<!--                            >-->
<!--                        </div>-->
<!--                        <div-->
<!--                                class="card-body d-flex pt-4 ps-4 pe-4 pb-0 border-top-xs bor-0"-->
<!--                        >-->
<!--                            <figure class="avatar me-3">-->
<!--                                <img-->
<!--                                        src="public/images/user-7.png"-->
<!--                                        alt="image"-->
<!--                                        class="shadow-sm rounded-circle w45"-->
<!--                                />-->
<!--                            </figure>-->
<!--                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">-->
<!--                                Anthony Daugloi-->
<!--                                <span-->
<!--                                        class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"-->
<!--                                >12 mutual friends</span-->
<!--                                >-->
<!--                            </h4>-->
<!--                        </div>-->
<!--                        <div-->
<!--                                class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4"-->
<!--                        >-->
<!--                            <a-->
<!--                                    href="#"-->
<!--                                    class="p-2 lh-20 w100 bg-primary-gradiant me-2 text-white text-center font-xssss fw-600 ls-1 rounded-xl"-->
<!--                            >Confirm</a-->
<!--                            >-->
<!--                            <a-->
<!--                                    href="#"-->
<!--                                    class="p-2 lh-20 w100 bg-grey text-grey-800 text-center font-xssss fw-600 ls-1 rounded-xl"-->
<!--                            >Delete</a-->
<!--                            >-->
<!--                        </div>-->
<!--                        <div-->
<!--                                class="card-body d-flex pt-4 ps-4 pe-4 pb-0 border-top-xs bor-0"-->
<!--                        >-->
<!--                            <figure class="avatar me-3">-->
<!--                                <img-->
<!--                                        src="public/images/user-7.png"-->
<!--                                        alt="image"-->
<!--                                        class="shadow-sm rounded-circle w45"-->
<!--                                />-->
<!--                            </figure>-->
<!--                            <h4 class="fw-700 text-grey-900 font-xssss mt-1">-->
<!--                                Anthony Daugloi-->
<!--                                <span-->
<!--                                        class="d-block font-xssss fw-500 mt-1 lh-3 text-grey-500"-->
<!--                                >12 mutual friends</span-->
<!--                                >-->
<!--                            </h4>-->
<!--                        </div>-->
<!--                        <div-->
<!--                                class="card-body d-flex align-items-center pt-0 ps-4 pe-4 pb-4"-->
<!--                        >-->
<!--                            <a-->
<!--                                    href="#"-->
<!--                                    class="p-2 lh-20 w100 bg-primary-gradiant me-2 text-white text-center font-xssss fw-600 ls-1 rounded-xl"-->
<!--                            >Confirm</a-->
<!--                            >-->
<!--                            <a-->
<!--                                    href="#"-->
<!--                                    class="p-2 lh-20 w100 bg-grey text-grey-800 text-center font-xssss fw-600 ls-1 rounded-xl"-->
<!--                            >Delete</a-->
<!--                            >-->
<!--                        </div>-->
                    </div>

                </div>

                <!--Xóa suggest group-->

                <!--Xóa suggest page-->

                <!--Xóa event-->
            </div>
        </div>
    </div>
</div>
</div>


<?php
include "Layout-Footer.php";
?>
<!-- main content -->
<script src="public/assets/phong/phongIndex.js"></script>
<!--<script src="/public/assets/js/htd/hungIndex.js"></script>-->
<script src="/public/assets/js/htd/index.js"></script>
<script src="public/js/plugin.js"></script>
<script src="public/js/lightbox.js"></script>
<script src="public/js/scripts.js"></script>
<script src="/public/assets/js/htd/contact.js"></script>
</body>

<!--</html>-->
<!--<script src="~/assets/phong/phongLayoutSocial.js"></script>-->