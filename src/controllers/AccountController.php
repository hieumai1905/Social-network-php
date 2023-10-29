<?php

namespace controllers;

use Google\Exception;
use https\Response;
use https\Status;
use services\mail\Mailer;
use services\request\IRequestService;
use services\user\IUserService;
use models\Request;

require_once 'src/services/mail/Mailer.php';
require_once 'src/https/Status.php';

class AccountController
{
    private $userService;

    private $requestService;

    public function __construct(IUserService $userService, IRequestService $requestService)
    {
        $this->userService = $userService;
        $this->requestService = $requestService;
    }

    //---------------------------HTTP GET--------------------------------

    // HTTP:GET('/login')
    public function showFormLogin()
    {
        return Response::view('views/Login');
    }

    // HTTP:GET('/register')
    public function showFormRegister()
    {
        return Response::view('views/Register');
    }

    // HTTP:GET('/forgot')
    public function showFormForgot()
    {
        return Response::view('views/Forgot');
    }

    // HTTP:GET('/logout')
    public function logoutAccount()
    {
        session_destroy();
        return Response::view('views/Login');
    }

    // HTTP:GET('/register/confirm')
    public function showFormConfirmRegister()
    {
        try {
            $userRegister = null;
            if (isset($_SESSION['user-register'])) {
                $userRegister = unserialize($_SESSION['user-register']);
            }
            if ($userRegister) {
                $email = $userRegister->getEmail();
                $this->requestService->cleanRequestCode();
                $request = $this->requestService->getRequestByEmail($email);
                $code = rand(100000, 999999);
                if ($request) {
                    $request->setRequestCode($code);
                    $request->setTypeRequest('REGISTER');
                    $this->requestService->update($request);
                } else {
                    $request = new Request();
                    $request->setRequestCode($code);
                    $request->setEmailRequest($email);
                    $request->setTypeRequest('REGISTER');
                    $this->requestService->add($request);
                }
                Mailer::sendEmail($email, 'Confirm Register Account!', 'Your code is: ' . $code);
                return Response::view('views/Confirm-Code', ['email' => $email]);
            }
            return Response::view('views/404');
        } catch (Exception $e) {
            return Response::view('views/Error');
        }
    }

    //---------------------------------------------------------------------


    //---------------------------HTTP POST--------------------------------

