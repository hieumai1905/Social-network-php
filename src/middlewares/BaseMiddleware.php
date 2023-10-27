<?php

namespace middlewares;
require_once 'Middleware.php';

class BaseMiddleware implements Middleware
{

    function handle()
    {
        echo 'all middleware';
    }
}