<?php

namespace services\request;

use services\IGeneralService;
use models\Request;

require_once 'src/services/IGeneralService.php';

interface IRequestService extends IGeneralService
{
    public function getRequestByEmail($email):?Request;

    public function cleanRequestCode();

    public function refreshCode($email, $code);

}