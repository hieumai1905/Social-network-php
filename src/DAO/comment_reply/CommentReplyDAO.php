<?php

namespace DAO\comment_reply;
use PDO;
use models\CommentReplie;

require_once 'src/DAO/databases/ConnectDatabase.php';
require_once 'ICommentReplyDAO.php';
require_once 'src/models/CommentReplie.php';
class CommentReplyDAO implements ICommentReplyDAO
{
    private $connection;
    public function __construct(){
        $this->connection = \DAO\Databases\ConnectDatabase::getConnection();
    }
    public function getCommentReplyOfComment($commentId): ?array
    {
        // TODO: Implement getCommentReplyOfComment() method.
        $stmt = $this->connection->prepare("SELECT * FROM comment_replies WHERE comment_id = :comment_id");
        $stmt->bindValue(':comment_id', $commentId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function createCommentReply(CommentReplie $commentReply)
    {
        // TODO: Implement createCommentReply() method.
        $stmt = $this->connection->prepare("INSERT INTO comment_replies (comment_reply_id, reply_at, content, user_id, comment_id)
            VALUES (:comment_reply_id, NOW(), :content, :user_id, :comment_id)");
        $stmt->bindValue(':comment_reply_id', $commentReply->getCommentReplyId());
        $stmt->bindValue(':content', $commentReply->getContent());
        $stmt->bindValue(':user_id', $commentReply->getUserId());
        $stmt->bindValue(':comment_id', $commentReply->getCommentId());
        $stmt->execute();
    }

    public function updateCommentReply(CommentReplie $commentReply)
    {
        // TODO: Implement updateCommentReply() method.
        $stmt = $this->connection->prepare("UPDATE comment_replies SET content = :content WHERE comment_reply_id = :comment_reply_id");
        $stmt->bindValue(':content', $commentReply->getContent());
        $stmt->bindValue(':comment_reply_id', $commentReply->getCommentReplyId());
        $stmt->execute();
    }

    public function deleteCommentReply($commentReplyId)
    {
        // TODO: Implement deleteCommentReply() method.
        $stmt = $this->connection->prepare("DELETE FROM comment_replies WHERE comment_reply_id = :comment_reply_id");
        $stmt->bindValue(':comment_reply_id', $commentReplyId);
        $stmt->execute();
    }
}