    // HTTP:POST('/login')
    public function loginAccount()
    {
        try {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                if ($email == "" || $password == "") {
                    return Response::View('views/Login', ['error' => 'Email or password is empty']);
                }
                $userLogin = $this->userService->loginAccount($email, $password);
                if ($userLogin) {
                    if ($userLogin->getStatus() == "LOCK") {
                        return Response::View('views/Lock');
                    }
                    if ($userLogin->getStatus() == "INACTIVE") {
                        $_SESSION['user-register'] = serialize($userLogin);
                        return Response::redirect('/register/confirm');
                    }
                    $_SESSION['user-login'] = serialize($userLogin);
                    if ($userLogin->getUserRole() == "ADMIN") {
                        return Response::redirect('/admin');
                    }
                    return Response::redirect('/home');
                }
                return Response::View('views/Login', ['error' => 'Email or password incorect']);
            }
            return Response::view('views/404');
        } catch (\Exception $e) {
            return Response::View('views/Error');
        }
    }

    // HTTP:POST('/register')
    public function registerAccount()
    {
        try {
            if (isset($_POST['full-name']) && isset($_POST['email']) && isset($_POST['password-input']) && isset($_POST['password-confirm'])) {
                $fullName = $_POST['full-name'];
                $email = $_POST['email'];
                $password = $_POST['password-input'];
                $confirmPassword = $_POST['password-confirm'];
                $userExist = $this->userService->getUserByEmail($email);
                if ($userExist) {
                    return Response::View('views/Register', ['error' => 'Email already exists']);
                }
                if ($password == $confirmPassword) {
                    $code = rand(100000, 999999);
                    Mailer::sendEmail($email, 'Confirm email', 'Your code is: ' . $code);
                    $request = new Request();
                    $request->setRequestCode($code);
                    $request->setEmailRequest($email);
                    $request->setTypeRequest('REGISTER');
                    $this->requestService->cleanRequestCode();
                    $this->requestService->add($request);
                    $userRegister = $this->userService->registerAccount($fullName, $email, $password);
                    if (isset($userRegister)) {
                        $_SESSION['user-register'] = serialize($userRegister);
                        return Response::redirect('/register/confirm');
                    }
                } else {
                    return Response::View('views/Register', ['error' => 'Password and confirm password is not match']);
                }
                return Response::View('views/Register', ['error' => 'Register failed']);
            }
            return Response::view('views/404');
        } catch (\Exception $e) {
            return Response::View('views/Register', ['error' => $e->getMessage()]);
        }
    }

    // HTTP:POST('/register/confirm')
    public function confirmRegisterAccount()
    {
        try {
            if (isset($_POST['confirm-code'])) {
                $code = $_POST['confirm-code'];
                $userRegister = null;
                if (isset($_SESSION['user-register'])) {
                    $userRegister = unserialize($_SESSION['user-register']);
                }
                if ($userRegister) {
                    $error = 'Code is incorect';
                    $email = $userRegister->getEmail();
                    $request = $this->requestService->getRequestByEmail($email);
                    if(!isset($request)){
                        return Response::view('views/404');
                    }
                    if (isset($request) && $request->getRequestCode() == $code && $request->getTypeRequest() == 'REGISTER') {
                        $requestValid = $request->getRequestAt() > date('Y-m-d H:i:s', strtotime('-1 minutes'));
                        if (!$requestValid) {
                            $error = 'Code expire';
                        } else {
                            $userRegister->setStatus('ACTIVE');
                            $this->userService->update($userRegister);
                            $this->requestService->delete($request->getRequestId());
                            $_SESSION['user-register'] = null;
                            return Response::redirect('/login');
                        }
                    }
                    return Response::View('views/Confirm-Code', ['error' => $error, 'email' => $email]);
                }
                return Response::View('views/Error');
            }
            return Response::view('views/404');
        } catch (\Exception $e) {
            return Response::View('views/Error');
        }
    }

    // API HTTP:POST('/api/account/forgot')
    public function getCodeForgot()
    {
        try {
            $json = Response::getJson();
            if (isset($json)) {
                $email = $json['email-reset'];
                $user = $this->userService->getUserByEmail($email);
                if ($user) {
                    if ($user->getStatus() == 'LOCK') {
                        return Response::apiResponse(Status::FORBIDDEN, 'Account is locked');
                    }
                    $code = rand(100000, 999999);
                    Mailer::sendEmail($email, 'Forgot password', 'Your code is: ' . $code);
                    $this->requestService->cleanRequestCode();
                    $request = $this->requestService->getRequestByEmail($email);
                    if ($request) {
                        $request->setRequestCode($code);
                        $request->setTypeRequest("FORGOT");
                        $this->requestService->update($request);
                    } else {
                        $request = new Request();
                        $request->setRequestCode($code);
                        $request->setEmailRequest($email);
                        $request->setTypeRequest('FORGOT');
                        $this->requestService->add($request);
                    }
                } else {
                    return Response::apiResponse(Status::NOT_FOUND, 'Account is not exist');
                }
                return Response::apiResponse(Status::OK);
            }
            return Response::apiResponse(Status::BAD_REQUEST, 'An error occurred');
        } catch (\Exception $e) {
            return Response::apiResponse(Status::BAD_REQUEST, $e->getMessage());
        }
    }

    // HTTP:POST('/account/forgot/confirm')
    public function confirmForgotPassword()
    {
        try {
            if (isset($_POST['code-reset']) && isset($_POST['email-reset'])) {
                $code = $_POST['code-reset'];
                $email = $_POST['email-reset'];
                $request = $this->requestService->getRequestByEmail($email);
                if ($request && $request->getRequestCode() == $code && $request->getTypeRequest() == 'FORGOT') {
                    $validCode = $request->getRequestAt() > date('Y-m-d H:i:s', strtotime('-1 minutes'));
                    if (!$validCode) {
                        return Response::View('views/Forgot', ['error' => 'Code expire']);
                    }
                    $request->setTypeRequest('RESET');
                    $this->requestService->update($request);
                    $_SESSION['email-user-reset-password'] = $email;
                    return Response::View('views/Update-password');
                }
                return Response::View('views/Forgot', ['error' => 'Code is incorect', 'email_reset' => $email]);
            }
        } catch (\Exception $e) {
            return Response::View('views/Forgot', ['error' => $e->getMessage()]);
        }
    }

    // HTTP:POST('/account/reset-password')
    public function updatePassword()
    {
        try {
            if (isset($_SESSION['email-user-reset-password']) && isset($_POST['password-reset']) && isset($_POST['password-confirm-reset'])) {
                $email = $_SESSION['email-user-reset-password'];
                $password = $_POST['password-reset'];
                $confirmPassword = $_POST['password-confirm-reset'];
                if ($password == $confirmPassword) {
                    $request = $this->requestService->getRequestByEmail($email);
                    $requestValid = $request->getTypeRequest() == 'RESET' && $request->getRequestAt() > date('Y-m-d H:i:s', strtotime('-1 minutes'));
                    if (!$requestValid) {
                        return Response::View('views/404');
                    }
                    $this->requestService->delete($request->getRequestId());
                    $user = $this->userService->getUserByEmail($email);
                    if ($user) {
                        $user->setPassword($password);
                        $this->userService->update($user);
                        return Response::redirect('/login');
                    }
                } else {
                    return Response::View('views/Update-password', ['error' => 'Password and confirm password is not match']);
                }
            }
            return Response::View('views/404');
        } catch (\Exception $e) {
            return Response::View('views/Update-password', ['error' => $e->getMessage()]);
        }
    }

    // API HTTP:POST('/api/refresh-code')
    public function refreshCode()
    {
        try {
            $json = Response::getJson();
            if (isset($json)) {
                $email = $json['email-refresh-code'];
                if (!$email) {
                    throw new Exception("Email don't exist");
                }
                $request = $this->requestService->getRequestByEmail($email);
                if (!$request) {
                    throw new Exception("Email don't exist request");
                }
                $code = rand(100000, 999999);
                Mailer::sendEmail($email, 'Confirm code', 'Your code is: ' . $code);
                $this->requestService->refreshCode($email, $code);
                return Response::apiResponse(Status::OK);
            }
            return Response::apiResponse(Status::BAD_REQUEST, 'An error occurred');
        } catch (\Exception $e) {
            return Response::apiResponse(Status::BAD_REQUEST, $e->getMessage());
        }
    }

    //---------------------------------------------------------------------

    //---------------------------HTTP PUT---------------------------------


    //---------------------------------------------------------------------
}