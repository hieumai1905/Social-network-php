<?php

namespace controllers;

use Exception;
use https\Status;
use https\Response;
use services\user\IUserService;
use storage\Mapper;

require_once 'src/https/Status.php';

class AdminController
{
    private $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }


    //---------------------------HTTP GET---------------------------------

    // HTTP GET("/api/admin/users-all")
    public function getUsers()
    {
        try {
            $users = $this->userService->getAll();
            if (!$users) {
                return Response::apiResponse(Status::NOT_FOUND, 'user is null', null);
            } else {
                $data = [];
                foreach ($users as $user) {
                    $data[] = Mapper::mapModelToJson($user);
                }
                return Response::apiResponse(Status::OK, 'success', $data);
            }
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    //---------------------------------------------------------------------


    //---------------------------HTTP PUT--------------------------------

    // HTTP PUT("/admin/lock-user")
    public function lockUser()
    {
        try {
            $json = Response::getJson();
            if (!isset($json['user_id'])) {
                throw new Exception('ID is null');
            }
            $userId = $json['user_id'];
            $user = $this->userService->getById($userId);
            if (!$user) {
                return Response::apiResponse(Status::NOT_FOUND, 'user is null', null);
            }
            $status = $user->getStatus();

            if ($status == "LOCK") {
                $this->userService->lockUser($userId);
                return Response::apiResponse(Status::OK, 'Un lock success', null);
            } else {
                $this->userService->lockUser($userId);
                return Response::apiResponse(Status::OK, 'Lock success', null);
            }
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }

    //---------------------------------------------------------------------


    //--------------------------HTTP DELETE--------------------------------


    // HTTP DELETE("/users/{id}")
    public function deleteUser()
    {

    }

    //---------------------------------------------------------------------

}