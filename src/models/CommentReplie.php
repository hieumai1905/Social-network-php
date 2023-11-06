<?php

namespace models;
class CommentReplie
{
    private $commentReplyId;
    private $replyAt;
    private $content;
    private $userId;
    private $commentId;

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

    /**
     * @return mixed
     */
    public function getReplyAt()
    {
        return $this->replyAt;
    }

    /**
     * @param mixed $replyAt
     */
    public function setReplyAt($replyAt)
    {
        $this->replyAt = $replyAt;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content)
    {
        $this->content = $content;
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

}