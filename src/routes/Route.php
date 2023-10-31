<?php

namespace routes;

use https\Response;
use middlewares\MiddlewareRegister;
use registrations\DIContainer;

require_once 'src/controllers/UserController.php';
require_once 'src/registrations/DIContainer.php';
require_once 'src/middlewares/MiddlewareRegister.php';

class Route
{
    private static $routes = [];
    private static $prefix = '';
    private static $container = null;

    public static function get($route, $callback)
    {
        self::$routes[] = [
            'method' => 'GET',
            'route' => self::$prefix . $route,
            'callback' => $callback,
        ];
    }

    public static function post($route, $callback)
    {
        self::$routes[] = [
            'method' => 'POST',
            'route' => self::$prefix . $route,
            'callback' => $callback,
        ];
    }

    public static function put($route, $callback)
    {
        self::$routes[] = [
            'method' => 'PUT',
            'route' => self::$prefix . $route,
            'callback' => $callback,
        ];
    }

    public static function patch($route, $callback)
    {
        self::$routes[] = [
            'method' => 'PATCH',
            'route' => self::$prefix . $route,
            'callback' => $callback,
        ];
    }

    public static function delete($route, $callback)
    {
        self::$routes[] = [
            'method' => 'DELETE',
            'route' => self::$prefix . $route,
            'callback' => $callback,
        ];
    }

    public static function any($route, $callback)
    {
        self::$routes[] = [
            'method' => 'ANY',
            'route' => self::$prefix . $route,
            'callback' => $callback,
        ];
    }

    public static function group($prefix, $callback)
    {
        $previousPrefix = self::$prefix;
        self::$prefix .= $prefix;
        $callback();
        self::$prefix = $previousPrefix;
    }

    public static function dispatch()
    {
        if (self::$container == null) {
            self::$container = DIContainer::getInstance();
        }
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $checkRole = self::checkAuth($uri);
        if ($checkRole == 401) {
            return Response::view('views/Login');
        }
        if ($checkRole == 403) {
            return Response::view('views/403');
        }
        if ($checkRole == 404) {
            return Response::view('views/404');
        }
        foreach (self::$routes as $route) {
            $routeCurrent = strval($uri);
            if (MiddlewareRegister::hasMiddleware($route['route']) and $routeCurrent == $route['route']) {
                MiddlewareRegister::run($route['route']);
            }
            if ($route['method'] === 'ANY' || $route['method'] === $method) {
                $pattern = self::buildPattern($route['route']);
                if (preg_match($pattern, $uri, $matches)) {
                    array_shift($matches);
                    $callback = $route['callback'];
                    if (is_callable($callback)) {
                        call_user_func_array($callback, $matches);
                        return;
                    }

                    $controllerAction = explode('@', $callback);
                    $controllerName = $controllerAction[0];
                    $actionName = $controllerAction[1];

                    $controllerClass = "\\controllers\\" . $controllerName;
                    $controllerInstance = self::$container->resolve($controllerClass);
                    $controllerInstance->$actionName(...$matches);
                    return;
                }
            }
        }
        // Route not found, handle 404
        self::handleNotFound();
    }

    private static function buildPattern($route)
    {
        $delimiter = '#';
        $pattern = $delimiter . '^' . str_replace('/', '\/', $route) . '$' . $delimiter;
        $pattern = preg_replace($delimiter . '{[^/]+}' . $delimiter, '([^/]+)', $pattern);
        return $pattern;
    }

    private static function handleNotFound()
    {
        http_response_code(404);
        include_once 'public/pages/404.php';
    }

    public static function registerResource()
    {
        self::registerResourcesInDirectory('public');
    }

    private static function registerResourcesInDirectory(string $directory)
    {
        $files = scandir($directory);

        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $filePath = "$directory/$file";

            if (is_dir($filePath)) {
                self::registerResourcesInDirectory($filePath);
            } else {
                $contentType = mime_content_type($filePath);
                Route::get("/$filePath", function () use ($filePath, $contentType) {
                    self::readResource($filePath, $contentType);
                });
            }
        }
    }

    private static function readResource(string $filePath)
    {
        if (file_exists($filePath)) {
            $ext = pathinfo($filePath, PATHINFO_EXTENSION);

            if ($ext === 'css') {
                header('Content-Type: text/css');
            } else {
                $contentType = mime_content_type($filePath);
                header('Content-Type: ' . $contentType);
            }

            readfile($filePath);
        } else {
            http_response_code(404);
            echo 'File not found';
        }
    }

    private static function checkAuth($route)
    {
        $isResource = str_starts_with($route, '/public');
        if ($isResource) {
            return 200;
        }
        if ($route == '/login' || $route == '/register' || $route == '/account/forgot' || $route == '/api/forgot/confirm' || $route == '/account/forgot/confirm'
            || $route == '/account/reset-password' || $route == '/api/refresh-code' || $route == '/register/confirm' || $route == '/error' || $route == '/update-password' || $route=='/logout') {
            return 200;
        } else {
            if (isset($_SESSION['user-login'])) {
                $user = unserialize($_SESSION['user-login']);
                if ($route == '/admin/dash-board' || $route == '/admin' || $route == '/admin/users' || $route == '/api/admin/users-all' || $route == '/api/admin/lock-user' || $route=='/api/admin/users-all/month') {
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