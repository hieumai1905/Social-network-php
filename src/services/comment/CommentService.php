<?php

namespace services\comment;

use DAO\comment\ICommentDAO;
use models\Comment;
use storage\Logger;
use storage\Mapper;

require_once 'ICommentService.php';
require_once 'src/storage/Logger.php';
require_once 'src/storage/Mapper.php';
require_once 'src/models/Comment.php';
class CommentService implements ICommentService
{
    private $commentDAO;
    public function __construct(ICommentDAO $commentDAO){
        $this->commentDAO = $commentDAO;
    }
    function getCommentByPostId($postId): ?array
    {
        // TODO: Implement getCommentByPostId() method.
        try{
            $result = $this->commentDAO->getCommentOfPost($postId);
            Logger::log("Get comment of post: ".$postId." successfully");
            $comments = [];
            foreach ($result as $item){
                $comment = Mapper::mapStdClassToModel($item, Comment::class);
                $comments[] = $comment;
            }
            return $comments;
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getAll(): ?array
    {
        // TODO: Implement getAll() method.
        return null;
    }

    function getById($id): ?object
    {
        // TODO: Implement getById() method.
        return null;
    }

    function add($object)
    {
        // TODO: Implement add() method.
        try {
            $this->commentDAO->createCommentForPost($object);
            Logger::log("Create new comment for post successfully");
        } catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function update($object)
    {
        // TODO: Implement update() method.
        try {
            $this->commentDAO->update($object);
            Logger::log('Update post successfully');
        } catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function delete($id)
    {
        // TODO: Implement delete() method.
        try {
            $this->commentDAO->deleteComment($id);
            Logger::log('Delete comment successfully');
        } catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }

    }
}