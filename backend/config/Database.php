<?php

class Database
{
    protected static $db;

    public function __construct()
    {
        $driver = "mysql";
        $host = "localhost";
        $dbname = "starwars";
        $username = "root";
        $password = "";

        try {
           self::$db = new PDO("$driver:host=$host;dbname=$dbname", $username, $password);
    
           self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
           self::$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (PDOException $e) {
            error_log($e->getMessage());
        }
    }

    public static function getConection()
    {
        if (!self::$db) {
            new Database();
        }

        return self::$db;
    }
}

?>
