<?php

namespace services\like;

require_once 'src/services/IGeneralService.php';

interface ILikeService
{
    function getLikeOfPostByUserId($postId);

    function getLikeOfCommentByUserId($commentId);

    function getLikeOfCommentReplyByUserId($commentReplyId);

    function getLikeCountOfPost($postId);

    function getLikeCountOfComment($commentId);

    function getLikeCountOfCommentReply($commentReplyId);

    function addLikePost($postId);

    function addLikeComment($commentId);

    function addLikeCommentReply($commentReplyId);

    function deleteLikePost($postId);

    function deleteLikeComment($commentId);

    function deleteLikeCommentReply($commentReplyId);

    function deleteAllLikePost($postId);

    function deleteAllLikeComment($commentId);

    function deleteAllLikeCommentReply($commentReplyId);
}