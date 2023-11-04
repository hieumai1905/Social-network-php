<?php

namespace controllers;


use Google\Exception;
use https\Response;
use https\Status;
use Media;
use models\Request;
use services\handle\Encryption;
use services\mail\Mailer;
use services\media\IMediaService;
use services\relation\IRelationService;
use services\request\IRequestService;
use services\user\IUserService;
use storage\Mapper;

require_once 'src/https/Response.php';
require_once 'src/models/Media.php';
require_once 'src/https/Status.php';
require_once 'src/services/mail/Mailer.php';
require_once 'src/services/handle/Encryption.php';

class UserController
{
    private $userService;
    private $requestService;
    private $relationService;
    private $mediaService;

  public function __construct(IUserService $userService, IRequestService $requestService,IRelationService $relationService,IMediaService $mediaService)
    {
        $this->userService = $userService;
        $this->requestService = $requestService;
        $this->relationService = $relationService;
        $this->mediaService = $mediaService;
    }

    //---------------------------HTTP GET--------------------------------

    public function getAllUser()
    {
        $this->userService->getAll();
    }

    public function getUserById($id)
    {
        $user = $this->userService->getById($id);
        $medias = $this->mediaService->getMediaOfUser($id);
        return Response::view('views/Profile',['user'=>$user,'medias'=>$medias]);
    }

    public function getUser($id)
    {
        $user = $this->userService->getById($id);
        $data = Mapper::mapModelToJson($user);
        return Response::apiResponse(Status::OK, 'success', $data);
    }

    public function getUserToEditProfile()
    {
        $userLogin = unserialize($_SESSION['user-login']);
        $user = $this->userService->getById($userLogin->getUserId());
        return Response::view('views/Edit-Information', ['user' => $user]);
    }

    public function findUserByContent($content)
    {
        try {
            $userLogin = unserialize($_SESSION['user-login']);
            $users = $this->userService->findUserByContent($content);
            if (!$users) {
                return Response::view('views/Search', ['users' => []]);
            }
            $result = [];
            foreach ($users as $item) {
                if ($item->getUserId() == $userLogin->getUserId()) {
                    continue;
                }
                $result[] = $item;
            }
            $relation = [];
            foreach ($users as $item) {
                $relation[] = $this->relationService->getRelationBetweenUserAndUserTargetExceptFollow($userLogin->getUserId(), $item->getUserId());
            }
            return Response::view('views/Search', ['users' => $result, 'relation' => $relation]);
        } catch (Exception $e) {
            return Response::view('views/Error', ['error' => $e->getMessage()]);
        }
    }

    // HTTP GET("/change-email")
    public function showFormChangeEmail()
    {
        return Response::view('views/Change-Email');
    }

    // HTTP GET("/settings")
    public function showFormSetting()
    {
        return Response::view('views/Setting');
    }

    // HTTP GET("/change-password")
    public function showFormChangePassword()
    {
        return Response::view('views/Change-Password');
    }

    //---------------------------------------------------------------------


    //---------------------------HTTP POST--------------------------------

    // API HTTP POST("/api/change-email/code")
    public function getCodeChangeEmail()
    {
        try {
            $json = Response::getJson();
            if (!isset($json)) {
                return Response::apiResponse(Status::BAD_REQUEST, 'Email is null', null);
            }
            $email = $json['new-email'];

            $userExist = $this->userService->getUserByEmail($email);
            if ($userExist) {
                return Response::apiResponse(Status::BAD_REQUEST, 'Email is exist', null);
            }

            $code = rand(100000, 999999);
            $request = new Request();
            $request->setRequestCode($code);
            $request->setEmailRequest($email);
            $request->setTypeRequest('CHANGE-EMAIL');
            $this->requestService->cleanRequestCode();
            $this->requestService->add($request);
            Mailer::sendEmail($email, 'Change email email!', 'Your code is: ' . $code);
            $_SESSION['email'] = $email;
            return Response::apiResponse(Status::OK, 'success', null);
        } catch (\Exception $e) {
            return Response::View('views/Error');
        }
    }

