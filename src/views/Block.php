<?php
    require_once "Layout-Header.php";
?>
    <!-- navigation left -->
    <!-- main content -->
    <div class="main-content right-chat-active">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left pe-0">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card shadow-xss w-100 d-block d-flex border-0 p-4 mb-3">
                            <div class="card-body d-flex align-items-center p-0">
                                <h2 class="fw-700 mb-0 mt-0 font-md text-grey-900">Users Block</h2>
                            </div>
                        </div>
                        <div id="blockresult" class="row ps-2 pe-2">
                            <?php
                                foreach ($data['block'] as $item) {
                                    $fullName = $item->getFullName();
                                    $email =$item->getEmail();
                                    $urlProfile = 'http://localhost:8080/users/'.$item->getUserId();
                                    echo "<div class='col-md-12 col-sm-4 pe-2 ps-2 phong1'>
                                <div class='card d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3 phong2'>
                                    <div class='card-body w-100 ps-3 pe-3 pb-4 phong3'>
                                        <figure class='avatar mb-0 position-relative w65 z-index-1 phong4'>
                                            <img style='width:65px; height:65px; border-radius:50px;' src='/public/images/user-7.png' alt='image' class='phong5'>
                                        </figure>
                                        <div class='clearfix phong6'></div>
                                        <h4 class='fw-700 font-xsss phong7'>$fullName</h4>
                                        <p class='fw-500 font-xsssss text-grey-500 phong8'>$email</p>
                                        <a style='background-color:red'  href='$urlProfile' class='profile phong9 mt-0 btn pt-2 pb-2 ps-3 pe-3 lh-24 ls-3 d-inline-block rounded-xl font-xsssss fw-700 ls-lg text-white'>View Profile</a>
                                    </div>
                                </div>
                            </div>";
                                }
                            ?>
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
<!--<script src="~/assets/phong/phongBlocks.js"></script>-->
<script src="public/js/plugin.js"></script>
<script src="public/js/lightbox.js"></script>
<script src="public/js/scripts.js"></script>
<!--<script src="~/assets/htd/contact.js"></script>-->
</body>

</html>
<!--<script src="~/assets/phong/phongLayoutSocial.js"></script>-->