<?php

namespace DAO\media;
use models\Media;
require_once 'src/models/Media.php';
interface IMediaDAO
{
    public function getMediaOfPost($postId): ?array;
    public function getMediaOfUser($userId): ?array;
    public function addMedia(Media $media);
    public function deleteMediaOfPost($postId);
//    public function getAvatarOfUser($userId);
//    public function getCoverImageOfUser($userId);
}