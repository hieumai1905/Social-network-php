<?php

namespace services\like;
use models\Like;
use services\IGeneralService;

require_once 'src/services/IGeneralService.php';
interface ILikeService
{
    function getLikeOfPostByUserId($postId, $userId);
    function getLikeOfCommentByUserId($commentId, $userId);
    function getLikeOfCommentReplyByUserId($commentReplyId, $userId);
    function getLikeCountOfPost($postId);
    function getLikeCountOfComment($commentId);
    function getLikeCountOfCommentReply($commentReplyId);
    function addLikePost($postId, $userId);
    function addLikeComment($commentId, $userId);
    function addLikeCommentReply($commentReplyId, $userId);
    function deleteLikePost($postId, $userId);
    function deleteLikeComment($commentId, $userId);
    function deleteLikeCommentReply($commentReplyId, $userId);
    function deleteAllLikePost($postId);
    function deleteAllLikeComment($commentId);
    function deleteAllLikeCommentReply($commentReplyId);
}