<?php

namespace controllers;

use Google\Exception;
use Google\Service\ApigeeRegistry\Api;
use https\Response;
use https\Status;
use models\Notification;
use services\notification\INotificationService;
use services\notification\NotificationService;
use services\user\IUserService;
use storage\Mapper;

class NotificationController {
    private $notificationService;
    private $userService;

    public function __construct(INotificationService $notificationService, IUserService $userService)
    {
        $this->notificationService = $notificationService;
        $this->userService = $userService;
    }

    public function getNotificationOfUser() {
        try {
            $user = unserialize($_SESSION['user-login']);
            $result = $this->notificationService->getNotificationByUserRecipient($user->getUserId());
            if (!$result) {
                return Response::view('views/Notification',['notification'=>[]]);
            }
            $notifications = [];
            $userSend = [];
            foreach ($result as $item) {
                $notifications[] = $item;
                $userSend[] = $this->userService->getById($item->getUserId());
            }
            $this->notificationService->updateNotificationStatus($user->getUserId());
            return Response::view('views/Notification',['notification'=>$notifications,'user'=>$userSend]);
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
