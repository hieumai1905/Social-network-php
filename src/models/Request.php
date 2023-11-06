<?php

namespace models;
class Request
{
    private $requestId;
    private $requestAt;
    private $emailRequest;
    private $typeRequest;
    private $requestCode;

    /**
     * @return mixed
     */
    public function getRequestId()
    {
        return $this->requestId;
    }

    /**
     * @param mixed $requestId
     */
    public function setRequestId($requestId)
    {
        $this->requestId = $requestId;
    }

    /**
     * @return mixed
     */
    public function getRequestAt()
    {
        return $this->requestAt;
    }

    /**
     * @param mixed $requestAt
     */
    public function setRequestAt($requestAt)
    {
        $this->requestAt = $requestAt;
    }

    /**
     * @return mixed
     */
    public function getEmailRequest()
    {
        return $this->emailRequest;
    }

    /**
     * @param mixed $emailRequest
     */
    public function setEmailRequest($emailRequest)
    {
        $this->emailRequest = $emailRequest;
    }

    /**
     * @return mixed
     */
    public function getTypeRequest()
    {
        return $this->typeRequest;
    }

    /**
     * @param mixed $typeRequest
     */
    public function setTypeRequest($typeRequest)
    {
        $this->typeRequest = $typeRequest;
    }

    /**
     * @return mixed
     */
    public function getRequestCode()
    {
        return $this->requestCode;
    }

    /**
     * @param mixed $requestCode
     */
    public function setRequestCode($requestCode)
    {
        $this->requestCode = $requestCode;
    }

}