<?php

namespace services\post;

use DAO\post\IPostDAO;
use models\Post;
use services\request\IRequestService;
use storage\Logger;
use models\User;
use storage\Mapper;

require_once 'IPostService.php';
require_once 'src/storage/Logger.php';
require_once 'src/storage/Mapper.php';
require_once 'src/models/Post.php';
class PostService implements IPostService
{
    private $postDAO;
    public function __construct(IPostDAO $postDAO){
        $this->postDAO = $postDAO;
    }


    function getAll(): ?array
    {
        // TODO: Implement getAll() method.
        return null;
    }

    function getById($id): ?object
    {
        try{
            $result = $this->postDAO->getPostById($id);
            Logger::log("Get post successfully");
            if (!$result){
                Logger::log("No post found");
                return null;
            }
            return Mapper::mapStdClassToModel($result, Post::class);
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function add($object)
    {
        // TODO: Implement add() method.
    }

    function update($object)
    {
        try{
            $this->postDAO->update($object);
            Logger::log('Update post successfully');
        }catch(\PDOException $e){
            Logger::log($e->getMessage());
            throw new (\Exception('An error connect to database'));
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function delete($id)
    {
        try{
            $this->postDAO->deletePost($id);
            Logger::log('Delete post successfully');
        }catch(\PDOException $e){
            Logger::log($e->getMessage());
            throw new (\Exception('An error connect to database'));
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getPostForHome($userId): ?array
    {
        try{
            $result = $this->postDAO->getPostForHome($userId);
            Logger::log('Get all post for home successfully');
            $posts = [];
            foreach ($result as $item){
                $post = Mapper::mapStdClassToModel($item, Post::class);
                $posts[] = $post;
            }
            return $posts;
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getPostForProfile($userId): ?array
    {
        try{
            $result = $this->postDAO->getPostForProfile($userId);
            Logger::log('Get all post for profile successfully');
            $posts = [];
            foreach ($result as $item){
                $post = Mapper::mapStdClassToModel($item, Post::class);
                $posts[] = $post;
            }
            return $posts;
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception('An error connect to database');
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}