<?php

namespace DAO\comment;
use models\comment;
require_once 'src/models/Comment.php';
interface ICommentDAO
{
    public function getCommentOfPost($postId):?array;
    public function createCommentForPost(Comment $comment);
    public function updateComment(Comment $comment);
    public function deleteComment($commentId);

}