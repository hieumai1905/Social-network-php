<?php

namespace controllers;
use Exception;
use https\Status;
use https\Response;
use services\post_interact\IPostInteractService;
use storage\Mapper;
use models\PostInteract;

require_once 'src/https/Status.php';
class PostInteractController
{
    private $postInteractService;
    public function __construct(IPostInteractService $postInteractService){
        $this->postInteractService = $postInteractService;
    }
    //-------------------------------HTTP GET --------------------------------
    //HTTP GET (/favorite)
    public function getFavoritePost(){
        try {
            $posts = $this->postInteractService->getFavoritePost();
            $data =[];
            foreach($posts as $post){
                $data[] = Mapper::mapModelToJson($post);
            }
            return Response::apiResponse(Status::OK, 'success',$data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP GET (/favorite/$postId)
    public function getFavoritePostById($postId){
        try {
            $posts = $this->postInteractService->getFavoritePostById($postId);
            $data[] = Mapper::mapModelToJson($posts);
            return Response::apiResponse(Status::OK, 'success',$data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //-------------------------------HTTP POST --------------------------------
    //HTTP POST (/favorite/$postId)
    public function addFavorite($postId){
        try {
            $this->postInteractService->addFavoritePost($postId);
            return Response::apiResponse(Status::OK, 'add favorite successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP POST (/hidden/$postId)
    public function addHidden($postId){
        try {
            $this->postInteractService->addHiddenPost($postId);
            return Response::apiResponse(Status::OK, 'hide post successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP POST (/report/$postId)
    public function addReport(){
        try {
            $json = Response::getJson();
            $report = Response::jsonToModel($json, PostInteract::class);
            $this->postInteractService->addReportPost($report);
            return Response::apiResponse(Status::OK, 'report post successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //-------------------------------HTTP PUT--------------------------------
    //-------------------------------HTTP DELETE--------------------------------
    //HTTP DELETE (/favorite/$postId)
    public function deleteFavorite($postId){
        try {
            $this->postInteractService->deleteFavoritePost($postId);
            return Response::apiResponse(Status::OK, 'delete favorite successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
}