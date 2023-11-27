<?php

namespace DAO\Databases;

use PDO;
use PDOException;

require_once "DatabaseConfig.php";

class ConnectDatabase
{
    private static $connection = null;

    public static function getConnection()
    {
        if (!self::$connection) {
            try {
                self::$connection = new PDO("oci:dbname=".$GLOBALS['tns'].";charset=utf8", $GLOBALS['db_username'], $GLOBALS['db_password']);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                exit();
            }
        }
        return self::$connection;
    }

    public static function closeConnection()
    {
        if (self::$connection) {
            self::$connection = null;
        }
    }
}