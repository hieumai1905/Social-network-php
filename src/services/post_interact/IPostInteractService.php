<?php

namespace services\post_interact;
use models\PostInteract;
use services\IGeneralService;

require_once 'src/services/IGeneralService.php';
interface IPostInteractService
{
    function getFavoritePost($userId): ?array;
    function addFavoritePost($userId, $postId);
    function deleteFavoritePost($userId, $postId);
    //   public function getHiddenPost($userId);
    function addHiddenPost($userId, $postId);
    function addReportPost(PostInteract $postInteract);

}