<?php

namespace DAO\like;
use models\Like;
require_once 'src/models/Like.php';
interface ILikeDAO
{
    public function getLikeOfPostByUserId($postId);
    public function getLikeOfCommentByUserId($commentId);
    public function getLikeOfCommentReplyByUserId($commentReplyId);
    public function getLikeCountOfPost($postId);
    public function getLikeCountOfComment($commentId);
    public function getLikeCountOfCommentReply($commentReplyId);
    public function addLikePost($postId);
    public function addLikeComment($commentId);
    public function addLikeCommentReply($commentReplyId);
    public function deleteLikePost($postId);
    public function deleteLikeComment($commentId);
    public function deleteLikeCommentReply($commentReplyId);
    public function deleteAllLikePost($postId);
    public function deleteAllLikeComment($commentId);
    public function deleteAllLikeCommentReply($commentReplyId);
}