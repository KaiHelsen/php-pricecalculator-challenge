<?php
declare(strict_types=1);
namespace Models;
use PDO;
require_once('./Config/config.php');
class DbConnect
{

//    private const HOST = "localhost";
//    private string $user = "becode";
//    private string $pwd = "becode123";
//    private string $dbName = "pricecalculator";

    public function connect() : PDO
    {
        require_once("./Config/config.php");
        $dsn = 'mysql:host=' . constant('HOST') . ';dbname=' . constant('DATABASE');
        $pdo = new PDO($dsn, constant('USERNAME'), constant('PASSWORD'));
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}