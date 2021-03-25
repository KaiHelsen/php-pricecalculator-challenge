<?php
namespace controller;


use CustomerLoader\CustomerLoader;
use DbConnect;

class priceCalcController extends controller
{

    private PDO $pdo;

    public function __construct()
    {
        $connection = new DbConnect();
        $this->pdo = $connection->connect();
    }


    /**
     * @inheritDoc
     */
    function render(array $GET, array $POST): void
    {
        // TODO: Implement render() method.

        $allCustomers = CustomerLoader::fetchAllCustomers($this->pdo);
        $allProducts = \ProductLoader::getAllProducts($this->pdo);

        require ("view/priceCalcView.php");
    }

}