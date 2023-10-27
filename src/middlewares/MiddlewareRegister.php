<?php

namespace middlewares;

class MiddlewareRegister
{

    private static $middlewares = [];

    public static function register($route, $middleware)
    {
        if (!isset(self::$middlewares[$route])) {
            self::$middlewares[$route] = [];
        }

        self::$middlewares[$route][] = $middleware;
    }

    public static function run($route)
    {
        if (isset(self::$middlewares[$route])) {
            foreach (self::$middlewares[$route] as $middlewares) {
                foreach ($middlewares as $middleware) {
                    self::execute($middleware);
                }
            }
        }
    }

    public static function execute($middleware)
    {
        $middleware->handle();
    }

    public static function hasMiddleware($route)
    {
        if (isset(self::$middlewares[$route]) && !empty(self::$middlewares[$route])) {
            return true;
        }

        return false;
    }

    public static function hasMiddlewareOfRoute($route, $middleware)
    {
        if (isset(self::$middlewares[$route])) {
            foreach (self::$middlewares[$route] as $registeredMiddleware) {
                if ($registeredMiddleware === $middleware) {
                    return true;
                }
            }
        }

        return false;
    }
}