<?php

namespace controllers;


use Google\Exception;
use https\Response;
use https\Status;
use Media;
use services\user\IUserService;
use storage\Mapper;

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

    public function getUser($id) {
        $user = $this->userService->getById($id);
        $data = Mapper::mapModelToJson($user);
        return Response::apiResponse(Status::OK,'success',$data);
    }
    public function findUserByContent($content) {
        try {
            $users = $this->userService->findUserByContent($content);
            if (!$users) {
                return Response::view('views/Search',['users'=>[]]);
            }
            return Response::view('views/Search',['users'=>$users]);
        }catch (Exception $e) {
            return Response::view('views/Error',['error'=>$e->getMessage()]);
        }
    }

    //---------------------------------------------------------------------
    //---------------------------HTTP POST--------------------------------


    //---------------------------------------------------------------------
}