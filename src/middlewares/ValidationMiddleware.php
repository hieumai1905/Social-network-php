<?php

namespace middlewares;
require_once 'Middleware.php';
class ValidationMiddleware implements Middleware
{

    function handle()
    {
        echo "Validation middleware";
        echo '<br>';
    }
}