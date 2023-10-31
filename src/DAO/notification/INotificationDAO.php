<?php

namespace DAO\notification;
use models\Notification;
require_once 'src/models/Notification.php';
interface INotificationDAO {
    public function addNotification(Notification $notification);
    public function getNotificationByUserRecipient($user_recipient);
}
