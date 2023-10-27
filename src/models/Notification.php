<?php
namespace models;
class Notification
{
    private $notificationId;
    private $content;
    private $notificationAt;
    private $status;
    private $urlTarget;
    private $userId;
    private $userRecipient;

    /**
     * @return mixed
     */
    public function getNotificationId()
    {
        return $this->notificationId;
    }

    /**
     * @param mixed $notificationId
     */
    public function setNotificationId($notificationId)
    {
        $this->notificationId = $notificationId;
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
    public function getNotificationAt()
    {
        return $this->notificationAt;
    }

    /**
     * @param mixed $notificationAt
     */
    public function setNotificationAt($notificationAt)
    {
        $this->notificationAt = $notificationAt;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getUrlTarget()
    {
        return $this->urlTarget;
    }

    /**
     * @param mixed $urlTarget
     */
    public function setUrlTarget($urlTarget)
    {
        $this->urlTarget = $urlTarget;
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
    public function getUserRecipient()
    {
        return $this->userRecipient;
    }

    /**
     * @param mixed $userRecipient
     */
    public function setUserRecipient($userRecipient)
    {
        $this->userRecipient = $userRecipient;
    }

}