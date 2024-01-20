<?php
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
                            <h1 style="color: rgb(128,128,128); text-align: center">Có vẻ bạn chưa lưu bài viết nào...</h1>
                            <div
                                    class="card w-100 text-center rounded-xxl border-0 p-4 mb-3 mt-3" style="background-color: #fbfcfe">
                                <div
                                        class="snippet mt-2 ms-auto me-auto"
                                        data-title=".dot-typing">
                                    <div class="stage">
                                        <div class="dot-typing"></div>
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
    <script src="/public/assets/js/htd/favorite.js"></script>
    <!--<script src="~/assets/htd/contact.js"></script>-->
    </body>

    </html>
    <!--<script src="~/assets/phong/phongLayoutSocial.js"></script>--><?php
