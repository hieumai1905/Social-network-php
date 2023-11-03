<?php

namespace services\post_interact;
use models\PostInteract;
use services\IGeneralService;

require_once 'src/services/IGeneralService.php';
interface IPostInteractService
{
    function getFavoritePostById($postId);
    function getFavoritePost(): ?array;
    function addFavoritePost($postId);
    function deleteFavoritePost($postId);
    //   public function getHiddenPost($userId);
    function addHiddenPost($postId);
    function addReportPost(PostInteract $postInteract);

}