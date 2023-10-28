<?php

namespace controllers;

use https\Response;
use models\Relation;
use services\relation\IRelationService;
use services\relation\RelationService;

class RelationController  {
    private $relationService;

    public function __construct(IRelationService $relationService)
    {
        $this->relationService = $relationService;
    }
    public function getFriendForUser ($user_id) {
        $this->relationService->getFriendForUser($user_id);
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
