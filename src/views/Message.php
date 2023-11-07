<?php
    require_once "Layout-Header.php";
?>
    <!-- main content -->
    <div class="main-content right-chat-active">

        <div class="middle-sidebar-bottom">
            <div class="middle-sidebar-left pe-0 ps-lg-3 ms-0 me-0" style="max-width: 100%;">
                <div class="row">


                    <div class="col-lg-12 position-relative">
                        <div class="chat-wrapper pt-0 w-100 position-relative scroll-bar bg-white theme-dark-bg">
                            <div class="chat-body p-3 ">
                                <div id="messageContent" class="messages-content pb-5">

                                    <div class="message-item">
                                        <div class="message-user" style="display: inline-block">
                                            <figure class="avatar">
                                                <img src="images/user-7.png" alt="image">
                                            </figure>
                                        </div>
                                        <div class="message-wrap" style="display: inline-block;">asdsadsa</div>
                                    </div>

                                    <div class="message-item outgoing-message">
                                        <div class="message-wrap">dasdsadsa</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chat-bottom dark-bg p-3 shadow-none theme-dark-bg" style="width: 98%;">
                            <div class="chat-form"  style="border: 5px">
                                <button class="bg-grey float-left"><i class="ti-microphone text-grey-600"></i></button>
                                <div style="display:inline-block; width: 90%;"><input  id="inputMess" type="text" placeholder="Start typing.." style="color:#000;"></div>
                                <button id="sendBtn" class="bg-current"><i class="ti-arrow-right text-white"></i></button>
                            </div>
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
<!--<script src="~/assets/htd/messenger.js"></script>-->
<script src="public/js/plugin.js"></script>
<script src="public/js/lightbox.js"></script>
<script src="public/js/scripts.js"></script>
<!--<script src="~/assets/htd/contact.js"></script>-->
</body>

</html>
<!--<script src="~/assets/phong/phongLayoutSocial.js"></script>-->