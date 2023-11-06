<?php
require_once "Layout-Header.php";
?>
    <!-- main content -->
    <div class="main-content right-chat-active">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left pe-0">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card shadow-xss w-100 d-block d-flex border-0 p-4 mb-3">
                            <div class="card-body d-flex align-items-center p-0">
                                <h2 class="fw-700 mb-0 mt-0 font-md text-grey-900">My Favorite</h2>
                            </div>
                        </div>
                        <div id="favoritePost" class="row ps-2 pe-2">
                            <div class='col-md-12 col-sm-4 pe-2 ps-2 phong1'>
                                <div class='card d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3 phong2'>
                                    <div class='card-body w-100 ps-3 pe-3 pb-4 phong3' style="display: flex; flex-direction: row; align-items: center; height: 150px">
                                        <figure class='avatar mb-0 position-relative w65 z-index-1 phong4'>
                                            <img style='width:65px; height:65px; border-radius:50px;' src='public/images/BronieSW.jpg' alt='image' class='phong5'>
                                        </figure>
                                        <div class='clearfix phong6'></div>
                                        <h4 class='fw-700 font-xsss phong7'>HELLO</h4>
                                        <p class='fw-500 font-xsssss text-grey-500 phong8'>Hello</p>
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
    <!--<script src="~/assets//phong/phongSearch.js"></script>-->
    <script src="public/js/plugin.js"></script>
    <script src="public/js/lightbox.js"></script>
    <script src="public/js/scripts.js"></script>
    <!--<script src="~/assets/htd/contact.js"></script>-->
    </body>

    </html>
    <!--<script src="~/assets/phong/phongLayoutSocial.js"></script>--><?php
