<?php

namespace controllers;

use Google\Exception;
use Google\Service\ApigeeRegistry\Api;
use https\Response;
use https\Status;
use models\Notification;
use models\Relation;
use services\notification\NotificationService;
use services\relation\IRelationService;
use services\relation\RelationService;
use services\user\IUserService;
use storage\Mapper;

class RelationController
{
    private $relationService;
    private $userService;
    private $notificationService;

    public function __construct(IRelationService $relationService, IUserService $userService, NotificationService $notificationService)
    {
        $this->relationService = $relationService;
        $this->userService = $userService;
        $this->notificationService = $notificationService;
    }

//----------------------HTTP GET------------------------
    public function getFriendOfUser($user_id)
    {
        try {
            $result = $this->relationService->getFriendForUser($user_id);
            if (!$result) {
                return Response::view('views/Friend', ['friend' => []]);
            }
            $user = [];
            foreach ($result as $item) {
                $user[] = $this->userService->getById($item->getUserTargetId());
            }
            return Response::view('views/Friend', ['friend' => $user]);
        } catch (Exception $e) {
            return Response::view('views/Error', ['error' => $e->getMessage()]);
        }
    }

    public function getBlockUser()
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $result = $this->relationService->getRelationForUser($user->getUserId(), 'BLOCK');
            if (!$result) {
                return Response::view('views/Block', ['block' => []]);
            }
            $userBlocks = [];
            foreach ($result as $item) {
                $userBlocks[] = $this->userService->getById($item->getUserTargetId());
            }
            return Response::view('views/Block', ['block' => $userBlocks]);
        } catch (Exception $e) {
            return Response::view('views/Error', ['error' => $e->getMessage()]);
        }
    }

    public function getFriendRequestOfUser()
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $friendRequests = $this->relationService->getFriendRequest($user->getUserId());
            if (!$friendRequests) {
                return Response::apiResponse(Status::OK, 'success', []);
            }
            $data = [];
            foreach ($friendRequests as $item) {
                $data[] = Mapper::mapModelToJson($item);
            }
            return Response::apiResponse(Status::OK, 'success', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    public function getAllFriendOfUser()
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $userFriends = $this->relationService->getFriendForUser($user->getUserId());
            if (!$userFriends) {
                return Response::apiResponse(Status::OK, 'success', []);
            }
            $data = [];
            foreach ($userFriends as $item) {
                $data[] = Mapper::mapModelToJson($item);
            }
            return Response::apiResponse(Status::OK, 'success', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    public function getFollowOfUser()
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $userFollows = $this->relationService->getRelationForUser($user->getUserId(), 'FOLLOW');
            if (!$userFollows) {
                return Response::apiResponse(Status::OK, 'success', []);
            }
            $data = [];
            foreach ($userFollows as $item) {
                $data [] = Mapper::mapModelToJson($item);
            }
            return Response::apiResponse(Status::OK, 'success', $data);
        } catch (Exception $e) {
            Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    public function getBlockOfUser()
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $userBlocks = $this->relationService->getRelationForUser($user->getUserId(), 'BLOCK');
            if (!$userBlocks) {
                return Response::apiResponse(Status::OK, 'success', []);
            }
            $data = [];
            foreach ($userBlocks as $item) {
                $data [] = Mapper::mapModelToJson($item);
            }
            return Response::apiResponse(Status::OK, 'success', $data);
        } catch (Exception $e) {
            Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    public function getRequestOfUser()
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $userRequests = $this->relationService->getRelationForUser($user->getUserId(), 'REQUEST');
            if (!$userRequests) {
                return Response::apiResponse(Status::OK, 'success', []);
            }
            $data = [];
            foreach ($userRequests as $item) {
                $data [] = Mapper::mapModelToJson($item);
            }
            return Response::apiResponse(Status::OK, 'success', $data);
        } catch (Exception $e) {
            Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    public function getRequestForUser()
    {

    }

//----------------------HTTP POST------------------------
    public function sendFriendRequest($user_target_id)
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $notification = new Notification();
            $notification->setNotificationId(uniqid());
            $notification->setNotificationAt(date('d-M-y h:i:s A'));
            $notification->setContent('Bạn có lời mời kết bạn từ ' . $user->getFullName());
            $notification->setStatus('UNSEEN');
            $notification->setUserId($user->getUserId());
            $notification->setUrlTarget('http://localhost:8080/users/' . $user->getUserId());
            $notification->setUserRecipient($user_target_id);
            $this->notificationService->addNotificationWhenSendFriendRequest($notification);
            $this->relationService->sendFriendRequest($user->getUserId(), $user_target_id);
            return Response::apiResponse(Status::OK, 'success', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    public function blockUser($user_target_id)
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $this->relationService->blockUser($user->getUserId(), $user_target_id);
            $this->notificationService->deleteNotification($user->getUserId(),$user_target_id);
            return Response::apiResponse(Status::OK, 'success', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    public function followUser($user_target_id)
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $this->relationService->followUser($user->getUserId(), $user_target_id);
            return Response::apiResponse(Status::OK, 'success', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

//----------------------HTTP PUT------------------------
    public function acceptFriendRequest($user_target_id)
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $notification = new Notification();
            $notification->setNotificationId(uniqid());
            $notification->setNotificationAt(date('d-M-y h:i:s A'));
            $notification->setContent($user->getFullName() . ' đã chấp nhận lời mời kết bạn');
            $notification->setStatus('UNSEEN');
            $notification->setUserId($user->getUserId());
            $notification->setUrlTarget('http://localhost:8080/users/' . $user->getUserId());
            $notification->setUserRecipient($user_target_id);
            $this->notificationService->addNotificationWhenSendFriendRequest($notification);
            $this->relationService->acceptFriendRequest($user->getUserId(), $user_target_id);
            return Response::apiResponse(Status::OK, 'success', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

//----------------------HTTP DELETE------------------------
    public function unFriend($user_target_id)
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $this->relationService->unFriend($user->getUserId(), $user_target_id);
            return Response::apiResponse(Status::OK, 'success', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    public function rejectFriendRequest($user_target_id)
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $this->relationService->rejectFriendRequest($user->getUserId(), $user_target_id);
            return Response::apiResponse(Status::OK, 'success', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    public function unBlockUser($user_target_id)
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $this->relationService->unBlockUser($user->getUserId(), $user_target_id);
            return Response::apiResponse(Status::OK, 'success', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    public function unFollowUser($user_target_id)
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $this->relationService->unFollowUser($user->getUserId(), $user_target_id);
            return Response::apiResponse(Status::OK, 'success', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    public function cancelFriendRequest($user_target_id)
    {
        try {
            $user = unserialize($_SESSION['user-login']);
            $this->relationService->cancelFriendRequest($user->getUserId(), $user_target_id);
            $this->notificationService->deleteNotification($user->getUserId(),$user_target_id);
            return Response::apiResponse(Status::OK, 'success', null);
        } catch (Exception $e) {
            Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
}
