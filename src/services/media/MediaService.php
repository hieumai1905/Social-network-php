<?php

namespace services\media;

use DAO\media\IMediaDAO;
use models\Media;
use storage\Logger;
use storage\Mapper;

require_once 'IMediaService.php';
require_once 'src/storage/Logger.php';
require_once 'src/storage/Mapper.php';
require_once 'src/models/Media.php';

class MediaService implements IMediaService
{
    private $mediaDAO;

    public function __construct(IMediaDAO $mediaDAO)
    {
        $this->mediaDAO = $mediaDAO;
    }

    function getMediaOfPost($postId): ?array
    {
        // TODO: Implement getMediaOfPost() method.
        try {
            $result = $this->mediaDAO->getMediaOfPost($postId);
            Logger::log('Get media of post successfully');
            $medias = [];
            foreach ($result as $item) {
                $media = Mapper::mapStdClassToModel($item, Media::class);
                $medias[] = $media;
            }
            return $medias;
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteMediaOfPost($postId)
    {
        // TODO: Implement deleteMediaOfPost() method.
        try {
            $this->mediaDAO->deleteMediaOfPost($postId);
            Logger::log('Delete media successfully');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getMediaOfUser($userId): ?array
    {
        // TODO: Implement getMediaOfUser() method.
        try {
            $result = $this->mediaDAO->getMediaOfUser($userId);
            Logger::log('Get media of user successfully');
            $medias = [];
            foreach ($result as $item) {
                $media = Mapper::mapStdClassToModel($item, Media::class);
                $medias[] = $media;
            }
            return $medias;
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function addMeida(Media $Media)
    {
        // TODO: Implement addMeida() method.
        try {
            $this->mediaDAO->addMedia($Media);
            Logger::log('add media successfully');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }

    }
}