<?php

namespace controllers;

use Exception;
use https\Status;
use https\Response;
use storage\Mapper;
use services\like\ILikeService;
use models\Like;

require_once 'src/https/Status.php';
class LikeController
{
    private $likeService;
    public function __construct(ILikeService $likeService){
        $this->likeService = $likeService;
    }
    //-------------------------------HTTP GET --------------------------------
    //HTTP GET (/like/post/$postId/$userId)
    public function getLikeOfPostByUser($postId, $userId){
        try{
            $like = $this->likeService->getLikeOfPostByUserId($postId, $userId);
            $data = Mapper::mapModelToJson($like);
            return Response::apiResponse(Status::OK, 'get like of post by user successfully', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP GET (/like/comment/$commentId/$userId)
    public function getLikeOfCommentByUser($commentId, $userId){
        try{
            $like = $this->likeService->getLikeOfCommentByUserId($commentId, $userId);
            $data = Mapper::mapModelToJson($like);
            return Response::apiResponse(Status::OK, 'get like of comment by user successfully', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP GET (/like/comment/reply/$commentReplyId/$userId)
    public function getLikeOfCommentReplyByUser($commentReplyId, $userId){
        try{
            $like = $this->likeService->getLikeOfCommentReplyByUserId($commentReplyId, $userId);
            $data = Mapper::mapModelToJson($like);
            return Response::apiResponse(Status::OK, 'get like of comment Reply by user successfully', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP GET (/like/count/post/$postId)
    public function getCountLikePost($postId){
        try{
            $likes = $this->likeService->getLikeCountOfPost($postId);
            $data =[];
            foreach($likes as $like){
                $data[] = Mapper::mapModelToJson($like);
            }
            return Response::apiResponse(Status::OK, 'count like post successfully', $data);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP GET (/like/count/comment/$commentId)
    public function getCountLikeComment($commentId){
        try{
            $likes = $this->likeService->getLikeCountOfComment($commentId);
            $data =[];
            foreach($likes as $like){
                $data[] = Mapper::mapModelToJson($like);
            }
            return Response::apiResponse(Status::OK, 'count like comment successfully', $data);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP GET (/like/count/comment/reply/$commentReplyId)
    public function getCountLikeCommentReply($commentReplyId){
        try{
            $likes = $this->likeService->getLikeCountOfCommentReply($commentReplyId);
            $data =[];
            foreach($likes as $like){
                $data[] = Mapper::mapModelToJson($like);
            }
            return Response::apiResponse(Status::OK, 'count like comment reply successfully', $data);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //-------------------------------HTTP POST --------------------------------
    //HTTP POST (/like/post/$postId/$userId)
    public function likePost($postId, $userId){
        try{
            $this->likeService->addLikePost($postId, $userId);
            return Response::apiResponse(Status::OK, 'like post successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }

    }
    //HTTP POST (/like/comment/$commentId/$userId)
    function likeComment($commentId, $userId){
        try{
            $this->likeService->addLikeComment($commentId, $userId);
            return Response::apiResponse(Status::OK, 'like comment successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP POST (/like/comment/reply/$commentReplyId/$userId)
    function likeCommentReply($commentReplyId, $userId){
        try{
            $this->likeService->addLikeCommentReply($commentReplyId, $userId);
            return Response::apiResponse(Status::OK, 'like comment reply successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //-------------------------------HTTP PUT --------------------------------
    //-------------------------------HTTP DELETE --------------------------------
    //HTTP DELETE (/like/post/$postId/$userId)
    function unlikePost($postId, $userId){
        try{
            $this->likeService->deleteLikePost($postId, $userId);
            return Response::apiResponse(Status::OK, 'unlike post successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP DELETE (/like/comment/$comment/$userId)
    function unlikeComment($postId, $userId){
        try{
            $this->likeService->deleteLikeComment($postId, $userId);
            return Response::apiResponse(Status::OK, 'unlike comment successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP DELETE (/like/comment/reply/$commentReplyId/$userId)
    function deleteCommentReply($commentReplyId, $userId){
        try{
            $this->likeService->deleteLikeCommentReply($commentReplyId, $userId);
            return Response::apiResponse(Status::OK, 'unlike commentReply successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP DELETE (/like/all/post/$postId)
    function deleteAllLikePost($postId){
        try {
            $this->likeService->deleteAllLikePost($postId);
            return Response::apiResponse(Status::OK, 'delete successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP DELETE (/like/all/comment/$commentId)
    function deleteAllLikeComment($commentId){
        try {
            $this->likeService->deleteAllLikeComment($commentId);
            return Response::apiResponse(Status::OK, 'unlike commentReply successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //HTTP DELETE (/like/all/comment/reply/$commentReplyId)
    function deleteAllLikeCommentReply($commentReplyId){
        try {
            $this->likeService->deleteAllLikeCommentReply($commentReplyId);
            return Response::apiResponse(Status::OK, 'unlike commentReply successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
}