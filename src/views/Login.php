<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>O la la - Login</title>

    <link rel="stylesheet" href="public/css/themify-icons.css">
    <link rel="stylesheet" href="public/css/feather.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/fav-icon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="public/css/style.css">
    <!--    <script src="~/assets/hm/login.js"></script>-->
    <!--    <script src="~/assets/hm/user.js"></script>-->
    <!--    <script src="~/assets/hm/validation.js"></script>-->
</head>

<body class="color-theme-blue">

<div class="preloader">

</div>
<div class="main-wrap">

    <div class="nav-header bg-transparent shadow-none border-0">
        <div class="nav-top w-100">
            <a href="/login">
                <span>
                    <img src="public/images/fav-icon.png" alt="" style="width: 35px; height: 35px;"/>
                </span>
                &ensp;
                <span
                        class="d-inline-block fredoka-font ls-3 fw-600 text-current font-xxl logo-text mb-0">
                    O la la.
                </span>
            </a>
            <a href="#" class="mob-menu ms-auto me-2 chat-active-btn">
                <i
                        class="feather-message-circle text-grey-900 font-sm btn-round-md bg-greylight">
                </i>
            </a>
            <a href="/login" class="mob-menu me-2">
                <i
                        class="feather-video text-grey-900 font-sm btn-round-md bg-greylight">
                </i>
            </a>
            <a href="#" class="me-2 menu-search-icon mob-menu">
                <i
                        class="feather-search text-grey-900 font-sm btn-round-md bg-greylight">
                </i>
            </a>
            <button class="nav-menu me-0 ms-2"></button>

            <a href="#"
               class="header-btn d-none d-lg-block bg-dark fw-500 text-white font-xsss ms-auto w100 text-center lh-20 rounded-xl"
               data-bs-toggle="modal" data-bs-target="#Modallogin">
            </a>
            <a href="#"
               class="header-btn d-none d-lg-block bg-current fw-500 text-white font-xsss ms-2 w100 text-center lh-20 rounded-xl"
               data-bs-toggle="modal" data-bs-target="#Modalregister">
            </a>

        </div>


    </div>

    <div class="row">
        <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat"
             style="background-image: url(public/images/login-bg.jpg);">
        </div>
        <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
            <div class="card shadow-none border-0 ms-auto me-auto login-card"
                 style="min-width: 480px; max-width: 500px">
                <div class="card-body rounded-0 text-left">
                    <h2 class="fw-700 display1-size display2-md-size mb-3">Login into <br>your account</h2>
                    <form action="/login" method="post">
                        <div style="margin-bottom:10px; margin-top: -5px ;">
<!--                            <i style="color:red; font-size: 14px; display: none" id="login-invalid">Email or Password-->
<!--                                invalid!</i>-->
                            <?php
                                if(isset($error)){
                                    echo '<i style="color:red; font-size: 14px;" id="login-invalid">'.$error.'</i>';
                                }
                            ?>
                        </div>
                        <div class="form-group icon-input mb-3">
                            <i class="font-sm ti-email text-grey-500 pe-0"></i>
                            <input type="text"
                                   class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600 input-email-login"
                                   placeholder="Your Email Address" name="email">
                        </div>
                        <div class="form-group icon-input mb-1">
                            <input type="Password" name="password"
                                   class="style2-input ps-5 form-control text-grey-900 font-xss ls-3 input-password-login"
                                   placeholder="Password">
                            <i class="font-sm ti-lock text-grey-500 pe-0"></i>
                        </div>
                        <div class="form-check text-left mb-3">
                            <a href="/account/forgot" class="fw-600 font-xsss text-grey-700 mt-1 float-right">
                                Forgot your
                                Password?
                            </a>
                        </div>
                        <div class="col-sm-12 p-0 text-left" style="margin-top: 40px;">
                            <div class="form-group mb-1">
                                <p
                                        class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 choose-login"
                                        style="cursor:pointer">
                                    <input type="submit" value="Login" class="bg-dark"
                                           style="border: none; color: white; width: 95%">
                                </p>
                            </div>
                            <h6 class="text-grey-500 font-xsss fw-500 mt-0 mb-0 lh-32">
                                Don't have account
                                <a
                                        href="/register" class="fw-700 ms-1">
                                    Register
                                </a>
                            </h6>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>

<script src="public/js/plugin.js"></script>
<script src="public/js/scripts.js"></script>

</body>

</html>