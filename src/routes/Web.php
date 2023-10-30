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
    Route::get('/admin/user', function () {
        return Response::view('views/admin/Users');
    });

    Route::get('/admin/users-all', 'AdminController@getUsers');

    Route::put('/admin/lock-user', 'AdminController@lockUser');
    //---------------------------------------------------------------------------------

    //---------------------------------------User--------------------------------------
    Route::get('/users', 'UserController@getAllUser');

    Route::get('/users/{id}', 'UserController@getUserById');


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


    Route::registerResource();
    Route::dispatch();
}