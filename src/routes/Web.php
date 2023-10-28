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
    Route::get('/admin/home', function () {
        return Response::view('views/admin/Home');
    });
    Route::get('/admin', function () {
        return Response::view('views/admin/Home');
    });
    Route::get('/admin/user', function () {
        return Response::view('views/admin/User');
    });
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
    Route::post('/account/forgot', 'AccountController@forgotPassword');
    Route::post('/account/forgot/confirm', 'AccountController@confirmForgotPassword');
    Route::post('/account/reset-password', 'AccountController@updatePassword');

    Route::post('/refresh-code', 'AccountController@refreshCode');

    Route::get('/register/confirm', 'AccountController@showFormConfirmRegister');
    Route::post('/register/confirm', 'AccountController@confirmRegisterAccount');
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
    Route::registerResource();
    Route::dispatch();
}