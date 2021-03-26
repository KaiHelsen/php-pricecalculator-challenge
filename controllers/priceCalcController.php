<?php
declare(strict_types=1);

namespace controller;

use Loaders\CustomerLoader;
use Loaders\ProductLoader;
use Models\DbConnect;
use Models\DiscountCalculator;
use Models\Product;
use PDO;

class priceCalcController extends controller
{
    protected const CUSTOMER = 'customerId';
    protected const PRODUCT = 'productId';

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
        $allProducts = ProductLoader::fetchAllProducts($this->pdo);

        if (isset($GET['customerId']))
        {
            $customer = CustomerLoader::fetchCustomer((int)$GET['customerId'], $this->pdo);
            $product = ProductLoader::fetchProduct((int)$GET['productId'], $this->pdo);

            $groupDiscount = DiscountCalculator::calculateGroupDiscount((int)$product->getPrice(), $customer->getGroupDiscounts());

            $newPrice = DiscountCalculator::calculateCustomerDiscount
            ($product->getPrice(), $groupDiscount, $customer->getCustomerDiscount());
        }

        require("view/priceCalcView.php");
    }

}