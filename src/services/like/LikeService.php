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

    public function __construct(ILikeDAO $likeDAO)
    {
        $this->likeDAO = $likeDAO;
    }

    function getLikeOfPostByUserId($postId)
    {
        // TODO: Implement getLikeOfPostByUserId() method.
        try {
            $result = $this->likeDAO->getLikeOfPostByUserId($postId);
            Logger::log('Get like of post: ' . $postId . ' successfully');
            if (!$result) {
                Logger::log('No game no like');
                return null;
            }
            return Mapper::mapStdClassToModel($result, Like::class);
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getLikeOfCommentByUserId($commentId)
    {
        // TODO: Implement getLikeOfCommentByUserId() method.
        try {
            $result = $this->likeDAO->getLikeOfCommentByUserId($commentId);
            Logger::log('Get like of comment: ' . $commentId . ' successfully');
            if (!$result) {
                Logger::log('No game no like');
                return null;
            }
            return Mapper::mapStdClassToModel($result, Like::class);
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getLikeOfCommentReplyByUserId($commentReplyId)
    {
        // TODO: Implement getLikeOfCommentReplyByUserId() method.
        try {
            $result = $this->likeDAO->getLikeOfCommentReplyByUserId($commentReplyId);
            Logger::log('Get like of comment reply: ' . $commentReplyId . ' successfully');
            if (!$result) {
                Logger::log('No game no like');
                return null;
            }
            return Mapper::mapStdClassToModel($result, Like::class);
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function getLikeCountOfPost($postId)
    {
        // TODO: Implement getLikeCountOfPost() method.
        try {
            $result = $this->likeDAO->getLikeCountOfPost($postId);
            Logger::log('Get like count of post successfully');
            $likes = [];
            foreach ($result as $item) {
                $post = Mapper::mapStdClassToModel($item, Like::class);
                $likes[] = $post;
            }
            return $likes;
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
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
            foreach ($result as $item) {
                $post = Mapper::mapStdClassToModel($item, Like::class);
                $likes[] = $post;
            }
            return $likes;
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
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
            foreach ($result as $item) {
                $like = Mapper::mapStdClassToModel($item, Like::class);
                $likes[] = $like;
            }
            return $likes;
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function addLikePost($postId)
    {
        // TODO: Implement addLikePost() method.
        try {
            $this->likeDAO->addLikePost($postId);
            Logger::log('Like post: ' . $postId . ' added');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function addLikeComment($commentId)
    {
        // TODO: Implement addLikeComment() method.
        try {
            $this->likeDAO->addLikeComment($commentId);
            Logger::log('Like comment: ' . $commentId . ' added');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function addLikeCommentReply($commentReplyId)
    {
        // TODO: Implement addLikeCommentReply() method.
        try {
            $this->likeDAO->addLikeCommentReply($commentReplyId);
            Logger::log("Like post: " . $commentReplyId . " added");
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteLikePost($postId)
    {
        // TODO: Implement deleteLikePost() method.
        try {
            $this->likeDAO->deleteLikePost($postId);
            Logger::log('Delete like from post: ' . $postId);
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteLikeComment($commentId)
    {
        // TODO: Implement deleteLikeComment() method.
        try {
            $this->likeDAO->deleteLikeComment($commentId);
            Logger::log('Delete like from comment: ' . $commentId);
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteLikeCommentReply($commentReplyId)
    {
        // TODO: Implement deleteLikeCommentReply() method.
        try {
            $this->likeDAO->deleteLikeCommentReply($commentReplyId);
            Logger::log('Delete like from comment reply: ' . $commentReplyId);
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteAllLikePost($postId)
    {
        try {
            $this->likeDAO->deleteAllLikePost($postId);
            Logger::log('Delete all like from post');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteAllLikeComment($commentId)
    {
        try {
            $this->likeDAO->deleteAllLikeComment($commentId);
            Logger::log('Delete all like from comment');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }

    function deleteAllLikeCommentReply($commentReplyId)
    {
        try {
            $this->likeDAO->deleteAllLikeCommentReply($commentReplyId);
            Logger::log('Delete all like from post');
        } catch (\PDOException $e) {
            Logger::log($e->getMessage());
            throw new \Exception("An error connect to database");
        } catch (\Exception $e) {
            Logger::log($e->getMessage());
            throw new \Exception($e->getMessage());
        }
    }
}