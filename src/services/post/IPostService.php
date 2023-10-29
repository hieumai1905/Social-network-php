<?php

namespace services\post;

use models\Post;
use services\IGeneralService;

require_once 'src/services/IGeneralService.php';
interface IPostService extends IGeneralService
{
    function getPostForHome($userId): ?array;
    function getPostForProfile($userId): ?array;
}