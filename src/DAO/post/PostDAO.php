<?php

namespace DAO\post;

use PDO;
use models\Post;

require_once 'src/DAO/databases/ConnectDatabase.php';
require_once 'IPostDAO.php';
require_once 'src/models/Post.php';

class PostDAO implements IPostDAO
{

    private $connection;

    public function __construct(){
        $this->connection =\DAO\Databases\ConnectDatabase::getConnection();
    }
    // get all post for uesr's profile
    public function getPostForProfile($userId): ?array
    {
        $stmt = $this->connection->prepare("SELECT * FROM posts WHERE user_id = :user_id");
        $stmt->bindValue(':user_id',$userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    // get post by id
    public function getPostById($postId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM posts WHERE post_id = :post_id");
        $stmt->bindValue(':post_id', $postId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    //Get post for new feed
    public function getPostForHome(): ?array
    {
        $userId = unserialize($_SESSION['user-login']);
        $stmt = $this->connection->prepare("
            (SELECT p.post_id, create_at, content, access_modifier, post_type, p.user_id 
            FROM posts p INNER JOIN relations r on p.user_id = r.user_target_id 
            WHERE r.user_id = :user_id
            AND  ( r.type_relation = 'FRIEND' 
            OR    r.type_relation = 'FOLLOW')
            AND access_modifier = 'PUBLIC')
            UNION
            (SELECT * FROM posts WHERE user_id = :user_id)
            ");
        $stmt->bindValue(':user_id',$userId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllPost(): ?array
    {
        // TODO: Implement getAllPost() method.
        $stmt = $this->connection->prepare("SELECT * FROM posts");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
     public function getMonthPost(): ?array
     {
         // TODO: Implement getMonthPost() method.
         $stmt = $this->connection->prepare("SELECT * FROM posts WHERE MONTH(create_at) = MONTH(NOW()) AND YEAR(create_at) = YEAR(NOW())");
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_OBJ);
     }

    public function createPost(Post $post)
    {
        $userId = unserialize($_SESSION['user-login']);
        $stmt = $this->connection->prepare("INSERT INTO posts (post_id, create_at, content, access_modifier, post_type, user_id)
            VALUES (:postId, NOW(), :content, :accessModifier, :postType, :userId)");
        $stmt->bindValue(':postId',uniqid());
        $stmt->bindValue(':content',$post->getContent());
        $stmt->bindValue(':accessModifier',$post->getAccessModifier());
        $stmt->bindValue(':postType',$post->getPostType());
        $stmt->bindValue(':userId',$userId);
        $stmt->execute();
    }

    public function updatePost(Post $post)
    {
       $stmt = $this->connection->prepare("UPDATE posts SET content = :content, access_modifier = :accessModifier WHERE post_id = :postId");
       $stmt->bindValue(':postId', $post->getPostId());
       $stmt->bindValue(':content', $post->getContent());
       $stmt->bindValue(':accessModifier', $post->getAccessModifier());
       $stmt->execute();
    }

    public function deletePost($postId)
    {
        // TODO: Implement deletePost() method.
        $stmt = $this->connection->prepare("DELETE FROM posts WHERE post_id = :post_id");
        $stmt->bindValue(':post_id', $postId);
        $stmt->execute();
    }


}