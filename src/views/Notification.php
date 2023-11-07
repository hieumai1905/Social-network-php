<?php
    require_once "Layout-Header.php";
?>
    <!-- main content -->
    <div class="main-content right-chat-active">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left pe-0">
                <div class="row">

                    <div class="col-xl-12">
                        <div class="chat-wrapper p-3 w-100 position-relative scroll-bar bg-white theme-dark-bg">
                            <h2 class="fw-700 mb-4 mt-2 font-md text-grey-900 d-flex align-items-center">Notification
                                <span id="showNotification" class="circle-count bg-warning text-white font-xsssss rounded-3 ms-2 ls-3 fw-600 p-2  mt-0"></span>
                                <a href="#" class="ms-auto btn-round-sm bg-greylight rounded-3"><i class="feather-hard-drive font-xss text-grey-500"></i></a>
                                <a href="#" class="ms-2 btn-round-sm bg-greylight rounded-3"><i class="feather-alert-circle font-xss text-grey-500"></i></a>
                                <a href="#" class="ms-2 btn-round-sm bg-greylight rounded-3"><i class="feather-trash-2 font-xss text-grey-500"></i></a></h2>



                            <ul id="NotificationList" class="notification-box">

                                <?php
                                    $i = 0;
                                    foreach ($data['notification'] as $item) {
                                        $content = $item->getContent();
                                        $date = $item->getNotificationAt();
                                        $url_target = $item->getUrlTarget();
                                        $avatarUserSend = 'public/images/'.$data['user'][$i]->getAvatar();
                                        echo "<li>
                                    <a href='$url_target' class='d-flex align-items-center p-3 rounded-3 bg-lightblue theme-light-bg'>
                                        <img src='$avatarUserSend' alt='user' class='w45 me-3'>
                                        <i class='feather-heart text-white bg-red-gradiant me-2 font-xssss notification-react'></i>
                                        <h6 class='font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20'>$content<span class='d-block text-grey-500 font-xssss fw-600 mb-0 mt-0 0l-auto'>$date</span></h6>
                                        <i class='ti-more-alt text-grey-500 font-xs ms-auto'></i>
                                    </a>
                                </li>";
                                        $i += 1;
                                    }
                                ?>
<!--                                <li>-->
<!--                                    <a href="#" class="d-flex align-items-center p-3 rounded-3 bg-lightblue theme-light-bg">-->
<!--                                        <img src="images/user-7.png" alt="user" class="w45 me-3">-->
<!--                                        <i class="feather-heart text-white bg-red-gradiant me-2 font-xssss notification-react"></i>-->
<!--                                        <h6 class="font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20"><strong>Victor Exrixon</strong> posted in <strong>UI/UX Community</strong> : “Mobile Apps UI Designer is required for Tech…” <span class="d-block text-grey-500 font-xssss fw-600 mb-0 mt-0 0l-auto"> 12 minutes ago</span> </h6>-->
<!--                                        <i class="ti-more-alt text-grey-500 font-xs ms-auto"></i>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#" class="d-flex align-items-center p-3 rounded-3 bg-lightblue theme-light-bg">-->
<!--                                        <img src="images/user-7.png" alt="user" class="w45 me-3">-->
<!--                                        <i class="feather-heart text-white bg-red-gradiant me-2 font-xssss notification-react"></i>-->
<!--                                        <h6 class="font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20"><strong>Victor Exrixon</strong> posted in <strong>UI/UX Community</strong> : “Mobile Apps UI Designer is required for Tech…” <span class="d-block text-grey-500 font-xssss fw-600 mb-0 mt-0 0l-auto"> 12 minutes ago</span> </h6>-->
<!--                                        <i class="ti-more-alt text-grey-500 font-xs ms-auto"></i>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#" class="d-flex align-items-center p-3 rounded-3 bg-lightblue theme-light-bg">-->
<!--                                        <img src="images/user-7.png" alt="user" class="w45 me-3">-->
<!--                                        <i class="feather-heart text-white bg-red-gradiant me-2 font-xssss notification-react"></i>-->
<!--                                        <h6 class="font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20"><strong>Victor Exrixon</strong> posted in <strong>UI/UX Community</strong> : “Mobile Apps UI Designer is required for Tech…” <span class="d-block text-grey-500 font-xssss fw-600 mb-0 mt-0 0l-auto"> 12 minutes ago</span> </h6>-->
<!--                                        <i class="ti-more-alt text-grey-500 font-xs ms-auto"></i>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <a href="#" class="d-flex align-items-center p-3 rounded-3 bg-lightblue theme-light-bg">-->
<!--                                        <img src="images/user-7.png" alt="user" class="w45 me-3">-->
<!--                                        <i class="feather-heart text-white bg-red-gradiant me-2 font-xssss notification-react"></i>-->
<!--                                        <h6 class="font-xssss text-grey-900 text-grey-900 mb-0 mt-0 fw-500 lh-20"><strong>Victor Exrixon</strong> posted in <strong>UI/UX Community</strong> : “Mobile Apps UI Designer is required for Tech…” <span class="d-block text-grey-500 font-xssss fw-600 mb-0 mt-0 0l-auto"> 12 minutes ago</span> </h6>-->
<!--                                        <i class="ti-more-alt text-grey-500 font-xs ms-auto"></i>-->
<!--                                    </a>-->
<!--                                </li>-->




                            </ul>
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
<!--<script src="../js/hmhNotification.js" type="text/javascript"></script>-->
<script src="public/js/plugin.js"></script>
<script src="public/js/lightbox.js"></script>
<script src="public/js/scripts.js"></script>
<!--<script src="~/assets/htd/contact.js"></script>-->
</body>

</html>
<!--<script src="~/assets/phong/phongLayoutSocial.js"></script>-->