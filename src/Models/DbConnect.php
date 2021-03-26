<?php


class DbConnect
{
    public function connect() : PDO
    {
        $dsn = 'mysql:host=' . HOST . ';dbname=' . DBNAME;
        $pdo = new PDO($dsn, USER, PWD);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}