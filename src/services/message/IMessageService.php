<?php

namespace services\message;

use models\Message;
use services\IGeneralService;

require_once 'src/services/IGeneralService.php';
interface IMessageService
{
    //    function getAvatarOfUser($userId);
//    function getCoverImageOfUser($userId);
     public function getByConId($conId, $conIdtarget);
     public function createMess($userId, $content, $conversattion) ;
}