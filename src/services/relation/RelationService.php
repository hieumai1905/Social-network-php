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
    public function createRelation($user_id, $user_target_id, $type_relation)
    {
        $relation = new Relation();
        $relation->setRelationId(uniqid());
        $relation->setTypeRelation($type_relation);
        $relation->setChangeAt(date("Y-m-d"));
        $relation->setUserId($user_id);
        $relation->setUserTargetId($user_target_id);
        return $relation;
    }
    public function getFriendForUser($user_id)
    {
        try {
            $result = $this->relationDAO->getRelationForUser($user_id,'FRIEND');
            Logger::log("Get friend successfully");
            if (!$result) {
                Logger::log('No friend for user found');
                return null;
            }
            $relations = [];
            foreach ($result as $item) {
                $relation = Mapper::mapStdClassToModel($item,Relation::class);
                $relations[] = $relation;
            }
            return $relations;
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
            $this->relationDAO->addRelation($this->createRelation($user_id,$user_target_id,'REQUEST'));
            $this->relationDAO->addRelation($this->createRelation($user_target_id,$user_id,'WAITING'));
            $this->relationDAO->addRelation($this->createRelation($user_id,$user_target_id,'FOLLOW'));
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
            $this->relationDAO->addRelation($this->createRelation($user_id,$user_target_id,'FOLLOW'));
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
            $this->relationDAO->addRelation($this->createRelation($user_id,$user_target_id,'BLOCK'));
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
            $this->relationDAO->addRelation($this->createRelation($user_id,$user_target_id,'Follow'));
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

    public function getFriendRequest($user_id)
    {
        try {
            $result = $this->relationDAO->getRelationForUser($user_id,'WAITING');
            Logger::log("Get friend request successfully");
            if (!$result) {
                Logger::log('No friend for user found');
                return null;
            }
            $relations = [];
            foreach ($result as $item) {
                $relation = Mapper::mapStdClassToModel($item,Relation::class);
                $relations[] = $relation;
            }
            return $relations;
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        }catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}