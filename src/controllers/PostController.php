<?php

namespace controllers;


use https\Response;
use Media;
use services\post\IPostService;

require_once 'src/https/Response.php';
require_once 'src/models/Media.php';
class PostController
{
    private $postService;
    public function __construct(IPostService $postService){
        $this->postService = $postService;
    }
    //----------------------HTTP GET------------------------
    public function getPostForHome($userId){
        $this->postService->getPostForHome($userId);
    }
    public function getPostForProfile($userId){
        $this->postService->getPostForProfile($userId);
    }
}