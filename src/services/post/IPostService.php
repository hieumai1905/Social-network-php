<?php

namespace services\post;

use models\Post;
use services\IGeneralService;

require_once 'src/services/IGeneralService.php';
interface IPostService extends IGeneralService
{
    function getPostForHome(): ?array;
    function getPostForProfile($userId): ?array;
    function getMonthPost(): ?array;
}