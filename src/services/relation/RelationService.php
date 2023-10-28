<?php

namespace services\relation;

use DAO\relation\IRelationDAO;
use models\Relation;
use services\IGeneralService;
use storage\Logger;
use storage\Mapper;
require_once 'IRelationService.php';
require_once 'src/storage/Logger.php';
require_once 'src/storage/Mapper.php';
require_once 'src/models/Relation.php';

class RelationService implements IRelationService {
    private $relationDAO;

    public function __construct(IRelationDAO $relationDAO)
    {
        $this->relationDAO = $relationDAO;
    }


    function getAll(): ?array
    {
        // TODO: Implement getAll() method.
        return 0;
    }

    function getById($id): ?object
    {
        // TODO: Implement getById() method.
        return 0;
    }

    function add($object)
    {
        // TODO: Implement add() method.
    }

    function update($object)
    {
        // TODO: Implement update() method.
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function getFriendForUser($user_id)
    {
        try {
            $result = $this->relationDAO->getAllFriendByUserId($user_id);
            Logger::log("Get friend successfully");
            if (!$result) {
                Logger::log('No friend for user found');
                return null;
            }
            return Mapper::mapStdClassToModel($result,Relation::class);
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        }catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public function sendFriendRequest($user_id, $user_target_id)
    {
        try {
            $relationWaiting = new Relation();
            $relationWaiting->setRelationId(uniqid());
            $relationWaiting->setTypeRelation("WAITING");
            $relationWaiting->setChangeAt(date("Y-m-d"));
            $relationWaiting->setUserId($user_target_id);
            $relationWaiting->setUserTargetId($user_id);
            $relationRequest = new Relation();
            $relationRequest->setRelationId(uniqid());
            $relationRequest->setTypeRelation("REQUEST");
            $relationRequest->setChangeAt(date("Y-m-d"));
            $relationRequest->setUserId($user_id);
            $relationRequest->setUserTargetId($user_target_id);
            $relationFollow = new Relation();
            $relationFollow->setRelationId(uniqid());
            $relationFollow->setTypeRelation("FOLLOW");
            $relationFollow->setChangeAt(date("Y-m-d"));
            $relationFollow->setUserId($user_id);
            $relationFollow->setUserTargetId($user_target_id);
            $this->relationDAO->addRelation($relationRequest);
            $this->relationDAO->addRelation($relationWaiting);
            $this->relationDAO->addRelation($relationFollow);
            Logger::log("Add friend successfully");
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        }catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public function unFriend($user_id, $user_target_id)
    {
        try {
            $this->relationDAO->deleteRelation($user_id,$user_target_id,'FRIEND');
            $this->relationDAO->deleteRelation($user_target_id,$user_id,'FRIEND');
            $this->relationDAO->deleteRelation($user_id,$user_target_id,'FOLLOW');
            $this->relationDAO->deleteRelation($user_target_id,$user_id,'FOLLOW');
            Logger::log("Unfriend successfully");
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        }catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public function acceptFriendRequest($user_id, $user_target_id)
    {
        try {
            $this->relationDAO->updateTypeRelation($user_id,$user_target_id,'WAITING','FRIEND');
            $this->relationDAO->updateTypeRelation($user_target_id,$user_id,'REQUEST','FRIEND');
            $relationFollow = new Relation();
            $relationFollow->setRelationId(uniqid());
            $relationFollow->setTypeRelation("FOLLOW");
            $relationFollow->setChangeAt(date("Y-m-d"));
            $relationFollow->setUserId($user_id);
            $relationFollow->setUserTargetId($user_target_id);
            $this->relationDAO->addRelation($relationFollow);
            Logger::log("Accept friend request successfully");
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        }catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public function rejectFriendRequest($user_id, $user_target_id)
    {
        try {
            $this->relationDAO->deleteRelation($user_id,$user_target_id,'WAITING');
            $this->relationDAO->deleteRelation($user_target_id,$user_id,'REQUEST');
            $this->relationDAO->deleteRelation($user_target_id,$user_id,'FOLLOW');
            Logger::log("Reject friend request successfully");
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        }catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public function blockUser($user_id, $user_target_id)
    {
        try {
            $getRelation = $this->relationDAO->getRelation($user_id,$user_target_id);
            if ($getRelation!=null) {
                $this->relationDAO->deleteAllRelationByUserIdAndUserTargetId($user_id,$user_target_id);
            }
            $relationBlock = new Relation();
            $relationBlock->setRelationId(uniqid());
            $relationBlock->setTypeRelation('BLOCK');
            $relationBlock->setChangeAt(date('Y-m-d'));
            $relationBlock->setUserId($user_id);
            $relationBlock->setUserTargetId($user_target_id);
            $this->relationDAO->addRelation($relationBlock);
            Logger::log("Block user successfully");
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        }catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public function unBlockUser($user_id, $user_target_id)
    {
        try {
            $this->relationDAO->deleteRelation($user_id,$user_target_id,'BLOCK');
            Logger::log("Unblock user successfully");
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        }catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public function followUser($user_id, $user_target_id)
    {
        try {
            $relationFollow = new Relation();
            $relationFollow->setRelationId(uniqid());
            $relationFollow->setTypeRelation('FOLLOW');
            $relationFollow->setUserId($user_id);
            $relationFollow->setUserTargetId($user_target_id);
            $relationFollow->setChangeAt(date('Y-m-d'));
            $this->relationDAO->addRelation($relationFollow);
            Logger::log("Follow user successfully");
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        }catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    public function unFollowUser($user_id, $user_target_id)
    {
        try {
            $this->relationDAO->deleteRelation($user_id,$user_target_id,'FOLLOW');
            Logger::log("Unfollow user successfully");
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        }catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}