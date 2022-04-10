<?php
include_once(__DIR__ .'/../bootstrap.php');

abstract class DB
{
    private static $conn;

    public static function getConnection()
    {
        if (self::$conn) {
            //connection found
            return self::$conn;
        } else {
            //no connection found
            $config = parse_ini_file(__DIR__ . '/../config/config.ini');
            self::$conn = new PDO("mysql:host=" . $config['server'] . ";dbname=" . $config['database'], $config['username'], $config['password']);
            self::$conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return self::$conn;
        }
    }
}
