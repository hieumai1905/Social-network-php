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
    //HTTP GET (/favorite/$userId)
    public function getFavoritePost($userId){
        try {
            $posts = $this->postInteractService->getFavoritePost($userId);
            $data =[];
            foreach($posts as $post){
                $data[] = Mapper::mapModelToJson($post);
            }
            return Response::apiResponse(Status::OK, 'success',$data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //-------------------------------HTTP POST --------------------------------
    //HTTP POST (/favorite/$postId/$userId)
    public function addFavorite($postId, $userId){
        try {
            $this->postInteractService->addFavoritePost($userId, $postId);
            return Response::apiResponse(Status::OK, 'add favorite successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP POST (/hidden/$postId/$userId)
    public function addHidden($postId, $userId){
        try {
            $this->postInteractService->addHiddenPost($userId, $postId);
            return Response::apiResponse(Status::OK, 'hide post successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP POST (/report/$postId/$userId)
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
    //HTTP DELETE (/favorite/$postId/$userId)
    public function deleteFavorite($postId, $userId){
        try {
            $this->postInteractService->deleteFavoritePost($userId, $postId);
            return Response::apiResponse(Status::OK, 'delete favorite successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
}