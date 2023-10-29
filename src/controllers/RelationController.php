<?php

namespace controllers;

use https\Response;
use models\Relation;
use services\relation\IRelationService;
use services\relation\RelationService;
use services\user\IUserService;

class RelationController  {
    private $relationService;
    private $userService;

    public function __construct(IRelationService $relationService,IUserService $userService)
    {
        $this->relationService = $relationService;
        $this->userService = $userService;
    }
    public function getFriendForUser ($user_id) {
        $result = $this->relationService->getFriendForUser($user_id);
        $user = [];
        foreach ($result as $item) {
            $user[] = $this->userService->getById($item->getUserTargetId());
        }
        return Response::view('views/Friend',['friend'=>$user]);
    }
    public function sendFriendRequest($user_id,$user_target_id) {
        $this->relationService->sendFriendRequest($user_id,$user_target_id);
    }
    public function unFriend($user_id,$user_target_id) {
        $this->relationService->unFriend($user_id,$user_target_id);
    }
    public function acceptFriendRequest ($user_id, $user_target_id) {
        $this->relationService->acceptFriendRequest($user_id,$user_target_id);
    }
    public function rejectFriendRequest($user_id,$user_target_id) {
        $this->relationService->rejectFriendRequest($user_id,$user_target_id);
    }
    public function blockUser($user_id,$user_target_id) {
        $this->relationService->blockUser($user_id,$user_target_id);
    }
    public function unBlockUser($user_id,$user_target_id) {
        $this->relationService->unBlockUser($user_id,$user_target_id);
    }
    public function followUser($user_id,$user_target_id) {
        $this->relationService->followUser($user_id,$user_target_id);
    }
    public function unFollowUser($user_id,$user_target_id) {
        $this->relationService->unFollowUser($user_id,$user_target_id);
    }
}
