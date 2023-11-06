<?php

namespace DAO\notification;

use DAO\Databases\ConnectDatabase;
use PDO;
use models\Notification;

require_once 'src/DAO/databases/ConnectDatabase.php';
require_once 'INotificationDAO.php';
require_once 'src/models/Notification.php';

class NotificationDAO implements INotificationDAO
{
    private $connection;

    public function __construct()
    {
        $this->connection = ConnectDatabase::getConnection();
    }

    public function addNotification(Notification $notification)
    {
        $stsm = $this->connection->prepare('INSERT INTO notifications (notification_id, content, notification_at, status, url_target,user_id,user_recipient)
                                VALUES (:notification_id, :content, :notification_at, :status, :url_target,:user_id,:user_recipient)');
        $stsm->bindValue('notification_id', $notification->getNotificationId());
        $stsm->bindValue('content', $notification->getContent());
        $stsm->bindValue('notification_at', $notification->getNotificationAt());
        $stsm->bindValue('status', $notification->getStatus());
        $stsm->bindValue('url_target', $notification->getUrlTarget());
        $stsm->bindValue('user_id', $notification->getUserId());
        $stsm->bindValue('user_recipient', $notification->getUserRecipient());
        $stsm->execute();
    }

    public function getNotificationByUserRecipient($user_recipient)
    {
        $stmt = $this->connection->prepare('SELECT * FROM notifications WHERE user_recipient = :user_recipient');
        $stmt->bindValue('user_recipient', $user_recipient);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateNotification($user_recipient)
    {
        $stmt = $this->connection->prepare('Update notifications set status = :status where user_recipient = :user_recipient');
        $stmt->bindValue('status', 'SEEN');
        $stmt->bindValue('user_recipient', $user_recipient);
        $stmt->execute();
    }

    public function getNotificationUnSeen($user_recipient)
    {
        $stmt = $this->connection->prepare('SELECT * FROM notifications WHERE user_recipient = :user_recipient and status = :status');
        $stmt->bindValue('user_recipient', $user_recipient);
        $stmt->bindValue('status', 'UNSEEN');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}
