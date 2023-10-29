<?php

namespace DAO\post;
use models\Post;
require_once 'src/models/Post.php';
interface IPostDAO
{
    public function getPostForProfile($userId): ?array;
    public function getPostById($postId);
    public function getPostForHome($userId): ?array;
    public function createPost(post $post);
    public function updatePost(post $post);
    public function deletePost($postId);
}