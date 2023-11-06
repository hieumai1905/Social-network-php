Î<?php
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
                        <form action="/change-password" method="post" onsubmit="return checkValidation()">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-gorup">
                                        <label class="mont-font fw-600 font-xssss">Current Password</label>
                                        <input type="password" name="old-password" class="form-control"
                                               id="old-password">
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <div class="form-gorup">
                                        <label class="mont-font fw-600 font-xssss">Change Password</label>
                                        <input type="password" name="new-password" class="form-control"
                                               id="new-password">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <div class="form-gorup">
                                        <label class="mont-font fw-600 font-xssss">Confirm Change Password</label>
                                        <input type="password" name="confirm-password" class="form-control"
                                               id="confirm-password">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 p-0 text-left" style="display: block">
                                <p style="color:red; font-size:14px ; display: none;cursor:pointer;" id="notification">
                                </p>
                                <?php
                                if (isset($error)) {
                                    echo '<p style="color:red; font-size:14px ; cursor:pointer;" id="notification1">' . $error . '</p>';
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mb-0">
                                    <p class="bg-current text-center text-white font-xsss fw-600 w175 rounded-3 d-inline-block"
                                       style="cursor: pointer;" id="confirm-change-password">
                                        <input type="submit" class="fw-600 " value="Save"
                                               style="background-color: #05f; padding:10px;border: none; color: white; width: 100%; height: 100%; border-radius: 20px;"/>
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

<script src="/public/js/plugin.js"></script>
<script src="/public/js/lightbox.js"></script>
<script src="/public/js/scripts.js"></script>
<script src="/public/js/scripts.js"></script>
<script src="/public/assets/js/hm/Change-password.js"></script>
<script src="/public/assets/js/hm/Validation.js"></script>
</body>

</html>
