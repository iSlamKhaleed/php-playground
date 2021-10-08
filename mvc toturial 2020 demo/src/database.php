<?php
final class Database
{
    private static ?PDO $database = null;

    private function __construct()
    {
    }
    private function __clone()
    {
    }
    public function __wakeup()
    {
    }

    public static function getConnection()
    {
        if (!self::$database)
            self::$database = new PDO('mysql:host=localhost;dbname=darwin_cms', 'root', 'root');
        return self::$database;
    }
}
