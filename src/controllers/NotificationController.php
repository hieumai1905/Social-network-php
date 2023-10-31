<?php

namespace controllers;

use Google\Exception;
use Google\Service\ApigeeRegistry\Api;
use https\Response;
use https\Status;
use models\Notification;
use services\notification\INotificationService;
use services\notification\NotificationService;
use storage\Mapper;

class NotificationController {
    private $notificationService;

    public function __construct(INotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function getNotificationOfUser() {
        try {
            $user = unserialize($_SESSION['user-login']);
            $result = $this->notificationService->getNotificationByUserRecipient($user->getUserId());
            if (!$result) {
                return Response::view('views/Notification',['notification'=>[]]);
            }
            $notifications = [];
            foreach ($result as $item) {
                $notifications[] = $item;
            }
            return Response::view('views/Notification',['notification'=>$notifications]);
        }catch (Exception $e) {
            return Response::view('views/Error',['error'=>$e->getMessage()]);
        }
    }
}
