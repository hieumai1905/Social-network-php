<?php

namespace models;
class Relation
{
    private $relationId;
    private $changeAt;
    private $typeRelation;
    private $userId;
    private $userTargetId;

    /**
     * @return mixed
     */
    public function getRelationId()
    {
        return $this->relationId;
    }

    /**
     * @param mixed $relationId
     */
    public function setRelationId($relationId)
    {
        $this->relationId = $relationId;
    }

    /**
     * @return mixed
     */
    public function getChangeAt()
    {
        return $this->changeAt;
    }

    /**
     * @param mixed $changeAt
     */
    public function setChangeAt($changeAt)
    {
        $this->changeAt = $changeAt;
    }

    /**
     * @return mixed
     */
    public function getTypeRelation()
    {
        return $this->typeRelation;
    }

    /**
     * @param mixed $typeRelation
     */
    public function setTypeRelation($typeRelation)
    {
        $this->typeRelation = $typeRelation;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getUserTargetId()
    {
        return $this->userTargetId;
    }

    /**
     * @param mixed $userTargetId
     */
    public function setUserTargetId($userTargetId)
    {
        $this->userTargetId = $userTargetId;
    }

}