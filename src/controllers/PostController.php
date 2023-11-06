<?php

namespace controllers;

use Exception;
use https\Status;
use https\Response;
use services\post\IPostService;
use storage\Mapper;
use models\Post;

require_once 'src/https/Status.php';
require_once 'src/models/Post.php';

class PostController
{
    private $postService;

    /**
     * @param $postService
     */
    public function __construct(IPostService $postService)
    {
        $this->postService = $postService;
    }

    //----------------------HTTP GET------------------------
    //HTTP GET (/post/home)
    public function getPostForHome()
    {
        try {
            $posts = $this->postService->getPostForHome();
            $data = [];
            foreach ($posts as $post) {
                $data[] = Mapper::mapModelToJson($post);
            }
            return Response::apiResponse(Status::OK, 'success', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }

    }

    //HTTP GET (/post/profile/$userId)
    public function getPostForProfile($userId)
    {
        try {
            $posts = $this->postService->getPostForProfile($userId);
            $data = [];
            foreach ($posts as $post) {
                $data[] = Mapper::mapModelToJson($post);
            }
            return Response::apiResponse(Status::OK, 'success', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    //HTTP GET (/post/$postId)
    public function getPostById($postId)
    {
        try {
            $post = $this->postService->getById($postId);
            $data = Mapper::mapModelToJson($post);
            return Response::apiResponse(Status::OK, 'success', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    //HTTP GET (/admin/post)
    public function getAllPost()
    {
        try {
            $posts = $this->postService->getAll();
            $data = [];
            foreach ($posts as $post) {
                $data[] = Mapper::mapModelToJson($post);
            }
            return Response::apiResponse(Status::OK, 'success', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    //HTTP GET (/admin/post/month)
    public function getMonthPost()
    {
        try {
            $posts = $this->postService->getMonthPost();
            $data = [];
            foreach ($posts as $post) {
                $data[] = Mapper::mapModelToJson($post);
            }
            return Response::apiResponse(Status::OK, 'success', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    //-------------------------HTTP POST-----------------------------------
    //HTTP POST (/post)
    public function createPost()
    {
        try {
            $json = Response::getJson();
            $keyWord = ['bimbim', 'tăng lực', 'mệt mỏi', 'chán'];
            foreach ($keyWord as $ban) {
                if (str_contains($json['content'], $ban)) {
                    return Response::apiResponse(Status::BAD_REQUEST, 'Bad Request', null);
                }
            }
            $post = Response::jsonToModel($json, Post::class);
            $this->postService->add($post);
            return Response::apiResponse(Status::OK, 'create post successfully', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    //--------------------------HTTP PUT------------------------
    //HTTP PUT (/post)
    public function updatePost()
    {
        try {
            $json = Response::getJson();
            $keyWord = ['bimbim', 'tăng lực', 'mệt mỏi', 'chán'];
            foreach ($keyWord as $ban) {
                if (str_contains($json['content'], $ban)) {
                    return Response::apiResponse(Status::BAD_REQUEST, 'Bad Request', null);
                }
            }
            $post = Response::jsonToModel($json, Post::class);
            $this->postService->update($post);
            return Response::apiResponse(Status::OK, 'edit post successfully', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //--------------------------HTTP DELETE --------------------------------
    //HTTP DELETE (/post/$postId)
    public function deletePost($postId)
    {
        try {
            $this->postService->delete($postId);
            return Response::apiResponse(Status::OK, 'delete post successfully', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }

    }
}