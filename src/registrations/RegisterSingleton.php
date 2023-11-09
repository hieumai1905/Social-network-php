<?php

namespace registrations;


use controllers\AdminController;
use controllers\MessageController;
use controllers\NotificationController;
use DAO\conversations\ConversationsDAO;
use DAO\message\MessageDAO;
use DAO\notification\NotificationDAO;
use https\Request;

use DAO\user\UserDAO;
use DAO\post\PostDAO;
use DAO\comment_reply\CommentReplyDAO;
use DAO\comment\CommentDAO;
use DAO\like\LikeDAO;
use DAO\post_interact\PostInteractDAO;
use DAO\media\MediaDAO;
use DAO\relation\RelationDAO;
use DAO\request\RequestDAO;

use controllers\AccountController;
use controllers\RelationController;
use controllers\UserController;
use controllers\PostController;
use controllers\CommentController;
use controllers\CommentReplyController;
use controllers\PostInteractController;
use controllers\LikeController;
use controllers\MediaController;

use services\conversations\ConversationService;
use services\message\MessageService;
use services\notification\NotificationService;
use services\relation\RelationService;
use services\request\RequestService;
use services\user\UserService;
use services\post\PostService;
use services\comment\CommentService;
use services\comment_reply\CommentReplyService;
use services\like\LikeService;
use services\post_interact\PostInteractService;
use services\media\MediaService;

require_once __DIR__ . '/DIContainer.php';
require_once __DIR__ . '/../https/Request.php';

require_once __DIR__ . '/../DAO/request/RequestDAO.php';
require_once __DIR__ . '/../DAO/user/UserDAO.php';
require_once __DIR__ . '/../DAO/post/PostDAO.php';
require_once __DIR__ . '/../DAO/comment/CommentDAO.php';
require_once __DIR__ . '/../DAO/comment_reply/CommentReplyDAO.php';
require_once __DIR__ . '/../DAO/like/LikeDAO.php';
require_once __DIR__ . '/../DAO/post_interact/PostInteractDAO.php';
require_once __DIR__ . '/../DAO/media/MediaDAO.php';
require_once __DIR__ . '/../DAO/relation/RelationDAO.php';
require_once __DIR__ . '/../DAO/notification/NotificationDAO.php';
require_once __DIR__ . '/../DAO/message/MessageDAO.php';
require_once __DIR__ . '/../DAO/conversations/ConversationsDAO.php';

require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/AccountController.php';
require_once __DIR__ . '/../controllers/AdminController.php';
require_once __DIR__ . '/../controllers/RelationController.php';
require_once __DIR__ . '/../controllers/MessageController.php';
require_once __DIR__ . '/../controllers/PostController.php';
require_once __DIR__ . '/../controllers/CommentController.php';
require_once __DIR__ . '/../controllers/CommentReplyController.php';
require_once __DIR__ . '/../controllers/PostInteractController.php';
require_once __DIR__ . '/../controllers/LikeController.php';
require_once __DIR__ . '/../controllers/MediaController.php';
require_once __DIR__ . '/../controllers/NotificationController.php';

