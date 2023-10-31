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

    Route::put('/api/admin/lock-user', 'AdminController@lockUser');
    //---------------------------------------------------------------------------------

    //---------------------------------------User--------------------------------------
    Route::get('/users', 'UserController@getAllUser');

    Route::get('/users/{id}', 'UserController@getUserById');

    Route::get('/change-email', 'UserController@showFormChangeEmail');
    Route::post('/change-email', 'UserController@changeEmail');
    Route::post('/change-email/code', 'UserController@getCodeChangeEmail');

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

    Route::get('/test', function()
    {
        return Response::view('views/Update-password');
    });
    //-------------------------------------------------------------------------------------

    //---------------------------Register route for relation--------------------------------
    Route::get('/relation/{user_id}','RelationController@getFriendForUser');
    Route::post('/relation/{user_id}/sendfriendrequest/{user_target_id}','RelationController@sendfriendrequest');
    Route::delete('/relation/{user_id}/unfriend/{user_target_id}','RelationController@unFriend');
    Route::put('/relation/{user_id}/acceptfriendrequest/{user_target_id}','RelationController@acceptFriendRequest');
    Route::delete('/relation/{user_id}/rejectfriendrequest/{user_target_id}','RelationController@rejectFriendRequest');
    Route::post('/relation/{user_id}/block/{user_target_id}','RelationController@blockUser');
    Route::delete('/relation/{user_id}/unblock/{user_target_id}','RelationController@unBlockUser');
    Route::post('/relation/{user_id}/follow/{user_target_id}','RelationController@followUser');
    Route::delete('/relation/{user_id}/unfollow/{user_target_id}','RelationController@unFollowUser');
    //------------------------------------------------------------------------------------
    //---------------------------Register route for post-------------------------------------
    Route::get('/api/post/home/{user_id}', 'PostController@getPostForHome' );
    Route::get('/api/post/profile/{user_id}', 'PostController@getPostForProfile' );
    Route::get('/api/post/{post_id}', 'PostController@getPostById');
    Route::post('/api/post', 'PostController@createPost');
    Route::put('/api/post','PostController@updatePost');
    Route::delete('/api/post/{post_id}', 'PostController@deletePost');
    //------------------------------------------------------------------------------------------------
    //-----------------------------Register route for comment------------------------------------------------
    Route::get('/api/comment/{post_id}', 'CommentController@getCommentByPostId');
    Route::post('/api/comment','CommentController@createComment');
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
    Route::get('/api/favorite/{userId}', 'PostInteractController@getFavoritePost');
    Route::post('/api/favorite/{postId}/{userId}', 'PostInteractController@addFavorite');
    Route::post('/api/hidden/{postId}/{userId}', 'PostInteractController@addHidden');
    Route::post('/api/report', 'PostInteractController@addReport');
    Route::delete('/api/favorite/{postId}/{userId}', 'PostInteractController@deleteFavorite');
    //------------------------------------------------------------------------------------------------
    //------------------------------Register route for like-------------------------------------------
    Route::get('/api/like/post/{postId}/{userId}', 'LikeController@getLikeOfPostByUser');
    Route::get('/api/like/comment/{commentId}/{userId}', 'LikeController@getLikeOfCommentByUser');
    Route::get('/api/like/comment/reply/{commentReplyId}/{userId}', 'LikeController@getLikeOfCommentReplyByUser');
    Route::get('/api/like/count/post/{postId}', 'LikeController@getCountLikePost');
    Route::get('/api/like/count/comment/{commentId}', 'LikeController@getCountLikeComment');
    Route::get('/api/like/count/comment/reply/{commentReplyId}', 'LikeController@getCountLikeCommentReply');
    Route::post('/api/like/post/{postId}/{userId}', 'LikeController@likePost');
    Route::post('/api/like/comment/{commentId}/{userId}', 'LikeController@likeComment');
    Route::post('/api/like/comment/reply/{commentReplyId}/{userId}', 'LikeController@likeCommentReply');
    Route::delete('/api/like/post/{postId}/{userId}', 'LikeController@unlikePost');
    Route::delete('/api/like/comment/{commentId}/{userId}', 'LikeController@unlikeComment');
    Route::delete('/api/like/comment/reply/{commentReplyId}/{userId}', 'LikeController@unlikeCommentReply');
    //------------------------------------------------------------------------------------------------
    //------------------------------Register route for media-------------------------------------------
    Route::get('/api/media/post/{postId}', 'MediaController@getMediaOfPost');
    Route::get('/api/media/user/{userId}', 'MediaController@getMediaOfUser');
    Route::post('/api/media/post', 'MediaController@addMediaForPost');
    Route::delete('/api/media/post/{postId}', 'MediaController@deleteMediaOfPost');
    //------------------------------------------------------------------------------------------------

    Route::registerResource();
    Route::dispatch();
}