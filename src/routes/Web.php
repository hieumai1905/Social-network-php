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

    Route::get('/api/users/{id}','UserController@getUser');

    Route::get('/users/{$content}/findusers','UserController@findUserByContent');

    Route::get('/editinformation','UserController@getUserToEditProfile');

    Route::put('/api/updateuser','UserController@updateUser');


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
    Route::get('/relation/{user_id}/friendlist','RelationController@getFriendOfUser');
    Route::post('/api/relation/sendfriendrequest/{user_target_id}','RelationController@sendfriendrequest');
    Route::delete('/api/relation/unfriend/{user_target_id}','RelationController@unFriend');
    Route::put('/api/relation/acceptfriendrequest/{user_target_id}','RelationController@acceptFriendRequest');
    Route::delete('/api/relation/rejectfriendrequest/{user_target_id}','RelationController@rejectFriendRequest');
    Route::post('/api/relation/block/{user_target_id}','RelationController@blockUser');
    Route::delete('/api/relation/unblock/{user_target_id}','RelationController@unBlockUser');
    Route::post('/api/relation/follow/{user_target_id}','RelationController@followUser');
    Route::delete('/api/relation/unfollow/{user_target_id}','RelationController@unFollowUser');
    Route::get('/api/relation/friendrequest','RelationController@getFriendRequestOfUser');
    Route::get('/api/relation/friendlist','RelationController@getAllFriendOfUser');
    Route::get('/api/relation/followlist','RelationController@getFollowOfUser');
    Route::get('/api/relation/blocklist','RelationController@getBlockOfUser');
    Route::get('/api/relation/requestlist','RelationController@getRequestOfUser');
    Route::delete('/api/relation/cancelfriendrequest/{user_target_id}','RelationController@cancelFriendRequest');
    Route::get('/relation/block','RelationController@getBlockUser');

    Route::registerResource();
    Route::dispatch();
}