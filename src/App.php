<?php
session_start();

use https\Request;
use registrations\RegisterSingleton;
use function routes\registerMiddleware;
use function routes\registerRoute;

require_once 'routes/Web.php';
require_once 'registrations/RegisterSingleton.php';
require_once 'https/Request.php';

//---------------------------Register Singleton----------------------------
$registerSingleton = RegisterSingleton::getInstance();
$registerSingleton->register();

// inject request to DI Container
$registerSingleton->registerRequest(Request::getRequestCurrent());
//-------------------------------------------------------------------------

//-------------------------Register middleware------------------------------
registerMiddleware();
//-------------------------------------------------------------------------

//---------------------------Register route--------------------------------
registerRoute();
//-------------------------------------------------------------------------


