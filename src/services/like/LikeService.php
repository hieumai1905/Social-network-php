<?php

namespace services\like;

use DAO\like\ILikeDAO;
use models\Like;
use storage\Logger;
use storage\Mapper;

require_once 'ILikeService.php';
require_once 'src/storage/Logger.php';
require_once 'src/storage/Mapper.php';
require_once 'src/models/Like.php';
class LikeService implements ILikeService
{
    private $likeDAO;
    public function __construct(ILikeDAO $likeDAO){
        $this->likeDAO = $likeDAO;
    }

    function getLikeOfPostByUserId($postId, $userId)
    {
        // TODO: Implement getLikeOfPostByUserId() method.
        try {
            $result = $this->likeDAO->getLikeOfPostByUserId($postId, $userId);
            Logger::log('Get like of post: '. $postId.' with user: '.$userId.' successfully');
            if (!$result) {
                Logger::log('No game no like');
                return null;
            }
            return Mapper::mapStdClassToModel($result,Like::class);
        } catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getLikeOfCommentByUserId($commentId, $userId)
    {
        // TODO: Implement getLikeOfCommentByUserId() method.
        try {
            $result = $this->likeDAO->getLikeOfCommentByUserId($commentId, $userId);
            Logger::log('Get like of comment: '. $commentId.' with user: '.$userId.' successfully');
            if (!$result) {
                Logger::log('No game no like');
                return null;
            }
            return Mapper::mapStdClassToModel($result,Like::class);
        } catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getLikeOfCommentReplyByUserId($commentReplyId, $userId)
    {
        // TODO: Implement getLikeOfCommentReplyByUserId() method.
        try {
            $result = $this->likeDAO->getLikeOfCommentReplyByUserId($commentReplyId,$userId);
            Logger::log('Get like of comment reply: '. $commentReplyId.' with user: '.$userId.' successfully');
            if (!$result) {
                Logger::log('No game no like');
                return null;
            }
            return Mapper::mapStdClassToModel($result,Like::class);
        } catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getLikeCountOfPost($postId)
    {
        // TODO: Implement getLikeCountOfPost() method.
        try {
          $result =  $this->likeDAO->getLikeCountOfPost($postId);
            Logger::log('Get like count of post successfully');
            $likes = [];
            foreach ($result as $item){
                $post = Mapper::mapStdClassToModel($item, Like::class);
                $likes[] = $post;
            }
            return $likes;
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getLikeCountOfComment($commentId)
    {
        // TODO: Implement getLikeCountOfComment() method.
        try {
            $result = $this->likeDAO->getLikeCountOfComment($commentId);
            Logger::log("Get like count of comment successfully");
            $likes = [];
            foreach ($result as $item){
                $post = Mapper::mapStdClassToModel($item, Like::class);
                $likes[] = $post;
            }
            return $likes;
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getLikeCountOfCommentReply($commentReplyId)
    {
        // TODO: Implement getLikeCountOfCommentReply() method.
        try {
            $result = $this->likeDAO->getLikeCountOfCommentReply($commentReplyId);
            Logger::log('Get like count of comment reply');
            $likes = [];
            foreach ($result as $item){
                $like = Mapper::mapStdClassToModel($item, Like::class);
                $likes[] = $like;
            }
            return $likes;
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function addLikePost($postId, $userId)
    {
        // TODO: Implement addLikePost() method.
        try {
            $this->likeDAO->addLikePost($postId, $userId);
            Logger::log('Like post: '.$postId.' added');
        } catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function addLikeComment($commentId, $userId)
    {
        // TODO: Implement addLikeComment() method.
        try {
            $this->likeDAO->addLikeComment($commentId, $userId);
            Logger::log('Like comment: '.$commentId.' added');
        } catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function addLikeCommentReply($commentReplyId, $userId)
    {
        // TODO: Implement addLikeCommentReply() method.
        try {
            $this->likeDAO->addLikeCommentReply($commentReplyId, $userId);
            Logger::log("Like post: ".$commentReplyId." added");
        } catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteLikePost($postId, $userId)
    {
        // TODO: Implement deleteLikePost() method.
        try {
            $this->likeDAO->deleteLikePost($postId, $userId);
            Logger::log('Delete like from post: ' . $postId.' by user: ' . $userId);
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteLikeComment($commentId, $userId)
    {
        // TODO: Implement deleteLikeComment() method.
        try {
            $this->likeDAO->deleteLikeComment($commentId, $userId);
            Logger::log('Delete like from comment: ' . $commentId.' by user: ' . $userId);
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteLikeCommentReply($commentReplyId, $userId)
    {
        // TODO: Implement deleteLikeCommentReply() method.
        try {
            $this->likeDAO->deleteLikeCommentReply($commentReplyId, $userId);
            Logger::log('Delete like from comment reply: ' . $commentReplyId.' by user: ' . $userId);
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteAllLikePost($postId)
    {
        try {
            $this->likeDAO->deleteAllLikePost($postId);
            Logger::log('Delete all like from post');
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteAllLikeComment($commentId)
    {
        try {
            $this->likeDAO->deleteAllLikeComment($commentId);
            Logger::log('Delete all like from comment');
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteAllLikeCommentReply($commentReplyId)
    {
        try {
            $this->likeDAO->deleteAllLikeCommentReply($commentReplyId);
            Logger::log('Delete all like from post');
        }catch (\PDOException $e){
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        }catch (\Exception $e){
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}