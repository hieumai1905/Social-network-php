<?php

namespace services\comment_reply;

use DAO\comment_reply\ICommentReplyDAO;
use models\CommentReplie;
use storage\Logger;
use storage\Mapper;
class CommentReplyService implements ICommentReplyService
{
    private $commentReplyDAO;
    public function __construct(ICommentReplyDAO $commentReplyDAO){
        $this->commentReplyDAO = $commentReplyDAO;
    }
    function getCommentReplyOfComment($commentId)
    {
        // TODO: Implement getCommentReplyOfComment() method.
        try {
            $result = $this->commentReplyDAO->getCommentReplyOfComment($commentId);
            Logger::log('Get comment reply of comment: '.$commentId,' successfully');
            $commentReplies = [];
            foreach ($result as $item){
                $commentReply = Mapper::mapStdClassToModel($item, CommentReplie::class);
                $commentReplies[] = $commentReply;
            }
            return $commentReplies;
        } catch (\PDOException $e){
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
            $this->commentReplyDAO->createCommentReply($object);
            Logger::log('Create comment reply successfully');
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
            $this->commentReplyDAO->updateCommentReply($object);
            Logger::log('updated comment reply successfully');
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
            $this->commentReplyDAO->deleteCommentReply($id);
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