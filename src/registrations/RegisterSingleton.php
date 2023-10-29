<?php

namespace registrations;

use controllers\AccountController;
use controllers\RelationController;
use controllers\UserController;
use DAO\relation\RelationDAO;
use DAO\request\RequestDAO;
use DAO\user\UserDAO;
use https\Request;
use services\relation\RelationService;
use services\request\RequestService;
use services\user\UserService;

require_once __DIR__ . '/DIContainer.php';
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../services/user/UserService.php';
require_once __DIR__ . '/../services/request/RequestService.php';
require_once __DIR__ . '/../DAO/user/UserDAO.php';
require_once __DIR__ . '/../DAO/request/RequestDAO.php';
require_once __DIR__ . '/../https/Request.php';
require_once __DIR__ . '/../controllers/AccountController.php';
require_once __DIR__ . '/../controllers/RelationController.php';
require_once __DIR__ . '/../DAO/relation/RelationDAO.php';
require_once __DIR__ . '/../services/relation/RelationService.php';

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

        $container->register('\DAO\request\IRequestDAO', function () {
            return new RequestDAO();
        });

        $container->register('\services\user\IUserService', function () use ($container){
            return new UserService(
                $container->resolve('\DAO\user\IUserDAO')
            );
        });

        $container->register('\services\request\IRequestService', function () use ($container){
            return new RequestService(
                $container->resolve('\DAO\request\IRequestDAO')
            );
        });

        $container->register('\controllers\UserController', function () use ($container) {
            return new UserController(
                $container->resolve('\services\user\IUserService')
            );
        });

        $container->register('\controllers\AccountController', function () use ($container) {
            return new AccountController(
                $container->resolve('\services\user\IUserService'),
                $container->resolve('\services\request\IRequestService')
            );
        });

        $container->register('\DAO\relation\IRelationDAO' , function () {
            return new RelationDAO();
        });

        $container->register('\services\relation\IRelationService', function () use ($container) {
            return new RelationService(
                $container->resolve('\DAO\relation\IRelationDAO')
            );
        });

        $container->register('\controllers\RelationController', function () use ($container) {
            return new RelationController(
                $container->resolve('\services\relation\IRelationService'),
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
