<?php

namespace services\handle;

class Encryption
{
    public static function encrypt($data): bool|string
    {
        $key = "12345678901234567890123456789012";
        $iv = "1234567890123456";
        $cipher = "aes-256-cbc";
        return openssl_encrypt($data, $cipher, $key, 0, $iv);
    }

    public static function decrypt($data): bool|string
    {
        $key = "12345678901234567890123456789012";
        $iv = "1234567890123456";
        $cipher = "aes-256-cbc";
        return openssl_decrypt($data, $cipher, $key, 0, $iv);
    }
}