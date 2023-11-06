<?php

namespace services\post_interact;

use DAO\post_interact\IPostInteractDAO;
use models\PostInteract;
use storage\Logger;
use storage\Mapper;

require_once 'IPostInteractService.php';
require_once 'src/storage/Logger.php';
require_once 'src/storage/Mapper.php';
require_once 'src/models/PostInteract.php';

class PostInteractService implements IPostInteractService
{
    private $postInteractDAO;

    function __construct(IPostInteractDAO $postInteractDAO)
    {
        $this->postInteractDAO = $postInteractDAO;
    }

    function getFavoritePost(): ?array
    {
        // TODO: Implement getFavoritePost() method.
        try {
            $result = $this->postInteractDAO->getFavoritePost();
            Logger::log('Get all favorite posts successfully');
            $postInteracts = [];
            foreach ($result as $item) {
                $postInteract = Mapper::mapStdClassToModel($item, PostInteract::class);
                $postInteracts[] = $postInteract;
            }
            return $postInteracts;
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function addFavoritePost($postId)
    {
        // TODO: Implement addFavoritePost() method.
        try {
            $this->postInteractDAO->addFavoritePost($postId);
            Logger::log('Add favorite post successfully');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteFavoritePost($postId)
    {
        // TODO: Implement deleteFavoritePost() method.
        try {
            $this->postInteractDAO->deleteFavoritePost($postId);
            Logger::log('Delete favorite post successfully');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function addHiddenPost($postId)
    {
        // TODO: Implement addHiddenPost() method.
        try {
            $this->postInteractDAO->addHiddenPost($postId);
            Logger::log('Hide post successfully');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function addReportPost(PostInteract $postInteract)
    {
        // TODO: Implement addReportPost() method.
        try {
            $this->postInteractDAO->addReportPost($postInteract);
            Logger::log('Report post successfully');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getFavoritePostById($postId)
    {
        // TODO: Implement getFavoritePostById() method.
        try {
            $result = $this->postInteractDAO->getFavoriteById($postId);
            Logger::log('Get favorite posts by id successfully');
            if (!$result)
                return Mapper::mapStdClassToModel($result, PostInteract::class);
            return Mapper::mapStdClassToModel($result[0], PostInteract::class);
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}