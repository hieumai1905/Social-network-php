<?php

namespace middlewares;

interface Middleware
{
    function handle(...$args);
}