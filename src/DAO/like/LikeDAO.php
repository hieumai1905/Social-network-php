<?php

namespace DAO\like;
use PDO;
use models\Like;

require_once 'src/DAO/databases/ConnectDatabase.php';
require_once 'ILikeDAO.php';
require_once 'src/models/Like.php';
class LikeDAO implements ILikeDAO
{
    private $connection;
    public function __construct(){
        $this->connection = \DAO\Databases\ConnectDatabase::getConnection();
    }
    public function getLikeOfPostByUserId($postId, $userId)
    {
        // TODO: Implement getLikeOfPostByUserId() method.
        $stmt = $this->connection->prepare("SELECT * FROM likes WHERE user_id = :user_id AND post_id = :post_id");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':post_id', $postId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getLikeOfCommentByUserId($commentId, $userId)
    {
        // TODO: Implement getLikeOfCommentByUserId() method.
        $stmt = $this->connection->prepare("SELECT * FROM likes WHERE user_id = :user_id AND comment_id = :comment_id");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':comment_id', $commentId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getLikeOfCommentReplyByUserId($commentReplyId, $userId)
    {
        // TODO: Implement getLikeOfCommentReplyByUserId() method.
        $stmt = $this->connection->prepare("SELECT * FROM likes WHERE user_id = :user_id AND post_id = :comment_reply_id");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':comment_reply_id', $commentReplyId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getLikeCountOfPost($postId)
    {
        // TODO: Implement getLikeCountOfPost() method.
        $stmt = $this->connection->prepare("SELECT * FROM likes WHERE post_id = :post_id");
        $stmt->bindValue(':post_id',$postId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLikeCountOfComment($commentId)
    {
        // TODO: Implement getLikeCountOfComment() method.
        $stmt = $this->connection->prepare("SELECT * FROM likes WHERE comment_id = :comment_id");
        $stmt->bindValue(':comment_id', $commentId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLikeCountOfCommentReply($commentReplyId)
    {
        // TODO: Implement getLikeCountOfCommentReply() method.
        $stmt = $this->connection->prepare("SELECT * FROM likes WHERE comment_reply_id = :comment_reply_id");
        $stmt->bindValue(':comment_reply_id', $commentReplyId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addLikePost($postId, $userId)
    {
        // TODO: Implement addLikePost() method.
        $stmt = $this->connection->prepare("INSERT INTO likes (user_id, post_id) VALUES (:user_id, :post_id)");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':post_id', $postId);
        $stmt->execute();
    }

    public function addLikeComment($commentId, $userId)
    {
        // TODO: Implement addLikeComment() method.
        $stmt = $this->connection->prepare("INSERT INTO likes (user_id, comment_id) VALUES (:user_id,:comment_id)");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':comment_id', $commentId);
        $stmt->execute();
    }

    public function addLikeCommentReply($commentReplyId, $userId)
    {
        // TODO: Implement addLikeCommentReply() method.
        $stmt = $this->connection->prepare("INSERT INTO likes (user_id, comment_reply_id) VALUES (:user_id, :comment_reply_id)");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':comment_reply_id', $commentReplyId);
        $stmt->execute();
    }

    public function deleteLikePost($postId, $userId)
    {
        // TODO: Implement deleteLikePost() method.
        $stmt = $this->connection->prepare("DELETE FROM likes WHERE post_id = :post_id AND user_id = :user_id");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':post_id', $postId);
        $stmt->execute();
    }

    public function deleteLikeComment($commentId, $userId)
    {
        // TODO: Implement deleteLikeComment() method.
        $stmt = $this->connection->prepare("DELETE FROM likes WHERE comment_id = :comment_id AND user_id = :user_id");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':comment_id', $commentId);
        $stmt->execute();
    }

    public function deleteLikeCommentReply($commentReplyId, $userId)
    {
        // TODO: Implement deleteLikeCommentReply() method.
        $stmt = $this->connection->prepare("DELETE FROM likes WHERE comment_reply_id = :comment_reply_id AND user_id = :user_id");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':comment_reply_id', $commentReplyId);
        $stmt->execute();
    }

    public function deleteAllLikePost($postId)
    {
        // TODO: Implement deleteAllLikePost() method.
        $stmt = $this->connection->prepare("DELETE FROM likes WHERE post_id = :post_id");
        $stmt->bindValue(':post_id', $postId);
        $stmt->execute();
    }

    public function deleteAllLikeComment($commentId)
    {
        // TODO: Implement deleteAllLikeComment() method.
        $stmt = $this->connection->prepare("DELETE FROM likes WHERE comment_id = :post_id");
        $stmt->bindValue(':post_id', $commentId);
        $stmt->execute();
    }

    public function deleteAllLikeCommentReply($commentReplyId)
    {
        // TODO: Implement deleteAllLikeCommentReply() method.
        $stmt = $this->connection->prepare("DELETE FROM likes WHERE comment_reply_id = :comment_reply_id");
        $stmt->bindValue(':comment_reply_id', $commentReplyId);
        $stmt->execute();
    }
}