<?php

namespace DAO\like;
use models\Like;
require_once 'src/models/Like.php';
interface ILikeDAO
{
    public function getLikeOfPostByUserId($postId, $userId);
    public function getLikeOfCommentByUserId($commentId, $userId);
    public function getLikeOfCommentReplyByUserId($commentReplyId, $userId);
    public function getLikeCountOfPost($postId);
    public function getLikeCountOfComment($commentId);
    public function getLikeCountOfCommentReply($commentReplyId);
    public function addLikePost($postId, $userId);
    public function addLikeComment($commentId, $userId);
    public function addLikeCommentReply($commentReplyId, $userId);
    public function deleteLikePost($postId, $userId);
    public function deleteLikeComment($commentId, $userId);
    public function deleteLikeCommentReply($commentReplyId, $userId);
    public function deleteAllLikePost($postId);
    public function deleteAllLikeComment($commentId);
    public function deleteAllLikeCommentReply($commentReplyId);
}