<?php

namespace services\relation;

use models\Relation;
use services\IGeneralService;

require_once 'src/services/IGeneralService.php';

interface IRelationService extends IGeneralService
{
    public function getFriendForUser($user_id);

    public function sendFriendRequest($user_id, $user_target_id);

    public function unFriend($user_id, $user_target_id);

    public function acceptFriendRequest($user_id, $user_target_id);

    public function rejectFriendRequest($user_id, $user_target_id);

    public function blockUser($user_id, $user_target_id);

    public function unBlockUser($user_id, $user_target_id);

    public function followUser($user_id, $user_target_id);

    public function unFollowUser($user_id, $user_target_id);

    public function createRelation($user_id, $user_target_id, $type_relation);

    public function getFriendRequest($user_id);

    public function getRelationForUser($user_id, $type_relation);

    public function cancelFriendRequest($user_id, $user_target_id);

    public function getRelationBetweenUserAndUserTargetExceptFollow($user_id, $user_target_id);
}
