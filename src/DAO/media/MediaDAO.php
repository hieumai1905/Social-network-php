<?php

namespace DAO\media;

use PDO;
use models\Media;

require_once 'src/DAO/databases/ConnectDatabase.php';
require_once 'IMediaDAO.php';
require_once 'src/models/Media.php';
class MediaDAO implements IMediaDAO
{
    private $connection;
    public function __construct(){
        $this->connection = \DAO\databases\ConnectDatabase::getConnection();
    }

    public function getMediaOfPost($postId): ?array
    {
        // TODO: Implement getMediaOfPost() method.
        $stmt = $this->connection->prepare("SELECT * FROM medias WHERE post_id = :post_id");
        $stmt->bindValue(':post_id', $postId);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteMediaOfPost($postId)
    {
        // TODO: Implement deleteMediaOfPost() method.
        $stmt = $this->connection->prepare("DELETE FROM medias WHERE post_id = :post_id");
        $stmt->bindValue(':post_id', $postId);
        $stmt->execute();
    }

//    public function getAvatarOfUser($userId)
//    {
//        // TODO: Implement getAvatarOfUser() method.
//        $stmt = $this->connection->prepare("SELECT m.media_id, url, type, m.post_id
//            FROM medias INNER JOIN posts p on m.post_id = p.post_id
//            WHERE user_id = :user_id AND post_type = :post_type
//            ORDER BY create_at DESC");
//        $stmt->bindValue(':user_id', $userId);
//        $stmt->bindValue(':post_type', 'AVATAR');
//        $stmt->execute();
//        return $stmt->fetch(PDO::FETCH_OBJ);
//    }
//
//    public function getCoverImageOfUser($userId)
//    {
//        // TODO: Implement getCoverImageOfUser() method.
//        $stmt = $this->connection->prepare("SELECT m.media_id, url, type, m.post_id
//            FROM medias INNER JOIN posts p on m.post_id = p.post_id
//            WHERE user_id = :user_id AND post_type = :post_type
//            ORDER BY create_at DESC");
//        $stmt->bindValue(':user_id', $userId);
//        $stmt->bindValue(':post_type', 'COVER');
//        $stmt->execute();
//        return $stmt->fetch(PDO::FETCH_OBJ);
//    }

}