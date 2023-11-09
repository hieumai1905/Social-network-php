<?php

namespace DAO\conversations;

use DAO\conversations\IConversationsDAO;
use models\Conversation;
use PDO;

require_once 'src/DAO/databases/ConnectDatabase.php';
require_once 'IConversationsDAO.php';
require_once 'src/models/Conversation.php';

class ConversationsDAO implements IConversationsDAO
{
    private $connection;
    public function __construct()
    {
        $this->connection = \DAO\Databases\ConnectDatabase::getConnection();
    }

    public function getConversationByNameAndMgid($nameFrend, $curUserId)
    {
        $stmt = $this->connection->prepare("SELECT * FROM conversations WHERE name = :name AND manager_id = :id ");
        $stmt->bindValue(':name', $nameFrend);
        $stmt->bindValue(':id', $curUserId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function create(Conversation $conversation)
    {
        $stmt = $this->connection->prepare('INSERT INTO conversations (conversation_id,create_at, name, type, manager_id) VALUES (:id, NOW(), :name, :type, :manager_id)');
        $stmt->bindValue(':id', uniqid());
        $stmt->bindValue(':name', $conversation->getName());
        $stmt->bindValue(':type', $conversation->getType());
        $stmt->bindValue(':manager_id', $conversation->getManagerId());
        $stmt->execute();
    }
}