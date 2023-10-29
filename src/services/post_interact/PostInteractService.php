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
    function __construct(IPostInteractDAO $postInteractDAO){
        $this->postInteractDAO = $postInteractDAO;
    }
    function getFavoritePost($userId): ?array
    {
        // TODO: Implement getFavoritePost() method.
        try {
            $result = $this->postInteractDAO->getFavoritePost($userId);
            Logger::log('Get all favorite posts successfully');
            $postInteracts = [];
            foreach ($result as $item){
                $postInteract = Mapper::mapStdClassToModel($item, PostInteract::class);
                $postInteracts[] = $postInteract;
            }
            return $postInteracts;
        } catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function addFavoritePost($userId, $postId)
    {
        // TODO: Implement addFavoritePost() method.
        try {
            $this->postInteractDAO->addFavoritePost($userId, $postId);
            Logger::log('Add favorite post successfully');
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteFavoritePost($userId, $postId)
    {
        // TODO: Implement deleteFavoritePost() method.
        try {
            $this->postInteractDAO->deleteFavoritePost($userId, $postId);
            Logger::log('Delete favorite post successfully');
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function addHiddenPost($userId, $postId)
    {
        // TODO: Implement addHiddenPost() method.
        try {
            $this->postInteractDAO->addHiddenPost($userId, $postId);
            Logger::log('Hide post successfully');
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
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
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}