<?php
namespace models;
class Like
{
    private $likeId;
    private $userId;
    private $postId;
    private $commentId;
    private $commentReplyId;

    /**
     * @return mixed
     */
    public function getLikeId()
    {
        return $this->likeId;
    }

    /**
     * @param mixed $likeId
     */
    public function setLikeId($likeId)
    {
        $this->likeId = $likeId;
    }

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    /**
     * @return mixed
     */
    public function getPostId()
    {
        return $this->postId;
    }

    /**
     * @param mixed $postId
     */
    public function setPostId($postId)
    {
        $this->postId = $postId;
    }

    /**
     * @return mixed
     */
    public function getCommentId()
    {
        return $this->commentId;
    }

    /**
     * @param mixed $commentId
     */
    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;
    }

    /**
     * @return mixed
     */
    public function getCommentReplyId()
    {
        return $this->commentReplyId;
    }

    /**
     * @param mixed $commentReplyId
     */
    public function setCommentReplyId($commentReplyId)
    {
        $this->commentReplyId = $commentReplyId;
    }

}