<?php

namespace controllers;

use Exception;
use https\Status;
use https\Response;
use models\CommentReplie;
use services\comment_reply\ICommentReplyService;
use storage\Mapper;

require_once 'src/https/Status.php';
class CommentReplyController
{
    private $commentReplyService;
    public function __construct(ICommentReplyService $commentReplyService){
        $this->commentReplyService = $commentReplyService;
    }

    //-----------------------------HTTP GET-----------------------------
    //HTTP GET (/comment/reply/$commentId)
    public function getCommentReply($commentId){
        try{
            $commentReplies = $this->commentReplyService->getCommentReplyOfComment(($commentId));
            $data = [];
            foreach($commentReplies as $commentReply){
                $data[] = Mapper::mapModelToJson($commentReply);
            }
            return Response::apiResponse(Status::OK, 'success',$data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //-------------------------------HTTP POST --------------------------------
    //HTTP POST (/comment/reply)
    public function createCommentReply(){
        try {
            $json = Response::getJson();
            if (!isset($json['userId']) || !isset($json['commentId'])){
                throw new Exception ('ID is null');
            }
            $commentReply = Response::jsonToModel($json, CommentReplie::class);
            $this->commentReplyService->add($commentReply);
            return Response::apiResponse(Status::OK, 'Create comment reply successfully', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //-------------------------------HTTP PUT --------------------------------
    //HTTP PUT (/comment/reply)
    public function updateCommentReply(){
        try {
            $json = Response::getJson();
            if (!isset($json['userId']) || !isset($json['commentId'])){
                throw new Exception ('ID is null');
            }
            $commentReply = Response::jsonToModel($json, CommentReplie::class);
            $this->commentReplyService->update($commentReply);
            return Response::apiResponse(Status::OK, 'update comment reply successfully', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //-------------------------------HTTP DELETE --------------------------------
    //HTTP DELETE (/comment/reply/$commentId)
    public function deleteCommentReply($commentId) {
        try {
            $this->commentReplyService->delete($commentId);
            return Response::apiResponse(Status::OK, 'delete comment successfully', null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
}