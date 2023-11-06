<?php

namespace DAO\post_interact;

use models\PostInteract;

require_once 'src/models/PostInteract.php';

interface IPostInteractDAO
{
    public function getFavoriteById($postId);

    public function getFavoritePost(): ?array;

    public function addFavoritePost($postId);

    public function deleteFavoritePost($postId);

    public function addHiddenPost($postId);

    public function addReportPost(PostInteract $postInteract);
}