<?php

namespace DAO\relation;
use models\Relation;
require_once 'src\models\Relation.php';
interface IRelationDAO {
    public function getAllFriendByUserId ($user_id);

    public function addRelation(Relation $relation);

//    public function deleteFriendRelation($user_id, $user_target_id);

//    public function deleteFollowRelation($user_id, $user_target_id);

//    public function acceptFriendRequest($user_id,$user_target_id);
//
//    public function rejectFriendRequest($user_id,$user_target_id);

    public function deleteAllRelationByUserIdAndUserTargetId($user_id,$user_target_id);
    public function getRelation ($user_id, $user_target_id);
    public function deleteRelation($user_id,$user_target_id,$type_relation);
    public function updateTypeRelation($user_id,$user_target_id,$type_relation_before,$type_relation_after);
}
