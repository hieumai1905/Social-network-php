<?php

namespace middlewares;
require_once 'Middleware.php';

class AuthMiddleware implements Middleware
{
    public function handle()
    {
        echo 'Auth middleware';
        echo '<br/>';
    }
}