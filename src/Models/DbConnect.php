<?php


class DbConnect
{
    private const HOST = "localhost";
    private string $user = "becode";
    private string $pwd = "becode123";
    private string $dbName = "pricecalculator";

    public function connect() : PDO
    {
        $dsn = 'mysql:host=' . self::HOST . ';dbname=' . $this->dbName;
        $pdo = new PDO($dsn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}