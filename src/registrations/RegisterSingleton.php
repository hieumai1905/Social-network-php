<?php

namespace registrations;

use controllers\AccountController;
use controllers\UserController;
use DAO\user\UserDAO;
use https\Request;
use services\user\UserService;

require_once __DIR__ . '/DIContainer.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../services/user/UserService.php';
require_once __DIR__ . '/../DAO/user/UserDAO.php';
require_once __DIR__ . '/../https/Request.php';
require_once __DIR__ . '/../controllers/AccountController.php';

class RegisterSingleton
{
    private static $container = null;
    private static $instance = null;

    private function __construct()
    {
    }

    public static function getInstance(): RegisterSingleton
    {
        if (self::$instance == null) {
            self::$instance = new RegisterSingleton();
        }
        return self::$instance;
    }

    public function getContainer(): DIContainer
    {
        if (self::$container == null) {
            self::$container = DIContainer::getInstance();
        }
        return self::$container;
    }

    public function register(): void {
        $container = $this->getContainer();

        $container->register('\DAO\user\IUserDAO', function () {
            return new UserDAO();
        });

        $container->register('\services\user\IUserService', function () use ($container){
            return new UserService(
                $container->resolve('\DAO\user\IUserDAO')
            );
        });

        $container->register('\controllers\UserController', function () use ($container) {
            return new UserController(
                $container->resolve('\services\user\IUserService')
            );
        });

        $container->register('\controllers\AccountController', function () use ($container) {
            return new AccountController(
                $container->resolve('\services\user\IUserService')
            );
        });
    }
    public function registerRequest(Request $request): void
    {
        $container = $this->getContainer();

        if (!$container->has(Request::class)) {
            $container->register(Request::class, function () use ($request) {
                return $request;
            });
        }
    }
}
