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
    //HTTP GET (/like/post/$post_id/$user_id)
    public function getLikeOfPostByUser($post_id, $user_id){
        try{
            $like = $this->likeService->getLikeOfPostByUserId($post_id, $user_id);
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
    //-------------------------------HTTP POST --------------------------------
    //HTTP POST (/comment/reply)
    //-------------------------------HTTP POST --------------------------------
    //HTTP POST (/comment/reply)
    //-------------------------------HTTP POST --------------------------------
    //HTTP POST (/comment/reply)
}