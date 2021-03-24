<?php


class DbConnect extends PDO
{
    const DB_HOST = 'localhost';
    const DB_USERNAME = 'becode';
    const DB_PASSWORD = 'becode123';
    const DB_NAME = 'pricecalculator';

    function __construct()
    {
        $driverOptions = [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        parent::__construct('mysql:host=' . self::DB_HOST . ';dbname=' . self::DB_NAME, self::DB_USERNAME, self::DB_PASSWORD, $driverOptions);
    }
}