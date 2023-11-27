<?php

namespace controllers;

use Google\Exception;
use https\Response;
use https\Status;
use services\conversations\IConversationService;
use services\message\IMessageService;
use services\notification\NotificationService;
use services\relation\IRelationService;
use services\user\IUserService;
use storage\Mapper;

class MessageController
{
    private $messageService;
    private $relationService;
    private $userService;
    private $conversationService;
    public function __construct(IRelationService $relationService, IUserService $userService, IMessageService $messageService, IConversationService $conversationService)
    {
        $this->relationService = $relationService;
        $this->userService = $userService;
        $this->messageService = $messageService;
        $this->conversationService = $conversationService;
    }
    //-------------------------------HTTP GET --------------------------------
    function showMessageView()
    {

        $frendId = $_GET['userId'];
        $frendName = $_GET['name'];
        $currUser = unserialize($_SESSION['user-login']);
        $userId = $currUser->getUserId();
        $userName = $currUser->getFullname();
        $avatarFriend = $this->userService->getById($frendId)->getAvatar();

        try {
            $conOfUser = $this->conversationService->getByNameAndId($frendName, $userId);
            $conOfFrend = $this->conversationService->getByNameAndId($userName, $frendId);
            if ($conOfUser == null) {
                $conOfUser = $this->conversationService->create($frendName, 'PRIVATE', $userId);
            }

            $conId = $conOfUser->getConversationId();

            $msg = $this->messageService->getByConId($conOfUser->getConversationId(), $conOfFrend != null ? $conOfFrend->getConversationId() : null);
            if($msg==null){
                $msg=[];
            }
            return Response::view('views/Message', ['userId' => $userId, 'mesg' => $msg, 'friendId' => $frendId, 'conver'=> $conOfUser->getConversationId(),'avatarFriend'=>$avatarFriend]);
        } catch (\Exception $e) {
            //throw $th;
            throw new \Exception($e->getMessage());
        }


    }
    public function getFriendOfUser()
    {
        try {
            $userId = unserialize($_SESSION['user-login'])->getUserId();
            $result = $this->relationService->getFriendForUser($userId);
            if (!$result) {
                Response::apiResponse(Status::OK, 'success', []);
            }
            $user = [];
            foreach ($result as $item) {
                $user[] = Mapper::mapModelToJson($this->userService->getById($item->getUserTargetId()));
            }
            Response::apiResponse(Status::OK, 'success', $user);
        } catch (Exception $e) {
            Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), $e->getMessage());
        }
    }


    public function addMessage()
    {
        $idUser = $_POST['userId'];
        $content = $_POST['message'];
        $conversattion = $_POST['conver'];

        if(empty($content) || empty($conversattion) || empty($idUser)) {
            return ;
        }

        try {
            $result = $this->messageService->createMess($idUser, $content, $conversattion);

            if ($result == true) {
                Response::apiResponse(Status::OK, 'success', []);
            }

        } catch (Exception $e) {
            Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), $e->getMessage());
        }
    }

}