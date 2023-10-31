<?php
    require_once "Layout-Header.php";
?>
    <!-- main content -->

    <div class="main-content bg-lightblue theme-dark-bg right-chat-active">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left">
                <div class="middle-wrap" style="min-width: 100%;">
                    <div class="card w-100 border-0 bg-white shadow-xs p-0 mb-4">
                        <div class="card-body p-4 w-100 bg-current border-0 d-flex rounded-3">
                            <a href="default-settings.html" class="d-inline-block mt-2">
                                <i class="ti-arrow-left font-sm text-white"></i>
                            </a>
                            <h4 class="font-xs text-white fw-600 ms-4 mb-0 mt-2">Account Details</h4>
                        </div>
                        <div class="card-body p-lg-5 p-4 w-100 border-0 ">
                            <div class="row justify-content-center">
                                <div class="col-lg-4 text-center">
                                    <figure id="uImg" class="avatar ms-auto me-auto mb-0 mt-2 w100">
                                        @*<img src="images/pt-1.jpg" alt="image" class="shadow-sm rounded-3 w-100">*@
                                    </figure>
                                    <h2 id="uName" class="fw-700 font-sm text-grey-900 mt-3"></h2>
                                    <h4 id="ubd" class="text-grey-500 fw-500 mb-3 font-xsss mb-4">Create At</h4>
                                    <h4 id="uRegisterAt" class="fw-500 font-sm text-grey-700 mt-3"></h4>
                                    <!-- <a href="#" class="p-3 alert-primary text-primary font-xsss fw-500 mt-2 rounded-3">Upload New Photo</a> -->
                                </div>
                            </div>

                            <form action="#">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Full Name</label>
                                            <?php
                                                $fullName = $data['user']->getFullName();
                                                echo "<input id='uFullName' style='font-size: 23px' data-maxlength='30' class='form-control mb-0 p-3  bg-ghostwhite lh-16' rows='1' placeholder='Type your first name...' spellcheck='false' value='$fullName'>";
                                            ?>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Email</label>
                                            <?php
                                                $email = $data['user']->getEmail();
                                                echo "<input id='uEmail' style='font-size: 23px; ' class='form-control mb-0 p-3  bg-ghostwhite lh-16' rows='1' placeholder='Type your Email...' spellcheck='false' disabled value='$email'>";

                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Phone</label>
                                            <?php
                                                $phone = $data['user']->getPhone();
                                                if ($phone == null) {
                                                    echo "<input id='uPhone' type='number' style='font-size: 23px' pattern='[0-9]' data-maxlength='10' oninput='this.value=this.value.slice(0,this.dataset.maxlength)' class='form-control mb-0 p-3  bg-ghostwhite lh-16' rows='1' placeholder='Type your phone number...' spellcheck='false'>";
                                                }
                                                else {
                                                    echo "<input id='uPhone' type='number' style='font-size: 23px' pattern='[0-9]' data-maxlength='10' oninput='this.value=this.value.slice(0,this.dataset.maxlength)' class='form-control mb-0 p-3  bg-ghostwhite lh-16' rows='1' placeholder='Type your phone number...' spellcheck='false' value='$phone'>";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">


                                    <div class="col-lg-12 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Address</label>
                                            <?php
                                                $address = $data['user']->getAddress();
                                                if ($address == null) {
                                                    echo "<input id='uAddress' style='font-size: 23px' class='form-control mb-0 p-3  bg-ghostwhite lh-16' rows='1' placeholder='Write your Address...' spellcheck='false'>";
                                                }
                                                else {
                                                    echo "<input id='uAddress' style='font-size: 23px' class='form-control mb-0 p-3  bg-ghostwhite lh-16' rows='1' placeholder='Write your Address...' spellcheck='false' value='$address'>";
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 mb-3">
                                        <div class="form-group">
                                            <div>
                                                <label class="mont-font fw-600 font-xsss">Gender</label><br>
                                                <?php
                                                $gender = $data['user']->getGender(); // Giả sử giá trị a là "female"
                                                $options = array("Nam", "Nữ", "Khác"); // Mảng chứa các tùy chọn

                                                echo '<select id="uGender" class="select-css">';
                                                foreach ($options as $option) {
                                                    echo '<option value="' . $option . '"';
                                                    if ($gender == $option) {
                                                        echo ' selected';
                                                    }
                                                    echo '>' . $option . '</option>';
                                                }
                                                echo '</select>';
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-9 mb-3">
                                        <div class="form-group">
                                            <label class="mont-font fw-600 font-xsss">Birthday</label><br>
                                            <?php
                                                $dob = $data['user']->getDob();
                                                echo "<input id='uDob' style='font-size: 23px' class='form-control mb-0 p-3  bg-ghostwhite lh-16' type='date'  name='bday' min='1940-01-01' value='$dob'><br><br>";
                                            ?>
                                        </div>
                                    </div>


                                    <div class="col-lg-12 mb-3">
                                        <label class="mont-font fw-600 font-xsss">About Me</label>
                                        <?php
                                            $aboutMe = $data['user']->getAboutMe();
                                            if ($aboutMe == null) {
                                                echo "<input id='uAboutMe'style='font-size: 23px' class='form-control mb-0 p-3 h100 bg-greylight lh-16' rows='5' placeholder='Write your message...' spellcheck='false'>";
                                            }
                                            else {
                                                echo "<input id='uAboutMe'style='font-size: 23px' class='form-control mb-0 p-3 h100 bg-greylight lh-16' rows='5' placeholder='Write your message...' spellcheck='false' value='$aboutMe'>";
                                            }
                                        ?>
                                    </div>


                                    <div class="col-lg-12">
                                        <button id="btnSave" class="bg-current text-center text-white font-xsss fw-600 p-3 w175 rounded-3 d-inline-block">Save</button>
                                        <h5 id="error"  style="color:blue"></h5>
                                    </div>
                                </div>
                                <div>
                                    <p id="uuserId"></p>
                                    <p id="uAvatar"></p>
                                    <p id="uUserInfoId"></p>
                                    <p id="uPassword"></p>
                                    <p id="uStatus"></p>
                                    <p id="uUserRole"></p>
                                    <p id="uCoverImage"></p>
                                    <p></p>
                                </div>

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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js">
</script>
<!--<style src="../css/HMHcss.css" type="text/css">-->
<!--</style>-->
<!--<script src="../js/hieuhm.js" type="text/javascript">-->

</script>
<script src="public/js/plugin.js"></script>
<script src="public/js/lightbox.js"></script>
<script src="public/js/scripts.js"></script>
<script src="/public/assets/phong/phongEditInformation.js"></script>
<!--<script src="~/assets/htd/contact.js"></script>-->
</body>

</html>
<!--<script src="~/assets/phong/phongLayoutSocial.js"></script>-->