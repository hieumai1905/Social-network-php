<?php

namespace DAO\Exceptions;

class SystemException extends \Exception
{
    function __construct($message)
    {
        parent::__construct($message);
    }
}