<?php
declare(strict_types=1);
namespace Models;
use PDO;
require_once('./Config/config.php');
class DbConnect
{
    public function connect() : PDO
    {
        require_once("./Config/config.php");
        $dsn = 'mysql:host=' . constant('HOST') . ';dbname=' . constant('DATABASE');
        $pdo = new PDO($dsn, constant('USERNAME'), constant('PASSWORD'));
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}