    // HTTP POST("/change-email")
    public function changeEmail()
    {
        try {
            if (isset($_POST['code-change-email'])) {
                $code = $_POST['code-change-email'];
                $email = $_SESSION['email'];
                $request = $this->requestService->getRequestByEmail($email);
                if (!$request) {
                    return esponse::view('views/404');
                }
                if ($request->getTypeRequest() != 'CHANGE-EMAIL') {
                    return Response::view('views/Change-Email', ['error' => 'Email is not correct']);
                }
                if ($request->getRequestCode() != $code) {
                    return Response::view('views/Change-Email', ['error' => 'Code is not correct']);
                }
                $requestValid = $request->getRequestAt() > date('Y-m-d H:i:s', strtotime('-1 minutes'));
                if (!$requestValid) {
                    return Response::view('views/Change-Email', ['error' => 'Code is expired']);
                }

                $user = unserialize($_SESSION['user-login']);
                $user->setEmail($email);
                $this->userService->update($user);
                $this->requestService->delete($request->getRequestId());
                unset($_SESSION['email']);
                return Response::view('views/Change-Email', ['success' => 'Change email success']);
            } else {
                return Response::view('views/Change-Email');
            }
        } catch (\Exception $e) {
            return Response::View('views/Error');
        }
    }

    // HTTP POST("/change-password")
    public function changePassword()
    {
        try {
            if (isset($_POST['old-password']) && isset($_POST['new-password']) && isset($_POST['confirm-password'])) {
                $oldPassword = $_POST['old-password'];
                $newPassword = $_POST['new-password'];
                $confirmPassword = $_POST['confirm-password'];
                $user = unserialize($_SESSION['user-login']);
                if ($user->getPassword() != Encryption::encrypt($oldPassword)) {
                    return Response::view('views/Change-Password', ['error' => 'Old password is not correct']);
                }
                if ($newPassword != $confirmPassword) {
                    return Response::view('views/Change-Password', ['error' => 'Confirm password is not correct']);
                }
                $user->setPassword(Encryption::encrypt($newPassword));
                $this->userService->update($user);
                $_SESSION['user-login'] = serialize($user);
                return Response::view('views/Change-Password', ['error' => 'Change password success']);
            }
        } catch (\Exception $e) {
            return Response::View('views/Error');
        }
    }

    //---------------------------------------------------------------------

    //---------------------------HTTP PUT--------------------------------
    public function updateUser()
    {
        try {
            $userLogin = unserialize($_SESSION['user-login']);
            $user = new \models\User();
            $json = Response::getJson();
            $user->setUserId($userLogin->getUserId());
            $user->setFullName($json['full_name']);
            $user->setAvatar($userLogin->getAvatar());
            $user->setPassword(Encryption::encrypt($userLogin->getPassword()));
            $user->setEmail($userLogin->getEmail());
            $user->setDob($json['dob']);
            $user->setAddress($json['address']);
            $user->setGender($json['gender']);
            $user->setPhone($json['phone']);
            $user->setStatus($userLogin->getStatus());
            $user->setUserRole($userLogin->getUserRole());
            $user->setAboutMe($json['about_me']);
            $user->setCoverImage($userLogin->getCoverImage());
            $user->setRegisterAt($userLogin->getRegisterAt());
            $this->userService->update($user);
            return Response::apiResponse(Status::OK, 'success', null);
        } catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR, $e->getMessage(), null);
        }
    }
    public function changeAvatar($image) {
      try {
          $this->userService->updateAvatar($image);
          return Response::apiResponse(Status::OK,'success',null);
      }catch (Exception $e) {
          return Response::apiResponse(Status::INTERNAL_SERVER_ERROR,$e->getMessage(),null);
      }
    }
    public function changeCoverImage($image) {
        try {
            $this->userService->updateCoverImage($image);
            return Response::apiResponse(Status::OK,'success',null);
        }catch (Exception $e) {
            return Response::apiResponse(Status::INTERNAL_SERVER_ERROR,$e->getMessage(),null);
        }
    }

    //---------------------------------------------------------------------
}