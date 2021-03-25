<?php
declare(strict_types=1);

abstract class loader
{
    abstract function fetchAll() :? array;
    abstract function fetchById(int $id) :? array;

    static function foo() : string
    {
        return "foo";
    }

    protected static function dbConnect() :? array
    {
        include ('config/config.php');
        $driverOptions = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        parent::__construct('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME, self::DB_USERNAME, self::DB_PASSWORD, $driverOptions);
    }
}