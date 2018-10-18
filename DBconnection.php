<?php
/**
 * Created by PhpStorm.
 * User: Timo
 * Date: 18-10-2018
 * Time: 17:43
 */

class DBconnection
{
    private static $db;
    private $connection;

    private function __construct()
    {
        $this->connection = new MySQLi("localhost", "root", "", "hanzepay");
    }

    function __destruct()
    {
        $this->connection->close();
    }

    public static function getConnection()
    {
        if (self::$db == null) {
            self::$db =  new DBconnection();
        }
        return self::$db->connection;
    }
}