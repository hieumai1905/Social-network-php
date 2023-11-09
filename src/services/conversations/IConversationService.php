<?php

namespace services\conversations;

use models\Conversation;
use services\IGeneralService;

require_once 'src/services/IGeneralService.php';
interface IConversationService extends IGeneralService
{
    function getByNameAndId($frendName, $userId);
    public function create($name, $type, $managerId);
}