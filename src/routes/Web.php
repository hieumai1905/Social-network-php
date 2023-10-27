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
    Route::get('/', function(){
        Return Response::view('views/index');
    });
    Route::get('/home', function(){
        Return Response::view('views/index');
    });
    //--------------------------------------------------------------------------------

    //--------------------------------------Admin-------------------------------------
    Route::get('/admin/home', function(){
        Return Response::view('views/admin/Home');
    });
    Route::get('/admin/user', function(){
        Return Response::view('views/admin/User');
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

    Route::get('/account/forgot', 'AccountController@showFormForgot');
    Route::post('/account/forgot', 'AccountController@forgotPassword');

    Route::get('/confirm', function(){
        Return Response::view('views/Confirm-Code');
    });
    Route::get('/admin/home', function(){
        Return Response::view('views/admin/Home');
    });
    Route::get('/admin/user', function(){
        Return Response::view('views/admin/User');
    });
    //-------------------------------------------------------------------------------------

    Route::registerResource();
    Route::dispatch();
}