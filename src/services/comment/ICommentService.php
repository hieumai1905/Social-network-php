<?php

namespace services\comment;

use models\Comment;
use services\IGeneralService;

require_once 'src/services/IGeneralService.php';

interface ICommentService extends IGeneralService
{
    function getCommentByPostId($postId): ?array;
}