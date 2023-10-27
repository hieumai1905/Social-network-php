<?php

namespace middlewares;
require_once 'Middleware.php';

class TestMiddleware implements Middleware
{

    function handle()
    {
        echo 'Test middleware';
    }
}