<?php
namespace controller;


use Loaders\CustomerLoader;
use DbConnect;
use Models\DiscountCalculator;
use PDO;

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

        if (isset($_POST['customerId'])) {
            $customer = CustomerLoader::fetchCustomer($_POST['customerId'], $this->pdo);
            $product = \ProductLoader::getProduct($_POST['productId'], $this->pdo);

            $groupDiscount = DiscountCalculator::calculateGroupDiscount($product->getPrice
            (), $customer->getGroupDiscounts());

            $newPrice = DiscountCalculator::calculateCustomerDiscount
            ($product->getPrice(), $groupDiscount, $customer->getCustomerDiscount());

        }

        require ("view/priceCalcView.php");
    }

}