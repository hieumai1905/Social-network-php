<?php

namespace controllers;

use Exception;
use https\Status;
use https\Response;
use services\comment\ICommentService;
use storage\Mapper;
use models\Comment;

class CommentController
{
    private $commentService;

    public function __construct(ICommentService $commentService)
    {
        $this->commentService = $commentService;
    }

    //-------------------------------HTTP GET-------------------------------
    //HTTP GET (/comment/$postId)
    function getCommentByPostId($postId)
    {
        try {
            $comments = $this->commentService->getCommentByPostId($postId);
            $data = [];
            foreach ($comments as $comment) {
                $data[] = Mapper::mapModelToJson($comment);
            }
            return Response::apiResponse(Status::OK, 'get comment successfully', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //---------------------------------HTTP POST--------------------------------
    //HTTP POST (/comment)
    function createComment()
    {
        try {
            $json = Response::getJson();
            if (!isset($json['userId'])) {
                throw new Exception('ID is null');
            }
            $comment = Response::jsonToModel($json, Comment::class);
            $this->commentService->add($comment);
            return Response::apiResponse(Status::OK, 'create comment successfully', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //------------------------------HTTP PUT------------------------------------------------
    //HTTP PUT (/comment)
    function updateComment()
    {
        try {
            $json = Response::getJson();
            if (!isset($json['userId'])) {
                throw new Exception('ID is null');
            }
            $comment = Response::jsonToModel($json, Comment::class);
            $this->commentService->update($comment);
            return Response::apiResponse(Status::OK, 'update comment successfully', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //-----------------------------------HTTP DELETE--------------------------------
    //HTTP DELETE(/comment/$commentId)
    function deleteComment($commentId)
    {
        try {
            $this->commentService->delete($commentId);
            return Response::apiResponse(Status::OK, 'delete comment successfully', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
}