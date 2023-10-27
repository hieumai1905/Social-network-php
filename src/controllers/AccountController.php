<?php

namespace controllers;

use https\Response;
use services\user\IUserService;

class AccountController
{
    private $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    //---------------------------HTTP GET--------------------------------

    public function showFormLogin()
    {
        return Response::view('views/Login');
    }

    public function showFormRegister()
    {
        return Response::view('views/Register');
    }

    public function showFormForgot()
    {
        return Response::view('views/Forgot');
    }
    //---------------------------------------------------------------------


    //---------------------------HTTP POST--------------------------------

    public function loginAccount()
    {
        try {
            if (isset($_POST['email']) && isset($_POST['password'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];
                $userLogin = $this->userService->loginAccount($email, $password);
                if ($userLogin) {
                    $_SESSION['user'] = $userLogin;
                    return Response::redirect('/home');
                }
            }
            return Response::View('views/Login', ['error' => 'Email or password is incorrect']);
        } catch (\Exception $e) {
            return Response::View('views/Login', ['error' => $e->getMessage()]);
        }
    }

    public function registerAccount()
    {
        try {
            if (isset($_POST['full-name']) && isset($_POST['email']) && isset($_POST['password-input']) && isset($_POST['password-confirm'])) {
                $fullName = $_POST['full-name'];
                $email = $_POST['email'];
                $password = $_POST['password-input'];
                $confirmPassword = $_POST['password-confirm'];
                if ($password == $confirmPassword) {
                    $userRegister = $this->userService->registerAccount($fullName, $email, $password);
                    if (isset($userRegister)) {
                        $_SESSION['user'] = $userRegister;
                        return Response::redirect('/home');
                    }
                }else{
                    return Response::View('views/Register', ['error' => 'Password and confirm password is not match']);
                }
                return Response::View('views/Register', ['error' => 'Register failed']);
            }
        } catch (\Exception $e) {
            return Response::View('views/Register', ['error' => $e->getMessage()]);
        }
    }

    public function forgotPassword()
    {
        echo 'forgot ne';
    }

    //---------------------------------------------------------------------

    //---------------------------HTTP PUT--------------------------------


    //---------------------------------------------------------------------
}