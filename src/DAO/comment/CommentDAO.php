<?php

namespace DAO\comment;
use PDO;
use models\Comment;

require_once 'src/DAO/Databases/ConnectDatabase.php';
require_once 'ICommentDAO.php';
require_once 'src/models/Comment.php';
class CommentDAO implements ICommentDAO
{
    private $connection;
    public function __construct(){
        $this->connection =\DAO\Databases\ConnectDatabase::getConnection();
    }

    public function getCommentOfPost($postId): ?array
    {
        // TODO: Implement getCommentOfPost() method.
        $stmt = $this->connection->prepare("SELECT * FROM comments WHERE post_id = :post_id ORDER BY comment_at DESC");
        $stmt->bindValue(':post_id', $postId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }


    public function createCommentForPost(Comment $comment)
    {
        // TODO: Implement createCommentForPost() method.
        $stmt = $this->connection->prepare("INSERT INTO comments (comment_id, comment_at,content, post_id, comment, user_id)
            VALUES (:comment_id, NOW(), :content, :post_id,, :user_id)");
        $stmt->bindValue(':post_id',$comment->getPostId());
        $stmt->bindValue(':content',$comment->getContent());
        $stmt->bindValue(':post_id',$comment->getPostId());
        $stmt->bindValue(':user_id',$comment->getUserId());
        $stmt->execute();
    }

    public function updateComment(Comment $comment)
    {
        // TODO: Implement updateComment() method.
        $stmt = $this->connection->prepare("UPDATE comments SET content = :content WHERE comment_id = :comment_id ");
        $stmt->bindValue(':contnent',$comment->getContent());
        $stmt->execute();
    }

    public function deleteComment($commentId)
    {
        // TODO: Implement deleteComment() method.
        $stmt = $this->connection->prepare("DELETE FROM comments WHERE comment_id = :comment_id");
        $stmt->bindValue(':comment_id',$commentId);
        $stmt->execute();
    }
}