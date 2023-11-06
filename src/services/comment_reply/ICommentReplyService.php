<?php

namespace services\comment_reply;

use services\IGeneralService;

interface ICommentReplyService extends IGeneralService
{
    function getCommentReplyOfComment($commentId);
}