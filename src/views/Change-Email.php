<?php
require_once "Layout-Header.php";
?>
<!-- main content -->
<div class="main-content bg-lightblue theme-dark-bg right-chat-active" style="margin-top: 100px;">
    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left">
            <div class="middle-wrap">
                <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                    <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                        <a href="/settings" class="d-inline-block mt-2">
                            <i class="ti-arrow-left font-sm text-white"></i>
                        </a>
                        <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Change Email</h4>
                    </div>
                    <div class="card-body p-lg-5 p-4 w-100 border-0">
                        <div style="margin-top: 10px">
                            <i style="color: red; font-size: 14px; display: none"
                               id="notification-change-email"></i>

                            <?php
                            if (isset($error)) {
                                echo '<i style="color: red; font-size: 14px;"
                                   id="notification2-change-email">' . $error . '</i>';
                            }
                            if (isset($success)) {
                                echo '<i style="color: red; font-size: 14px;"
                                   id="notification3-change-email">' . $success . '</i>';
                            }
                            ?>
                        </div>

                        <form action="/change-email" method="post" onsubmit="return checkValidationChangeEmail()">
                            <div class="row">
                                <?php
                                if (!isset($error)) {
                                    echo '<div class="row remove-after">
                                    <div class="col-lg-8 mb-3">
                                        <div class="form-gorup" id="new-email-change">
                                            <label class="mont-font fw-600 font-xssss">New Email</label>
                                            <input type="text" class="form-control"
                                                   id="email-new-change">
                                        </div>
                                    </div>
                                </div>';
                                }
                                ?>
                                <?php
                                if (isset($error)) {
                                    echo '<div class="col-lg-4 mb-3 show-after">
                                    <div class="form-gorup">
                                        <label class="mont-font fw-600 font-xssss">Confirm code</label>
                                        <input type="text" name="code-change-email" class="form-control"
                                               id="code-change-email">
                                    </div>
                                </div>';
                                } else {
                                    echo '<div class="col-lg-4 mb-3 show-after dis-none" style="display: none">
                                    <div class="form-gorup">
                                        <label class="mont-font fw-600 font-xssss">Confirm code</label>
                                        <input type="text" name="code-change-email" class="form-control"
                                               id="code-change-email">
                                    </div>
                                </div>';
                                }
                                ?>

                            </div>
                            <?php
                            if (!isset($error)) {
                                echo '<div class="row remove-after" >
                                <div class="col-lg-3 mb-0" id="btn-get-code-change-email">
                                    <p style="cursor: pointer; padding: 10px"
                                       class="bg-current text-center text-white font-xsss fw-600 w175 rounded-3 d-inline-block">
                                        Get Code
                                    </p>
                                </div>
                            </div>';
                            }
                            ?>
                            <div class="row show-after dis-none" style="display: none">
                                <div class="col-lg-9 mb-0" id="save-email-change">
                                    <p style="cursor: pointer;"
                                       class="bg-current text-center text-white font-xsss w175 rounded-3 d-inline-block"
                                       id="btn-save-change-email">
                                        <input type="submit" class="fw-600 " value="Save"
                                               style="background-color: #05f; padding:10px;border: none; color: white; width: 100%; height: 100%; border-radius: 20px;"/>
                                    </p>
                                </div>
                            </div>
                            <?php
                            if (isset($error)) {
                                echo '<div class="row show-after">
                                <div class="col-lg-9 mb-0" id="save-email-change">
                                    <p style="cursor: pointer;"
                                       class="bg-current text-center text-white font-xsss w175 rounded-3 d-inline-block"
                                       id="btn-save-change-email">
                                        <input type="submit" class="fw-600 " value="Save"
                                               style="background-color: #05f; padding:10px;border: none; color: white; width: 100%; height: 100%; border-radius: 20px;"/>
                                    </p>
                                </div>
                            </div>';
                            }
                            ?>

                        </form>
                    </div>
                </div>
                <!-- <div class="card w-100 border-0 p-2"></div> -->
            </div>
        </div>

    </div>
</div>
<!-- main content -->
<?php
require "Layout-Footer.php";
?>
<!--<script src="assets/hm/change-email.js"></script>-->
<!--<script src="assets/hm/validation.js"></script>-->
<script src="/public/js/plugin.js"></script>
<script src="/public/js/lightbox.js"></script>
<script src="/public/js/scripts.js"></script>
<script src="/public/js/scripts.js"></script>
<script src="/public/assets/js/hm/Change-email.js"></script>
<script src="/public/assets/js/hm/Validation.js"></script>
</body>

</html>
<!--<script src="~/assets/phong/phongLayoutSocial.js"></script>-->

