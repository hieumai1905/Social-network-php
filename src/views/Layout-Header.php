
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sociala - Social Network App HTML Template</title>
    <link rel="stylesheet" href="/public/css/themify-icons.css" />
    <link rel="stylesheet" href="/public/css/feather.css" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="/public/images/fav-icon.png" />
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="/public/css/style.css" />
    <link rel="stylesheet" href="/public/css/emoji.css" />
    <link rel="stylesheet" href="/public/css/phongcss.css">
    <link rel="stylesheet" href="/public/css/hungtdcss.css" />
    <link rel="stylesheet" href="/public/css/lightbox.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/hungIndex.css" />
<!--    <script src="public/js/authentication.js"></script>-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body class="color-theme-blue mont-font">
<div class="main-wrapper" >
    <!-- navigation top-->
    <div class="nav-header bg-white shadow-xs border-0">
        <div class="nav-top">
            <a href="Index.php">
                    <span>
                        <img src="/public/images/fav-icon.png" alt="" style="width: 35px; height: 35px;" />
                    </span>
                &ensp;
                <span class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">
                        Mặt Sách.
                    </span>
            </a>
            <a href="#" class="mob-menu ms-auto me-2 chat-active-btn">
                <i class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight">
                </i>
            </a>
            <a href="default-video.html" class="mob-menu me-2">
                <i class="feather-video text-grey-900 font-sm btn-round-md bg-greylight">
                </i>
            </a>
            <a href="#" class="me-2 menu-search-icon mob-menu">
                <i class="feather-search text-grey-900 font-sm btn-round-md bg-greylight">
                </i>
            </a>
            <button class="nav-menu me-0 ms-2"></button>
        </div>

        <div class="form-group mb-0 icon-input">
            <i class="feather-search font-sm text-grey-400"></i>
            <input id="searchuser"
                   type="text"
                   placeholder="Start typing to search.."
                   class="bg-grey border-0 lh-32 pt-2 pb-2 ps-5 pe-3 font-xssss fw-500 rounded-xl w350 theme-dark-bg" />
        </div>
        <a href="Index.php"
           class="p-2 text-center ms-3 menu-icon center-menu-icon">
            <i class="feather-home font-lg alert-primary btn-round-lg theme-dark-bg text-current">
            </i>
        </a>
        <a href="#"
           class="p-2 text-center ms-0 menu-icon center-menu-icon">
            <i class="feather-zap font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500">
            </i>
        </a>
        <a href="#"
           class="p-2 text-center ms-0 menu-icon center-menu-icon">
            <i class="feather-video font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500">
            </i>
        </a>
        <a id="homeadmin" href="admin/Home.php"
           class="p-2 text-center ms-0 menu-icon center-menu-icon">
            <i class="feather-user font-lg bg-greylight btn-round-lg theme-dark-bg text-grey-500">
            </i>
        </a>

        <a href="Notification.php"
           id="ringNotification"
           class="p-2 text-center ms-auto menu-icon"
        >
                <span class="dot-count" id="showNotification" style="color:red">
                </span>
            <i class="feather-bell font-xl text-current">
            </i>
        </a>
        <div class="dropdown-menu dropdown-menu-end p-4 rounded-3 border-0 shadow-lg"
             aria-labelledby="dropdownMenu3">
            <h4 class="fw-700 font-xss mb-4">Notification</h4><!--Notification-->
            <div class="card bg-transparent-card w-100 border-0 ps-5 mb-3">
                <img src="/public/images/user-8.png"
                     alt="user"
                     class="w40 position-absolute left-0" /><!--User avatar-->
                <h5 class="font-xsss text-grey-900 mb-1 mt-0 fw-700 d-block">
                    <!--Username-->
                    Hendrix Stamp
                    <span class="text-grey-400 font-xsssss fw-600 float-right mt-1">
                            3 min
                        </span>
                </h5>
                <h6 class="text-grey-500 fw-500 font-xssss lh-4">
                    There are many variations of pass..
                </h6><!--Content notify-->
            </div>
        </div>
        <a href="#" class="p-2 text-center ms-3 menu-icon chat-active-btn">
            <i class="feather-message-square font-xl text-current">
            </i>
        </a>
        <div class="p-2 text-center ms-3 position-relative dropdown-menu-icon menu-icon cursor-pointer">
            <a href="/settings">
                <i class="feather-settings animation-spin d-inline-block font-xl text-current">
                </i></a>
            <div style="display:none" class="dropdown-menu-settings switchcolor-wrap">
                <h4 class="fw-700 font-sm mb-4">Settings</h4>
                <h6 class="font-xssss text-grey-500 fw-700 mb-3 d-block">
                    Choose Color Theme
                </h6>
                <ul>
                    <li>
                        <label class="item-radio item-content">
                            <input type="radio"
                                   name="color-radio"
                                   value="red"
                                   checked="" /><i class="ti-check"></i>
                            <span class="circle-color bg-red"
                                  style="background-color: #ff3b30">
                                </span>
                        </label>
                    </li>
                    <li>
                        <label class="item-radio item-content">
                            <input type="radio" name="color-radio" value="green" />
                            <i class="ti-check">
                            </i>
                            <span class="circle-color bg-green"
                                  style="background-color: #4cd964">
                                </span>
                        </label>
                    </li>
                    <li>
                        <label class="item-radio item-content">
                            <input type="radio"
                                   name="color-radio"
                                   value="blue"
                                   checked="" /><i class="ti-check"></i>
                            <span class="circle-color bg-blue"
                                  style="background-color: #132977">
                                </span>
                        </label>
                    </li>
                    <li>
                        <label class="item-radio item-content">
                            <input type="radio" name="color-radio" value="pink" />
                            <i class="ti-check">
                            </i>
                            <span class="circle-color bg-pink"
                                  style="background-color: #ff2d55">
                                </span>
                        </label>
                    </li>
                    <li>
                        <label class="item-radio item-content">
                            <input type="radio" name="color-radio" value="yellow" />
                            <i class="ti-check">
                            </i>
                            <span class="circle-color bg-yellow"
                                  style="background-color: #ffcc00">
                                </span>
                        </label>
                    </li>
                    <li>
                        <label class="item-radio item-content">
                            <input type="radio" name="color-radio" value="orange" />
                            <i class="ti-check">
                            </i>
                            <span class="circle-color bg-orange"
                                  style="background-color: #ff9500">
                                </span>
                        </label>
                    </li>
                    <li>
                        <label class="item-radio item-content">
                            <input type="radio" name="color-radio" value="gray" />
                            <i class="ti-check">
                            </i>
                            <span class="circle-color bg-gray"
                                  style="background-color: #8e8e93">
                                </span>
                        </label>
                    </li>

                    <li>
                        <label class="item-radio item-content">
                            <input type="radio" name="color-radio" value="brown" />
                            <i class="ti-check">
                            </i>
                            <span class="circle-color bg-brown"
                                  style="background-color: #d2691e">
                                </span>
                        </label>
                    </li>
                    <li>
                        <label class="item-radio item-content">
                            <input type="radio" name="color-radio" value="darkgreen" />
                            <i class="ti-check">
                            </i>
                            <span class="circle-color bg-darkgreen"
                                  style="background-color: #228b22">
                                </span>
                        </label>
                    </li>
                    <li>
                        <label class="item-radio item-content">
                            <input type="radio" name="color-radio" value="deeppink" />
                            <i class="ti-check">
                            </i>
                            <span class="circle-color bg-deeppink"
                                  style="background-color: #ffc0cb">
                                </span>
                        </label>
                    </li>
                    <li>
                        <label class="item-radio item-content">
                            <input type="radio" name="color-radio" value="cadetblue" />
                            <i class="ti-check">
                            </i>
                            <span class="circle-color bg-cadetblue"
                                  style="background-color: #5f9ea0">
                                </span>
                        </label>
                    </li>
                    <li>
                        <label class="item-radio item-content">
                            <input type="radio" name="color-radio" value="darkorchid" />
                            <i class="ti-check">
                            </i>
                            <span class="circle-color bg-darkorchid"
                                  style="background-color: #9932cc">
                                </span>
                        </label>
                    </li>
                </ul>

                <div class="card bg-transparent-card border-0 d-block mt-3">
                    <h4 class="d-inline font-xssss mont-font fw-700">
                        Header Background
                    </h4>
                    <div class="d-inline float-right mt-1">
                        <label class="toggle toggle-menu-color">
                            <input type="checkbox" />
                            <span class="toggle-icon">
                                </span>
                        </label>
                    </div>
                </div>
                <div class="card bg-transparent-card border-0 d-block mt-3">
                    <h4 class="d-inline font-xssss mont-font fw-700">
                        Menu Position
                    </h4>
                    <div class="d-inline float-right mt-1">
                        <label class="toggle toggle-menu">
                            <input type="checkbox" />
                            <span class="toggle-icon">
                                </span>
                        </label>
                    </div>
                </div>
                <div class="card bg-transparent-card border-0 d-block mt-3">
                    <h4 class="d-inline font-xssss mont-font fw-700">Dark Mode</h4>
                    <div class="d-inline float-right mt-1">
                        <label class="toggle toggle-dark">
                            <input type="checkbox" />
                            <span class="toggle-icon">
                                </span>
                        </label>
                    </div>
                </div>
                <div class="card bg-transparent-card border-0 d-block mt-3">
                    <a id="usersblock" href="Block.php" style="color:black" class="d-inline font-xssss mont-font fw-700">Users Block</a>
                </div>
                <div class="card bg-transparent-card border-0 d-block mt-3">
                    <a id="logout" href="Login.php" style="color:black" class="d-inline font-xssss mont-font fw-700">Logout</a>
                </div>
            </div>
        </div>

        <?php
            $user = unserialize($_SESSION['user-login']);
            $urlProfile = 'http://localhost:8080/users/'.$user->getUserId();
            echo "<a id='avatarprofile' href='${urlProfile}' class='p-0 ms-3 menu-icon'>
            <img style='width:30px; height:40px; border-radius:30px;' id='avataruser' src='/public/images/profile-4.png' alt='user' class='w40 mt--1' />
        </a>"
        ?>
    </div>
    <!-- navigation top -->
    <!-- navigation left -->
    <nav class="navigation scroll-bar">
        <div class="container ps-0 pe-0">
            <div class="nav-content">
                <div class="nav-wrap bg-white bg-transparent-card rounded-xxl shadow-xss pt-3 pb-1 mb-2 mt-2" style="height: 80vh">
                    <div class="nav-caption fw-600 font-xssss text-grey-500">
                        <span>New </span>Feeds
                    </div>
                    <ul class="mb-1 top-content">
                        <li class="logo d-none d-xl-block d-lg-block"></li>
                        <li>
                            <a href="Index.php" class="nav-content-bttn open-font">
                                <i class="feather-tv btn-round-md bg-blue-gradiant me-3"></i><span>Newsfeed</span>
                            </a>
                        </li>
                        <!--Xoa 2 the Badge & stories them live stream vao newfeed-->
                        <li>
                            <a href="#"
                               class="nav-content-bttn open-font">
                                <i class="feather-youtube btn-round-md bg-gold-gradiant me-3"></i>
                                <span>Live Stream</span>
                            </a>
                        </li>
                        <li>
                            <a href="#"
                               class="nav-content-bttn open-font">
                                <i class="feather-zap btn-round-md bg-mini-gradiant me-3"></i><span>Popular Groups</span>
                            </a>
                        </li>
                        <li>
                            <a id="myprofile" href="Profile.php" class="nav-content-bttn open-font">
                                <i class="feather-user btn-round-md bg-primary-gradiant me-3"></i><span>Author Profile </span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!--Xóa more pages & account-->
            </div>
        </div>
    </nav>
    <!-- navigation left -->
    <script src="/public/assets/phong/phongLayout.js"></script>