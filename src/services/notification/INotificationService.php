<?php

namespace services\notification;

use models\Notification;
use services\IGeneralService;

require_once 'src/services/IGeneralService.php';

interface INotificationService extends IGeneralService{
    public function addNotificationWhenSendFriendRequest(Notification $notification);
    public function getNotificationByUserRecipient($user_recipient);
}
