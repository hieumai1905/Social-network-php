<?php

namespace DAO\post_interact;
use models\PostInteract;
require_once 'src/models/PostInteract.php';
interface IPostInteractDAO
{
    public function getFavoritePost($userId): ?array;
    public function addFavoritePost($userId, $postId);
    public function deleteFavoritePost($userId, $postId);
 //   public function getHiddenPost($userId);
    public function addHiddenPost($userId, $postId);
    public function addReportPost(PostInteract $postInteract);
}