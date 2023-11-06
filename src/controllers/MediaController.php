<?php

namespace controllers;

use Exception;
use https\Status;
use https\Response;
use services\media\IMediaService;
use storage\Mapper;
use models\Media;

class MediaController
{
    private $mediaService;

    public function __construct(IMediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }
    //-------------------------------HTTP GET --------------------------------
    //HTTP GET (/media/post/$postId)
    function getMediaOfPost($postId)
    {
        try {
            $medias = $this->mediaService->getMediaOfPost($postId);
            $data = [];
            foreach ($medias as $media) {
                $data[] = Mapper::mapModelToJson($media);
            }
            return Response::apiResponse(Status::OK, 'success', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    //HTTP GET (/media/user/$userId)
    function getMediaOfUser($userId)
    {
        try {
            $medias = $this->mediaService->getMediaOfUser($userId);
            $data = [];
            foreach ($medias as $media) {
                $data[] = Mapper::mapModelToJson($media);
            }
            return Response::apiResponse(Status::OK, 'success', $data);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    //-------------------------------HTTP POST --------------------------------
    //HTTP POST (/media/post)
    function addMediaForPost()
    {
        try {
            $json = Response::getJson();
            if (!isset($json['postId'])) {
                throw new Exception('ID is null');
            }
            $media = Response::jsonToModel($json, Media::class);
            $this->mediaService->addMeida($media);
            return Response::apiResponse(Status::OK, 'add media for post successfully', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }


    }
    //-------------------------------HTTP DELETE --------------------------------
    //HTTP DELETE (/media/post/$postId)
    function deleteMediaOfPost($postId)
    {
        try {
            $this->mediaService->deleteMediaOfPost($postId);
            return Response::apiResponse(Status::OK, 'delete media successfully', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
}