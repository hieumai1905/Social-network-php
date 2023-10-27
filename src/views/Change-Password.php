<?php
    require_once "Layout-Header.php";
?>
    <!-- main content -->

    <div class="main-content bg-lightblue theme-dark-bg right-chat-active">
        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="middle-wrap">
                    <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                        <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                            <a href="default-settings.html" class="d-inline-block mt-2">
                                <i class="ti-arrow-left font-sm text-white"></i>
                            </a>
                            <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Change Password</h4>
                        </div>
                        <div class="card-body p-lg-5 p-4 w-100 border-0">
                            <form action="#">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-gorup">
                                            <label class="mont-font fw-600 font-xssss">Current Password</label>
                                            <input type="password" name="comment-name" class="form-control" id="old-password">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <div class="form-gorup">
                                            <label class="mont-font fw-600 font-xssss">Change Password</label>
                                            <input type="password" name="comment-name" class="form-control" id="new-password">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-gorup">
                                            <label class="mont-font fw-600 font-xssss">Confirm Change Password</label>
                                            <input type="password" name="comment-name" class="form-control" id="confirm-new-password">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 p-0 text-left" style="display: block">
                                    <p style="color:red; font-size:14px ; display: none;cursor:pointer;" id="error-change-password">

                                    </p>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 mb-0">
                                        <p class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block" style="cursor: pointer;" id="confirm-change-password">
                                            Save
                                        </p>
                                    </div>
                                </div>


                            </form>
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
<!--<script src="assets/hm/change-password.js"></script>-->
<!--<script src="assets/hm/validation.js"></script>-->

<script src="public/js/plugin.js"></script>
<script src="public/js/lightbox.js"></script>
<script src="public/js/scripts.js"></script>
<!--<script src="~/assets/htd/contact.js"></script>-->
</body>

</html>
<!--<script src="~/assets/phong/phongLayoutSocial.js"></script>-->