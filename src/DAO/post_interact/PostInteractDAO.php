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

    public function getFavoritePost($userId): ?array
    {
        // TODO: Implement getFavoritePost() method.
        $stmt = $this->connection->prepare("SELECT * FROM post_interacts WHERE user_id = :user_id AND type = :type");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':type', 'SAVE');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function addFavoritePost($userId, $postId)
    {
        // TODO: Implement addFavoritePost() method.
        $stmt = $this->connection->prepare("INSERT INTO post_interacts (user_id, post_id, content, type) VALUES (:user_id, :post_id, :content, :type)");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':post_id', $postId);
        $stmt->bindValue(':content', '');
        $stmt->bindValue(':type','SAVE');
        $stmt->execute();
    }

    public function deleteFavoritePost($userId, $postId)
    {
        // TODO: Implement deleteFavoritePost() method.
        $stmt = $this->connection->prepare("DELETE FROM post_interacts WHERE post_id = :postId AND user_id = :userId");
        $stmt->bindValue(':postId',$postId);
        $stmt->bindValue(':userId',$userId);
        $stmt->execute();
    }

//    public function getHiddenPost($userId)
//    {
//        // TODO: Implement getHiddenPost() method.
//    }

    public function addHiddenPost($userId, $postId)
    {
        // TODO: Implement addHiddenPost() method.
        $stmt = $this->connection->prepare("INSERT INTO post_interacts (user_id, post_id, content, type) VALUES (:user_id, :post_id, :content, :type)");
        $stmt->bindValue(':user_id', $userId);
        $stmt->bindValue(':post_id', $postId);
        $stmt->bindValue(':content', '');
        $stmt->bindValue(':type','HIDDEN');
        $stmt->execute();
    }

    public function addReportPost(PostInteract $postInteract)
    {
        // TODO: Implement addReportPost() method.
        $stmt = $this->connection->prepare("INSERT INTO post_interacts (user_id, post_id, content, type) VALUES (:user_id, :post_id, :content, :type)");
        $stmt->bindValue(':user_id', $postInteract->getUserId());
        $stmt->bindValue(':post_id', $postInteract->getPostId());
        $stmt->bindValue(':content', $postInteract->getContent());
        $stmt->bindValue(':type','REPORT');
        $stmt->execute();
    }
}