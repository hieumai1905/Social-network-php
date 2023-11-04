<?php

namespace DAO\post_interact;

use PDO;
use models\PostInteract;

require_once 'src/DAO/databases/ConnectDatabase.php';
require_once 'IPostInteractDAO.php';
require_once 'src/models/PostInteract.php';
class PostInteractDAO implements IPostInteractDAO
{
    private $connection;
    public function __construct(){
        $this->connection = \DAO\Databases\ConnectDatabase::getConnection();
    }

    public function getFavoritePost(): ?array
    {
        // TODO: Implement getFavoritePost() method.
        $userId = unserialize($_SESSION['user-login'])->getUserId();
        $stmt = $this->connection->prepare("SELECT * FROM post_interacts WHERE user_id = :user_id AND type = :type");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':type', 'SAVE');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function addFavoritePost($postId)
    {
        // TODO: Implement addFavoritePost() method.
        $userId = unserialize($_SESSION['user-login'])->getUserId();
        $stmt = $this->connection->prepare("INSERT INTO post_interacts (user_id, post_id, content, type) VALUES (:user_id, :post_id, :content, :type)");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':post_id', $postId);
        $stmt->bindValue(':content', 'Lưu để bóc phốt');
        $stmt->bindValue(':type','SAVE');
        $stmt->execute();
    }

    public function deleteFavoritePost($postId)
    {
        // TODO: Implement deleteFavoritePost() method.
        $userId = unserialize($_SESSION['user-login'])->getUserId();
        $stmt = $this->connection->prepare("DELETE FROM post_interacts WHERE post_id = :postId AND user_id = :userId");
        $stmt->bindValue(':postId',$postId);
        $stmt->bindValue(':userId',$userId);
        $stmt->execute();
    }

//    public function getHiddenPost($userId)
//    {
//        // TODO: Implement getHiddenPost() method.
//    }

    public function addHiddenPost($postId)
    {
        // TODO: Implement addHiddenPost() method.
        $userId = unserialize($_SESSION['user-login'])->getUserId();
        $stmt = $this->connection->prepare("INSERT INTO post_interacts (user_id, post_id, content, type) VALUES (:user_id, :post_id, :content, :type)");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':post_id', $postId);
        $stmt->bindValue(':content', 'Nhìn thấy không vui');
        $stmt->bindValue(':type','HIDDEN');
        $stmt->execute();
    }

    public function addReportPost(PostInteract $postInteract)
    {
        // TODO: Implement addReportPost() method.
        $userId = unserialize($_SESSION['user-login'])->getUserId();
        $stmt = $this->connection->prepare("INSERT INTO post_interacts (user_id, post_id, content, type) VALUES (:user_id, :post_id, :content, :type)");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':post_id', $postInteract->getPostId());
        $stmt->bindValue(':content', $postInteract->getContent());
        $stmt->bindValue(':type','REPORT');
        $stmt->execute();
    }

    public function getFavoriteById($postId)
    {
        // TODO: Implement getFavoriteById() method.
        $userId = unserialize($_SESSION['user-login'])->getUserId();
        $stmt = $this->connection->prepare("SELECT * FROM post_interacts WHERE user_id = :user_id AND type = :type AND post_id = :post_id");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':type', 'SAVE');
        $stmt->bindValue(':post_id', $postId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}