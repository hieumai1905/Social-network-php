Î<?php
    require_once "Layout-Header.php";
?>
    <!-- main content -->
    <div class="main-content bg-lightblue theme-dark-bg right-chat-active">
        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="middle-wrap">
                    <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">

                        <div class="card-body p-lg-5 p-4 w-100 border-0">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="mb-4 font-xxl fw-700 mont-font mb-lg-5 mb-4 font-md-xs">Settings</h4>
                                    <div class="nav-caption fw-600 font-xssss text-grey-500 mb-2">Genaral</div>
                                    <ul class="list-inline mb-4">
                                        <li class="list-inline-item d-block border-bottom me-0">
                                            <a href="http://localhost:8080/editinformation" class="pt-2 pb-2 d-flex align-items-center">
                                                <i class="btn-round-md bg-primary-gradiant text-white feather-home font-md me-3"></i> <h4 class="fw-600 font-xsss mb-0 mt-0">Account Information</h4><i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="nav-caption fw-600 font-xsss text-grey-500 mb-2">Acount</div>
                                    <ul class="list-inline mb-4">
                                        <li class="list-inline-item d-block border-bottom me-0">
                                            <a href="/change-email" class="pt-2 pb-2 d-flex align-items-center">
                                                <i class="btn-round-md bg-mini-gradiant text-white feather-mail font-md me-3"></i> <h4 class="fw-600 font-xsss mb-0 mt-0">Change Email</h4><i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item d-block  me-0">
                                            <a href="/change-password" class="pt-2 pb-2 d-flex align-items-center">
                                                <i class="btn-round-md bg-blue-gradiant text-white feather-inbox font-md me-3"></i> <h4 class="fw-600 font-xsss mb-0 mt-0">Change Password</h4><i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>

                                    </ul>

                                    <div class="nav-caption fw-600 font-xsss text-grey-500 mb-2">Other</div>
                                    <ul class="list-inline">
                                        <li class="list-inline-item d-block border-bottom me-0">
                                            <a href="http://localhost:8080/notification" class="pt-2 pb-2 d-flex align-items-center">
                                                <i class="btn-round-md bg-gold-gradiant text-white feather-bell font-md me-3"></i> <h4 class="fw-600 font-xsss mb-0 mt-0">Notification</h4><i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item d-block border-bottom me-0">
                                            <a href="help-box.html" class="pt-2 pb-2 d-flex align-items-center">
                                                <i class="btn-round-md bg-primary-gradiant text-white feather-help-circle font-md me-3"></i> <h4 class="fw-600 font-xsss mb-0 mt-0">Help</h4><i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item d-block me-0" id="btn-userblock">
                                            <a href="http://localhost:8080/relation/block" class="pt-2 pb-2 d-flex align-items-center">
                                                <i class="btn-round-md bg-red-gradiant text-white feather-lock font-md me-3"></i> <h4 class="fw-600 font-xsss mb-0 mt-0">User Block</h4><i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>
                                        <li class="list-inline-item d-block me-0" id="btn-logout">
                                            <a href="/logout" class="pt-2 pb-2 d-flex align-items-center">
                                                <i class="btn-round-md bg-red-gradiant text-white feather-log-out font-md me-3"></i> <h4 class="fw-600 font-xsss mb-0 mt-0">Logout</h4><i class="ti-angle-right font-xsss text-grey-500 ms-auto mt-3"></i>
                                            </a>
                                        </li>

                                    </ul>
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
<!--<script src="assets/hm/setting.js"></script>-->
<script src="/public/js/plugin.js"></script>
<script src="/public/js/lightbox.js"></script>
<script src="/public/js/scripts.js"></script>
<!--<script src="~/assets/htd/contact.js"></script>-->
</body>

</html>
<!--<script src="~/assets/phong/phongLayoutSocial.js"></script>-->