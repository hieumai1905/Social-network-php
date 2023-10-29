<?php

namespace services\comment_reply;

use models\comment_replie;
use services\IGeneralService;
interface ICommentReplyService extends IGeneralService
{
    function getCommentReplyOfComment($commentId);
}