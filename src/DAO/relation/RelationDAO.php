<?php
namespace DAO\relation;

use DAO\Databases\ConnectDatabase;
use PDO;
use models\Relation;

require_once 'src/DAO/databases/ConnectDatabase.php';
require_once 'IRelationDAO.php';
require_once 'src/models/User.php';
class RelationDAO implements IRelationDAO {
    private $connection;
    public function __construct()
    {
        $this->connection = ConnectDatabase::getConnection();
    }

    public function getRelationForUser($user_id, $type_relation)
    {
        $stmt = $this->connection->prepare('SELECT * FROM relations WHERE user_id = :user_id and type_relation = :type_relation');
        $stmt->bindValue('user_id', $user_id);
        $stmt->bindValue('type_relation',$type_relation);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function addRelation(Relation $relation)
    {
        $stsm = $this->connection->prepare('INSERT INTO relations (relation_id, change_at, type_relation, user_id, user_target_id)
                                VALUES (:relation_id, :change_at, :type_relation, :user_id, :user_target_id)');
        $stsm->bindValue('relation_id',$relation->getRelationId());
        $stsm->bindValue('type_relation',$relation->getTypeRelation());
        $stsm->bindValue('change_at',$relation->getChangeAt());
        $stsm->bindValue('user_id',$relation->getUserId());
        $stsm->bindValue('user_target_id',$relation->getUserTargetId());
        $stsm->execute();
    }

    public function deleteAllRelationByUserIdAndUserTargetId($user_id, $user_target_id)
    {
        $stmt1 = $this->connection->prepare('DELETE FROM relations
       WHERE (user_id = :user_id and user_target_id = :user_target_id) or (user_id = :user_target_id and user_target_id = :user_id)');
        $stmt1->bindValue('user_id', $user_id);
        $stmt1->bindValue('user_target_id',$user_target_id);
        $stmt1->execute();
    }

    public function getRelation($user_id, $user_target_id)
    {
        $stmt = $this->connection->prepare('SELECT * FROM relations WHERE user_id = :user_id and user_target_id = :user_target_id');
        $stmt->bindValue('user_id', $user_id);
        $stmt->bindValue('user_target_id',$user_target_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteRelation($user_id, $user_target_id,$type_relation)
    {
        $stmt1 = $this->connection->prepare('DELETE FROM relations
       WHERE user_id = :user_id and user_target_id = :user_target_id and type_relation = :type_relation');
        $stmt1->bindValue('user_id', $user_id);
        $stmt1->bindValue('user_target_id',$user_target_id);
        $stmt1->bindValue('type_relation',$type_relation);
        $stmt1->execute();
    }

    public function updateTypeRelation($user_id, $user_target_id,$type_relation_before,$type_relation_after)
    {
        $stmt1 = $this->connection->prepare('UPDATE relations set type_relation = :type_relation, change_at = :change_at where user_id = :user_id and user_target_id = :user_target_id and type_relation = :type_relation_now');
        $stmt1->bindValue('type_relation', $type_relation_after);
        $stmt1->bindValue('change_at',date('Y-m-d'));
        $stmt1->bindValue('user_id', $user_id);
        $stmt1->bindValue('user_target_id',$user_target_id);
        $stmt1->bindValue('type_relation_now', $type_relation_before);
        $stmt1->execute();
    }
}