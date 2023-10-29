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
                                <h2 class="fw-700 mb-0 mt-0 font-md text-grey-900">Friends</h2>
                            </div>
                        </div>
                        <div id="allfriend" class="row ps-2 pe-2">
                            <?php
                                foreach ($data['friend'] as $item) {
                                    $fullName = $item->getFullName();
                                    $email = $item->getEmail();
                                    echo "<div class='col-md-3 col-sm-4 pe-2 ps-2'>
                                            <div class='card d-block border-0 shadow-xss rounded-3 overflow-hidden mb-3 mt-0'>
                                                <div class='card-body d-block w-100 ps-3 pe-3 pb-4 text-center'>
                                                    <figure class='avatar ms-auto me-auto mb-0 position-relative w65 z-index-1'><img style='width:65px; height:65px; border-radius:50px;' src='/public/images/user-7.png' alt='image' class='float-right p-0 bg-white rounded-circle w-100 shadow-xss'></figure>
                                                    <div class='clearfix'></div>
                                                    <h4 class='fw-700 font-xsss mt-3 mb-1'>${fullName}</h4>
                                                    <p class='fw-500 font-xsssss text-grey-500 mt-0 mb-3'>${email}</p>
                                                    <a href='#' class='profile mt-0 btn pt-2 pb-2 ps-3 pe-3 lh-24 ms-1 ls-3 d-inline-block rounded-xl bg-success font-xsssss fw-700 ls-lg text-white'>Profile</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<!--<script src="~/assets/phong/phongMember.js"></script>-->
<script src="/public/js/plugin.js"></script>
<script src="/public/js/lightbox.js"></script>
<script src="/public/js/scripts.js"></script>
<!--<script src="~/assets/htd/contact.js"></script>-->
</body>

</html>
<!--<script src="~/assets/phong/phongLayoutSocial.js"></script>-->