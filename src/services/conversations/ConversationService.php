<?php

namespace services\conversations;

use DAO\conversations\IConversationsDAO;
use models\Conversation;
use storage\Logger;
use storage\Mapper;

require_once 'IConversationService.php';
require_once 'src/storage/Logger.php';
require_once 'src/storage/Mapper.php';
require_once 'src/models/Conversation.php';
class ConversationService implements IConversationService
{
    private $conversationDAO;

    public function __construct(IConversationsDAO $conversationDAO)
    {
        $this->conversationDAO = $conversationDAO;

    }

    public function getByNameAndId($nameFrend, $curUserId)
    {
        try {
            $result = $this->conversationDAO->getConversationByNameAndMgid($nameFrend, $curUserId);
            if (!$result)
                return null;

            return Mapper::mapStdClassToModel($result, Conversation::class);

        } catch (\Exception $e) {
            //throw $th;
            throw new \Exception($e->getMessage());
        }
    }


    public function create($name, $type, $managerId)
    {
        try {
            $conversation = new Conversation();
            $conversation->setName($name);
            $conversation->setType($type);
            $conversation->setManagerId($managerId);
            $this->conversationDAO->create($conversation);
            $conversation = $this->conversationDAO->getConversationByNameAndMgid($name, $managerId);
            return $conversation;
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getAll(): ?array
    {

    }

    function getById($id): ?object
    {

    }

    function add($object)
    {

    }

    function update($object)
    {

    }

    function delete($id)
    {

    }
}