require_once __DIR__ . '/../services/relation/RelationService.php';
require_once __DIR__ . '/../services/request/RequestService.php';
require_once __DIR__ . '/../services/user/UserService.php';
require_once __DIR__ . '/../services/conversations/ConversationService.php';
require_once __DIR__ . '/../services/message/MessageService.php';
require_once __DIR__ . '/../services/post/PostService.php';
require_once __DIR__ . '/../services/comment/CommentService.php';
require_once __DIR__ . '/../services/comment_reply/CommentReplyService.php';
require_once __DIR__ . '/../services/like/LikeService.php';
require_once __DIR__ . '/../services/post_interact/PostInteractService.php';
require_once __DIR__ . '/../services/media/MediaService.php';
require_once __DIR__ . '/../services/notification/NotificationService.php';

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

    public function register(): void
    {
        $container = $this->getContainer();
        //---------------------------------------User Account--------------------------------------
        $container->register('\DAO\user\IUserDAO', function () {
            return new UserDAO();
        });

        $container->register('\DAO\request\IRequestDAO', function () {
            return new RequestDAO();
        });

        $container->register('\services\user\IUserService', function () use ($container) {
            return new UserService(
                $container->resolve('\DAO\user\IUserDAO')
            );
        });

        $container->register('\services\request\IRequestService', function () use ($container) {
            return new RequestService(
                $container->resolve('\DAO\request\IRequestDAO')
            );
        });

        $container->register('\controllers\UserController', function () use ($container) {
            return new UserController(
                $container->resolve('\services\user\IUserService'),
                $container->resolve('\services\request\IRequestService'),
                $container->resolve('\services\relation\IRelationService'),
                $container->resolve('\services\media\IMediaService')
            );
        });

        $container->register('\controllers\AccountController', function () use ($container) {
            return new AccountController(
                $container->resolve('\services\user\IUserService'),
                $container->resolve('\services\request\IRequestService')
            );
        });
        //---------------------------------------Relation--------------------------------------
        $container->register('\DAO\relation\IRelationDAO', function () {
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
                $container->resolve('\services\user\IUserService'),
                $container->resolve('\services\notification\INotificationService')
            );
        });
        //-------------------------------------------------------------------------------------


        //===========================Post=================================================
        $container->register('\DAO\post\IPostDAO', function () {
            return new PostDAO();
        });

        $container->register('\services\post\IPostService', function () use ($container) {
            return new PostService(
                $container->resolve('\DAO\post\IPostDAO')
            );
        });

        $container->register('\controllers\PostController', function () use ($container) {
            return new PostController(
                $container->resolve('\services\post\IPostService')
            );
        });
        //================================================================================
        //=================================Comment========================================
        $container->register('\DAO\comment\ICommentDAO', function () {
            return new CommentDAO();
        });

        $container->register('\services\comment\ICommentService', function () use ($container) {
            return new CommentService(
                $container->resolve('\DAO\comment\ICommentDAO')
            );
        });
        $container->register('\controllers\CommentController', function () use ($container) {
            return new CommentController(
                $container->resolve('\services\comment\ICommentService')
            );
        });
        //================================================================================
        //=================================CommentReply===================================
        $container->register('\DAO\comment_reply\ICommentReplyDAO', function () {
            return new CommentReplyDAO();
        });

        $container->register('\services\comment_reply\ICommentReplyService', function () use ($container) {
            return new CommentReplyService(
                $container->resolve('\DAO\comment_reply\ICommentReplyDAO')
            );
        });
        $container->register('\controllers\CommentReplyController', function () use ($container) {
            return new CommentReplyController(
                $container->resolve('\services\comment_reply\ICommentReplyService')
            );
        });
        //================================================================================
        //=================================Like===========================================
        $container->register('\DAO\like\ILikeDAO', function () {
            return new LikeDAO();
        });

        $container->register('\services\like\ILikeService', function () use ($container) {
            return new LikeService(
                $container->resolve('\DAO\like\ILikeDAO')
            );
        });
        $container->register('\controllers\LikeController', function () use ($container) {
            return new LikeController(
                $container->resolve('\services\like\ILikeService')
            );
        });
        //================================================================================
        //=================================PostInteract===================================
        $container->register('\DAO\post_interact\IPostInteractDAO', function () {
            return new PostInteractDAO();
        });

        $container->register('\services\post_interact\IPostInteractService', function () use ($container) {
            return new PostInteractService(
                $container->resolve('\DAO\post_interact\IPostInteractDAO')
            );
        });
        $container->register('\controllers\PostInteractController', function () use ($container) {
            return new PostInteractController(
                $container->resolve('\services\post_interact\IPostInteractService')
            );
        });
        //================================================================================
        //=================================Media==========================================
        $container->register('\DAO\media\IMediaDAO', function () {
            return new MediaDAO();
        });

        $container->register('\services\media\IMediaService', function () use ($container) {
            return new MediaService(
                $container->resolve('\DAO\media\IMediaDAO')
            );
        });
        $container->register('\controllers\MediaController', function () use ($container) {
            return new MediaController(
                $container->resolve('\services\media\IMediaService')
            );
        });
        //================================================================================


        //------------------------------------------ADMIN-----------------------------------------

        $container->register('\controllers\AdminController', function () use ($container) {
            return new AdminController(
                $container->resolve('\services\user\IUserService')
            );
        });

        //----------------------------------------------------------------------------------------

        //---------------------------------------Notification--------------------------------------
        $container->register('\DAO\notification\INotificationDAO', function () {
            return new NotificationDAO();
        });

        $container->register('\services\notification\INotificationService', function () use ($container) {
            return new NotificationService(
                $container->resolve('\DAO\notification\INotificationDAO')
            );
        });

        $container->register('\controllers\NotificationController', function () use ($container) {
            return new NotificationController(
                $container->resolve('\services\notification\INotificationService'),
                $container->resolve('\services\user\IUserService')
            );
        });
        //-------------------------------------------------------------------------------------
  //------------------------------------Message-------------------------------------------------
        $container->register('\services\message\IMessageService', function () use ($container) {
            return new MessageService(
                $container->resolve('\DAO\message\IMessageDAO'),
            );
        });

        $container->register('\DAO\conversation\IConversationDAO', function () {
            return new ConversationsDAO();
        });
        $container->register('\DAO\message\IMessageDAO', function () {
            return new MessageDAO();
        });

        $container->register('\services\conversation\IConversationService', function () use ($container) {
            return new ConversationService(
                $container->resolve('\DAO\conversation\IConversationDAO')
            );
        });

        $container->register('\controllers\MessageController', function () use ($container) {
            return new MessageController(
                $container->resolve('\services\relation\IRelationService'),
                $container->resolve('\services\user\IUserService'),
                $container->resolve('\services\message\IMessageService'),
                $container->resolve('\services\conversation\IConversationService')
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
