<?php

namespace services\media;

use models\Media;
use services\IGeneralService;

require_once 'src/services/IGeneralService.php';

interface IMediaService
{
    function getMediaOfPost($postId): ?array;

    function getMediaOfUser($userId): ?array;

    function addMeida(Media $Media);

    function deleteMediaOfPost($postId);

}