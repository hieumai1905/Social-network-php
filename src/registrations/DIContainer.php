<?php

namespace registrations;

use Exception;

class DIContainer
{
    private static $instance = null;
    private $instances = [];

    private function __construct()
    {
    }

    public static function getInstance(): DIContainer
    {
        if (self::$instance === null) {
            self::$instance = new DIContainer();
        }
        return self::$instance;
    }

    public function register($interface, $implementation)
    {
        $this->instances[$interface] = $implementation;
    }

    public function resolve($interface)
    {
        if (isset($this->instances[$interface])) {
            // Kiểm tra xem đối tượng đã tồn tại trong DI Container chưa.
            if (is_callable($this->instances[$interface])) {
                $this->instances[$interface] = $this->instances[$interface]();
            }

            return $this->instances[$interface];
        }
        throw new Exception("No implementation registered for interface: $interface");
    }

    public function has(string $key): bool
    {
        return isset($this->bindings[$key]);
    }
}