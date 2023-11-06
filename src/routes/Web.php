<?php

namespace routes;

use https\Response;
use middlewares\AuthMiddleware;
use middlewares\TestMiddleware;
use middlewares\ValidationMiddleware;
use middlewares\MiddlewareRegister;
use middlewares\UserMiddleware;

require_once 'Route.php';
require_once 'src/https/Response.php';
require_once 'src/middlewares/AuthMiddleware.php';
require_once 'src/middlewares/ValidationMiddleware.php';
require_once 'src/middlewares/UserMiddleware.php';
require_once 'src/middlewares/TestMiddleware.php';

function registerMiddleware()
{

}

function registerRoute()
{
    //--------------------------------------Home-------------------------------------
    Route::get('/', function () {
        return Response::view('views/index');
    });
    Route::get('/home', function () {
        return Response::view('views/index');
    });
    //--------------------------------------------------------------------------------

    //--------------------------------------Admin-------------------------------------
    Route::get('/admin/dash-board', function () {
        return Response::view('views/admin/Home');
    });
    Route::get('/admin', function () {
        return Response::view('views/admin/Home');
    });
    Route::get('/admin/users', function () {
        return Response::view('views/admin/User');
    });

    Route::get('/api/admin/users-all', 'AdminController@getUsers');

    Route::get('/api/admin/users-all/month', 'AdminController@getNewUserInMonth');

    Route::put('/api/admin/lock-user', 'AdminController@lockUser');
    //---------------------------------------------------------------------------------

    //---------------------------------------User--------------------------------------
    Route::get('/users', 'UserController@getAllUser');

    Route::get('/users/{id}', 'UserController@getUserById');

    Route::get('/api/users/{id}', 'UserController@getUser');

    Route::get('/users/{$content}/findusers', 'UserController@findUserByContent');

    Route::get('/editinformation', 'UserController@getUserToEditProfile');

    Route::put('/api/updateuser', 'UserController@updateUser');
    Route::get('/change-email', 'UserController@showFormChangeEmail');
    Route::post('/change-email', 'UserController@changeEmail');
    Route::post('/api/change-email/code', 'UserController@getCodeChangeEmail');

    Route::get('/change-password', 'UserController@showFormChangePassword');
    Route::post('/change-password', 'UserController@changePassword');


    Route::get('/settings', 'UserController@showFormSetting');
    //-------------------------------------------------------------------------------------

    //---------------------------Register route for account--------------------------------
    Route::get('/login', 'AccountController@showFormLogin');
    Route::post('/login', 'AccountController@loginAccount');

    Route::get('/register', 'AccountController@showFormRegister');
    Route::post('/register', 'AccountController@registerAccount');

    Route::get('/logout', 'AccountController@logoutAccount');

    Route::get('/account/forgot', 'AccountController@showFormForgot');
    Route::post('/api/account/forgot', 'AccountController@getCodeForgot');
    Route::post('/account/forgot/confirm', 'AccountController@confirmForgotPassword');
    Route::post('/account/reset-password', 'AccountController@updatePassword');

    Route::post('/api/refresh-code', 'AccountController@refreshCode');

    Route::get('/register/confirm', 'AccountController@showFormConfirmRegister');
    Route::post('/register/confirm', 'AccountController@confirmRegisterAccount');

    Route::get('/error', function () {
        return Response::view('views/Error');
    });

    Route::get('/update-password', function () {
        return Response::view('views/Update-password');
    });
    //-------------------------------------------------------------------------------------

    //---------------------------Register route for relation-------------------------------
    Route::get('/relation/{user_id}/friendlist', 'RelationController@getFriendOfUser');
    Route::post('/api/relation/sendfriendrequest/{user_target_id}', 'RelationController@sendfriendrequest');
    Route::delete('/api/relation/unfriend/{user_target_id}', 'RelationController@unFriend');
    Route::put('/api/relation/acceptfriendrequest/{user_target_id}', 'RelationController@acceptFriendRequest');
    Route::delete('/api/relation/rejectfriendrequest/{user_target_id}', 'RelationController@rejectFriendRequest');
    Route::post('/api/relation/block/{user_target_id}', 'RelationController@blockUser');
    Route::delete('/api/relation/unblock/{user_target_id}', 'RelationController@unBlockUser');
    Route::post('/api/relation/follow/{user_target_id}', 'RelationController@followUser');
    Route::delete('/api/relation/unfollow/{user_target_id}', 'RelationController@unFollowUser');
    Route::get('/api/relation/friendrequest', 'RelationController@getFriendRequestOfUser');
    Route::get('/api/relation/friendlist', 'RelationController@getAllFriendOfUser');
    Route::get('/api/relation/followlist', 'RelationController@getFollowOfUser');
    Route::get('/api/relation/blocklist', 'RelationController@getBlockOfUser');
    Route::get('/api/relation/requestlist', 'RelationController@getRequestOfUser');
    Route::delete('/api/relation/cancelfriendrequest/{user_target_id}', 'RelationController@cancelFriendRequest');
    Route::get('/relation/block', 'RelationController@getBlockUser');
    //------------------------------------------------------------------------------------
    //---------------------------Register route for post-------------------------------------
    Route::get('/api/post/home', 'PostController@getPostForHome');
    Route::get('/api/post/profile/{user_id}', 'PostController@getPostForProfile');
    Route::get('/api/post/{post_id}', 'PostController@getPostById');
    Route::get('/api/admin/post', 'PostController@getAllPost');
    Route::get('/api/admin/post/month', 'PostController@getMonthPost');
    Route::post('/api/post', 'PostController@createPost');
    Route::put('/api/post', 'PostController@updatePost');
    Route::delete('/api/post/{post_id}', 'PostController@deletePost');
    //------------------------------------------------------------------------------------------------
    //-----------------------------Register route for comment------------------------------------------------
    Route::get('/api/comment/{post_id}', 'CommentController@getCommentByPostId');
    Route::post('/api/comment', 'CommentController@createComment');
    Route::put('/api/comment', 'CommentController@updateComment');
    Route::delete('/api/comment/{comment_id}', 'CommentController@deleteComment');
    //------------------------------------------------------------------------------------------------
    //-----------------------------Register route for comment reply------------------------------------------------
    Route::get('/api/comment/reply/{comment_id}', 'CommentReplyController@getCommentReply');
    Route::post('/api/comment/reply', 'CommentReplyController@createCommentReply');
    Route::put('/api/comment/reply', 'CommentReplyController@updateCommentReply');
    Route::delete('/api/comment/reply/{comment_id}', 'CommentReplyController@deleteCommentReply');
    //------------------------------------------------------------------------------------------------
    //-----------------------------Register route for post interact------------------------------------------------
    Route::get('/api/favorite', 'PostInteractController@getFavoritePost');
    Route::get('/api/favorite/{postId}', 'PostInteractController@getFavoritePostById');
    Route::post('/api/favorite/{postId}', 'PostInteractController@addFavorite');
    Route::post('/api/hidden/{postId}', 'PostInteractController@addHidden');
    Route::post('/api/report', 'PostInteractController@addReport');
    Route::delete('/api/favorite/{postId}', 'PostInteractController@deleteFavorite');
    Route::get('/favorite', function () {
        return Response::view('views/Favorite');
    });
    //------------------------------------------------------------------------------------------------
    //------------------------------Register route for like-------------------------------------------
    Route::get('/api/like/post/{postId}', 'LikeController@getLikeOfPostByUser');
    Route::get('/api/like/comment/{commentId}', 'LikeController@getLikeOfCommentByUser');
    Route::get('/api/like/comment/reply/{commentReplyId}', 'LikeController@getLikeOfCommentReplyByUser');
    Route::get('/api/like/count/post/{postId}', 'LikeController@getCountLikePost');
    Route::get('/api/like/count/comment/{commentId}', 'LikeController@getCountLikeComment');
    Route::get('/api/like/count/comment/reply/{commentReplyId}', 'LikeController@getCountLikeCommentReply');
    Route::post('/api/like/post/{postId}', 'LikeController@likePost');
    Route::post('/api/like/comment/{commentId}', 'LikeController@likeComment');
    Route::post('/api/like/comment/reply/{commentReplyId}', 'LikeController@likeCommentReply');
    Route::delete('/api/like/post/{postId}', 'LikeController@unlikePost');
    Route::delete('/api/like/comment/{commentId}', 'LikeController@unlikeComment');
    Route::delete('/api/like/comment/reply/{commentReplyId}', 'LikeController@unlikeCommentReply');
    Route::delete('/api/like/all/post/{postId}', 'LikeController@deleteAllLikePost');
    Route::delete('/api/like/all/comment/{commentId}', 'LikeController@deleteAllLikeComment');
    Route::delete('/api/like/all/comment/reply/{commentReplyId}', 'LikeController@deleteAllLikeCommentReply');
    //------------------------------------------------------------------------------------------------
    //------------------------------Register route for media-------------------------------------------
    Route::get('/api/media/post/{postId}', 'MediaController@getMediaOfPost');
    Route::get('/api/media/user/{userId}', 'MediaController@getMediaOfUser');
    Route::post('/api/media/post', 'MediaController@addMediaForPost');
    Route::delete('/api/media/post/{postId}', 'MediaController@deleteMediaOfPost');
    //------------------------------------------------------------------------------------------------
    //------------------------------Register route for notification-------------------------------------------
    Route::get('/notification','NotificationController@getNotificationOfUser');
    Route::get('/api/notification/countnotificationunseen','NotificationController@countNotificationUnSeen');
    //------------------------------------------------------------------------------------------------
    Route::registerResource();
    Route::dispatch();
}