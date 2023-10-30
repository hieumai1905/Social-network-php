<?php

namespace controllers;


use https\Response;
use Media;
use services\user\IUserService;

require_once 'src/https/Response.php';
require_once 'src/models/Media.php';

class UserController
{
    private $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    //---------------------------HTTP GET--------------------------------

    public function getAllUser()
    {
        $this->userService->getAll();
    }

    public function getUserById($id)
    {
        $user = $this->userService->getById($id);
        return Response::view('views/Profile',['user'=>$user]);
    }

    //---------------------------------------------------------------------
    //---------------------------HTTP POST--------------------------------


    //---------------------------------------------------------------------
}