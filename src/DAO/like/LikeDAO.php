<?php

namespace DAO\like;
use PDO;
use models\Like;

require_once 'src/DAO/Databases/ConnectDatabase.php';
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
    }

    public function getLikeOfCommentByUserId($commentId, $userId)
    {
        // TODO: Implement getLikeOfCommentByUserId() method.
        $stmt = $this->connection->prepare("SELECT * FROM likes WHERE user_id = :user_id AND comment_id = :comment_id");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':comment_id', $commentId);
        $stmt->execute();
    }

    public function getLikeOfCommentReplyByUserId($commentReplyId, $userId)
    {
        // TODO: Implement getLikeOfCommentReplyByUserId() method.
        $stmt = $this->connection->prepare("SELECT * FROM likes WHERE user_id = :user_id AND post_id = :comment_reply_id");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':comment_reply_id', $commentReplyId);
        $stmt->execute();
    }
    public function getLikeCountOfPost($postId)
    {
        // TODO: Implement getLikeCountOfPost() method.
        $stmt = $this->connection->prepare("SELECT count(*) FROM likes WHERE post_id = :post_id");
        $stmt->bindValue(':post_id',$postId);
        $stmt->execute();
    }

    public function getLikeCountOfComment($commentId)
    {
        // TODO: Implement getLikeCountOfComment() method.
        $stmt = $this->connection->prepare("SELECT count(*) FROM likes WHERE comment_id = :comment_id");
        $stmt->bindValue(':comment_id', $commentId);
        $stmt->execute();
    }

    public function getLikeCountOfCommentReply($commentReplyId)
    {
        // TODO: Implement getLikeCountOfCommentReply() method.
        $stmt = $this->connection->prepare("SELECT count(*) FROM likes WHERE comment_reply_id = :comment_reply_id");
        $stmt->bindValue(':comment_reply_id', $commentReplyId);
        $stmt->execute();
    }

    public function addLikePost($postId, $userId)
    {
        // TODO: Implement addLikePost() method.
        $stmt = $this->connection->prepare("INSERT INTO likes (like_id, user_id, post_id, comment_id, comment_reply_id) 
            VALUES (:like_id, :post_id, :user_id, :post_id,:comment_id,:comment_reply_id)");
        $stmt->bindValue('like_id', uniqid());
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':post_id', $postId);
        $stmt->bindValue(':comment_id', '');
        $stmt->bindValue(':comment_reply_id', '');
        $stmt->execute();
    }

    public function addLikeComment($commentId, $userId)
    {
        // TODO: Implement addLikeComment() method.
        $stmt = $this->connection->prepare("INSERT INTO likes (like_id, user_id, post_id, comment_id, comment_reply_id) 
            VALUES (:like_id, :post_id, :user_id, :post_id,:comment_id,:comment_reply_id)");
        $stmt->bindValue('like_id', uniqid());
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':post_id', '');
        $stmt->bindValue(':comment_id', $commentId);
        $stmt->bindValue(':comment_reply_id', '');
        $stmt->execute();
    }

    public function addLikeCommentReply($commentReplyId, $userId)
    {
        // TODO: Implement addLikeCommentReply() method.
        $stmt = $this->connection->prepare("INSERT INTO likes (like_id, user_id, post_id, comment_id, comment_reply_id) 
            VALUES (:like_id, :post_id, :user_id, :post_id,:comment_id,:comment_reply_id)");
        $stmt->bindValue('like_id', uniqid());
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':post_id', '');
        $stmt->bindValue(':comment_id', '');
        $stmt->bindValue(':comment_reply_id', $commentReplyId);
        $stmt->execute();
    }

    public function deleteLikePost($postId, $userId)
    {
        // TODO: Implement deleteLikePost() method.
        $stmt = $this->connection->prepare("DELETE FROM likes WHERE post_id = :post_id AND user_id = :user");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':post_id', $postId);
        $stmt->excute();
    }

    public function deleteLikeComment($commentId, $userId)
    {
        // TODO: Implement deleteLikeComment() method.
        $stmt = $this->connection->prepare("DELETE FROM likes WHERE comment_id = :comment_id AND user_id = :user");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':comment_id', $commentId);
        $stmt->excute();
    }

    public function deleteLikeCommentReply($commentReplyId, $userId)
    {
        // TODO: Implement deleteLikeCommentReply() method.
        $stmt = $this->connection->prepare("DELETE FROM likes WHERE comment_reply_id = :comment_reply_id AND user_id = :user");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':comment_reply_id', $commentReplyId);
        $stmt->excute();
    }


}