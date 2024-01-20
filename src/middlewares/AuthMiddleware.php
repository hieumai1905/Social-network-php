<?php

namespace middlewares;

use https\Response;

require_once 'Middleware.php';

class AuthMiddleware implements Middleware
{
    public function __construct()
    {
    }

    function handle(...$args)
    {
        $checkRole = self::checkAuth($args[0]);
        if ($checkRole == -1) {
            return Response::View('views/Login');
        }
        if ($checkRole == 401) {
            return Response::View('views/Login');
        }
        if ($checkRole == 403) {
            return Response::View('views/403');
        }
        if ($checkRole == 404) {
            return Response::view('views/404');
        }

    }

    private static function checkAuth($route)
    {
        $isResource = str_starts_with($route, '/public');
        if ($isResource) {
            return 200;
        }
        if ($route == '/login' || $route == '/register' || $route == '/account/forgot' || $route == '/api/forgot/confirm' || $route == '/account/forgot/confirm'
            || $route == '/account/reset-password' || $route == '/api/refresh-code' || $route == '/register/confirm' || $route == '/error' || $route == '/update-password' || $route == '/logout') {
            return 200;
        } else {
            if (isset($_SESSION['user-login'])) {
                $loginAt = $_SESSION['login-at'];
                $timeCurrent = time();
                if ($timeCurrent - $loginAt > 6000) {
                    unset($_SESSION['user-login']);
                    unset($_SESSION['login-at']);
                    return 401;
                }
                $user = unserialize($_SESSION['user-login']);
                if ($route == '/admin/dash-board' || $route == '/admin' || $route == '/admin/users' || $route == '/api/admin/users-all' || $route == '/api/admin/lock-user' || $route == '/api/admin/users-all/month') {
                    if ($user->getUserRole() == "ADMIN") {
                        return 200;
                    } else {
                        return 403;
                    }
                }
                return 200;
            } else {
                return 401;
            }
        }
    }
}