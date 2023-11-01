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
            $this->notificationService->updateNotificationStatus($user->getUserId());
            return Response::view('views/Notification',['notification'=>$notifications]);
        }catch (Exception $e) {
            return Response::view('views/Error',['error'=>$e->getMessage()]);
        }
    }
    public function countNotificationUnSeen() {
        try {
            $userLogin = unserialize($_SESSION['user-login']);
            $count = $this->notificationService->countNotificationUnSeen($userLogin->getUserId());
            return Response::apiResponse(Status::OK,'success',$count);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR,$e->getMessage(),null);
        }
    }
}
