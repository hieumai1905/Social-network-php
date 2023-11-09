<?php

namespace DAO\conversations;
use models\Conversation;
require_once 'src/models/Conversation.php';

interface IConversationsDAO 
{
    public function getConversationByNameAndMgid($nameFrend, $curUserId);
    public function create(Conversation $conversation);
    // public function getCommentOfPost($postId):?array;
    // public function createCommentForPost(Comment $comment);
    // public function updateComment(Comment $comment);
    // public function deleteComment($commentId);
    
}