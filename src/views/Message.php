<?php
require_once "Layout-Header.php";


?>
<!-- main content -->
<!--                <input type="text" name="" id="" value="-->
<?php //echo $userId ?><!--">-->
<div class="main-content right-chat-active">

    <div class="middle-sidebar-bottom">
        <div class="middle-sidebar-left pe-0 ps-lg-3 ms-0 me-0" style="max-width: 100%;">
            <div class="row">
                <div class="col-lg-12 position-relative">
                    <div class="chat-wrapper pt-0 w-100 position-relative scroll-bar bg-white theme-dark-bg">
                        <div class="shadow-lg p-3 mb-5 bg-white rounded" style="display: flex;">
                            <img class="rounded-circle" src="<?php echo $avatarTest ?>"
                                 style="width: 50px; height: 50px;">
                            <h4 class="pt-2 pl-3"><?php echo $_GET['name'] ?? "" ?></h4>
                        </div>
                        <div class="chat-body p-3 ">
                            <div id="messageContent" class="messages-content pb-5">

                                <div id="conversation">

                                    <?php
                                    //                                    if (!$mesg) {
                                    foreach ($mesg as $key => $value) {
                                        // echo $value->getContent();
                                        // echo $value->getSenderId();
                                        if ($value->getSenderId() == $userId) {
                                            $content = $value->getContent();
                                            echo "
                                                        <div class='message-item outgoing-message' style='margin-left: 500px;'>
                                                            <div class='message-wrap'>$content</div>
                                                        </div>
                                                        ";
                                        } else {
                                            $content = $value->getContent();
                                            echo "
                                                        <div class='message-item'>
                                                            <div class='message-user' style='display: inline-block'>
                                                           
                                                            </div>
                                                        <div class='message-wrap' style='display: inline-block;'>$content</div>
                                                        </div>
                                                    ";
                                        }
//                                        }
                                    }
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="chat-bottom dark-bg p-3 shadow-none theme-dark-bg" style="width: 98%;">
                        <div class="chat-form" style="border: 5px">
                            <button class="bg-grey float-left" id="startButton" style="margin-right:10px;"><i
                                        class="ti-microphone text-grey-600"></i></button>
                            <div style="border: 1px solid;display:inline-block;width: 90%;border-radius: 20px;">
                                <input id="chat_message" name="chat_message" type="text" placeholder="Start typing.."
                                       style="color:#000;">
                            </div>
                            <button id="sendBtn" class="bg-current"><i class="ti-arrow-right text-white"></i></button>
                        </div>
                    </div>

                    <script>
                        const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                        if (SpeechRecognition) {
                            const recognition = new SpeechRecognition();
                            recognition.lang = 'vi-VN';

                            const startButton = document.getElementById('startButton');
                            const transcriptionInput = document.getElementById('chat_message');

                            startButton.addEventListener('click', () => {
                                recognition.start();
                                startButton.disabled = true;
                                startButton.style.backgroundColor = 'red';
                                startButton.innerHTML = '<i>...</i>';
                            });

                            recognition.addEventListener('result', (event) => {
                                const transcript = event.results[0][0].transcript;
                                transcriptionInput.value += transcript;
                                transcriptionInput.focus();
                            });

                            recognition.addEventListener('end', () => {
                                startButton.disabled = false;
                                startButton.style.backgroundColor = 'grey';
                                startButton.innerHTML = '<i class="ti-microphone text-grey-600"></i>';
                            });
                        } else {
                            alert('Trình duyệt của bạn không hỗ trợ ghi âm!');
                        }
                    </script>

                </div>
            </div>
            <input type="hidden" id="userId" value="<?php echo $userId ?>">
            <input type="hidden" id="riendId" value="<?php echo $friendId ?>">
            <input type="hidden" id="conver" value="<?php echo $conver ?>">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="/public/js/quynhchatsocket.js">
</script>
<!--<script src="~/assets/htd/contact.js"></script>-->

</body>