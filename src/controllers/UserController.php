<?php

namespace controllers;


use Google\Exception;
use Google\Service\AlertCenter\User;
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
    public function getUserToEditProfile() {
        $userLogin = unserialize($_SESSION['user-login']);
        $user = $this->userService->getById($userLogin->getUserId());
        return Response::view('views/Edit-Information',['user'=>$user]);
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

    //---------------------------HTTP PUT--------------------------------
    public function updateUser() {
        try {
            $userLogin = unserialize($_SESSION['user-login']);
            $user = new \models\User();
            $json = Response::getJson();
            $user->setUserId($userLogin->getUserId());
            $user->setFullName($json['full_name']);
            $user->setAvatar($userLogin->getAvatar());
            $user->setPassword($userLogin->getPassword());
            $user->setEmail($userLogin->getEmail());
            $user->setDob($json['dob']);
            $user->setAddress($json['address']);
            $user->setGender($json['gender']);
            $user->setPhone($userLogin->getPhone());
            $user->setStatus($userLogin->getStatus());
            $user->setUserRole($userLogin->getUserRole());
            $user->setAboutMe($json['about_me']);
            $user->setCoverImage($userLogin->getCoverImage());
            $user->setRegisterAt($userLogin->getRegisterAt());
            $this->userService->update($user);
            return Response::apiResponse(Status::OK,'success',null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR,$e->getMessage(),null);
        }
    }

    //---------------------------------------------------------------------
}