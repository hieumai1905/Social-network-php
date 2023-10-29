<?php
namespace models;
class Post
{
    private $postId;
    private $createAt;
    private $content;
    private $accessModifier;
    private $postType;
    private $userId;

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
    public function getCreateAt()
    {
        return $this->createAt;
    }

    /**
     * @param mixed $createAt
     */
    public function setCreateAt($createAt)
    {
        $this->createAt = $createAt;
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
    public function getAccessModifier()
    {
        return $this->accessModifier;
    }

    /**
     * @param mixed $accessModifier
     */
    public function setAccessModifier($accessModifier)
    {
        $this->accessModifier = $accessModifier;
    }

    /**
     * @return mixed
     */
    public function getPostType()
    {
        return $this->postType;
    }

    /**
     * @param mixed $postType
     */
    public function setPostType($postType)
    {
        $this->postType = $postType;
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

}