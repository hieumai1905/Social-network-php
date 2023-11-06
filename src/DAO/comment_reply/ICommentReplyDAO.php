<?php

namespace DAO\comment_reply;

use models\CommentReplie;

require_once 'src/models/CommentReplie.php';

interface ICommentReplyDAO
{
    public function getCommentReplyOfComment($commentId): ?array;

    public function createCommentReply(CommentReplie $commentReply);

    public function updateCommentReply(CommentReplie $commentReply);

    public function deleteCommentReply($commentReplyId);


}