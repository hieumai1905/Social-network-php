<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>O la la - Confirm</title>

    <link rel="stylesheet" href="public/css/themify-icons.css">
    <link rel="stylesheet" href="public/css/feather.css">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="public/images/fav-icon.png">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="public/css/style.css">
<!--    <script src="~/assets/hm/confirm-code.js"></script>-->
<!--    <script src="~/assets/hm/user.js"></script>-->


</head>

<body class="color-theme-blue">

<div class="preloader"></div>

<div class="main-wrap">


    <div class="nav-header bg-transparent shadow-none border-0">
        <div class="nav-top w-100">
            <a href="/">
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
            <a href="/" class="mob-menu me-2">
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

            <a href="login"
               class="header-btn d-none d-lg-block bg-dark fw-500 text-white font-xsss p-3 ms-auto w100 text-center lh-20 rounded-xl">
                Login
            </a>
            <a href="/register"
               class="header-btn d-none d-lg-block bg-current fw-500 text-white font-xsss p-3 ms-2 w100 text-center lh-20 rounded-xl">
                Register
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-5 d-none d-xl-block p-0 vh-100 bg-image-cover bg-no-repeat"
             style="background-image: url(public/images/login-bg-2.jpg);">
        </div>
        <div class="col-xl-7 vh-100 align-items-center d-flex bg-white rounded-3 overflow-hidden">
            <div class="card shadow-none border-0 ms-auto me-auto login-card">
                <!--                <div class="card-body rounded-0 text-left">-->
                <!--                    <h2 class="fw-700 display1-size display2-md-size mb-4">Reset <br>your password</h2>-->

                <!--                    <p>We'll email you instructions to reset the password.</p>-->
                <!--                    <form>-->
                <!--                        <div style="font-size: 23px;" class="style2-input text-grey-900 font-xss ls-3">-->
                <!--                            <label for="_mail" style="margin-left:5px">Email</label>-->
                <!--                        </div>-->
                <!--                        <div class="form-group icon-input mb-3">-->
                <!--                            <i class="font-sm ti-email text-grey-500 pe-0"></i>-->
                <!--                            <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600"-->
                <!--                                   placeholder="Enter Email Address" id="_mail">-->
                <!--                        </div>-->
                <!--                    </form>-->

                <!--                    <div class="col-sm-12 p-0 text-left">-->
                <!--                        <div class="form-group mb-1"><a href="login.html"-->
                <!--                                                        class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 ">Reset-->
                <!--                            Password</a></div>-->

                <!--                    </div>-->

                <!--                </div>-->


                <!--                After send code-->


                <div class="card-body rounded-0 text-left">
                    <h2 class="fw-700 display1-size display2-md-size mb-4">Done!</h2>

                    <div style="background-color: #8dbb8d; border-radius: 7px;">
                        <p style="padding:10px;">
                            We’ve sent an email to <span id="email-current"></span> with
                            instructions.
                        </p>
                    </div>
                    <div class="col-sm-12 p-0 text-left" style="display: inline-block;">
                        <p style="display: inline-block;">Time: 00:<span id="time-code">60</span></p>
                        <p id="send-code-register" style="color:red; float: right; font-size:14px ; cursor:pointer; display: inline-block;">
                            Reset code
                        </p>
                    </div>
                    <form>
                        <div class="form-group icon-input mb-3">
                            <input type="text" class="style2-input ps-5 form-control text-grey-900 font-xsss fw-600 " id="input-confirm-code"
                                   placeholder="Enter code">
                        </div>
                    </form>

                    <div class="col-sm-12 p-0 text-left" style="display: block;">
                        <p style="color:red; font-size:14px ; cursor:pointer; display: none" id="error-confirm-code">
                            Reset code
                        </p>
                    </div>
                    <div class="col-sm-12 p-0 text-left">
                        <div class="form-group mb-1">
                            <button
                                class="form-control text-center style2-input text-white fw-600 bg-dark border-0 p-0 choose-confirm-code">
                                Continue
                            </button>
                        </div>

                    </div>
                    <div style="margin-bottom: 20px;">
                        <i>
                            If the email doesn't show up soon, check your spam folder. We sent it from
                            login@olala.com.
                        </i>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="public/js/plugin.js"></script>
<script src="public/js/scripts.js"></script>

</body>

</html>