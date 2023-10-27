<?php

namespace middlewares;

class UserMiddleware implements Middleware
{

    public function handle()
    {
        echo 'user middleware';
        echo '<br/>';
    }
}