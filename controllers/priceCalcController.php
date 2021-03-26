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
    protected const CUSTOMER_TAG = 'customerId';
    protected const PRODUCT_TAG = 'productId';

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

        if (isset($GET[self::CUSTOMER_TAG], $GET[self::PRODUCT_TAG]))
        {
            $customer = CustomerLoader::fetchCustomer((int)$GET[self::CUSTOMER_TAG], $this->pdo);
            $product = ProductLoader::fetchProduct((int)$GET[self::PRODUCT_TAG], $this->pdo);

            $groupDiscount = DiscountCalculator::calculateGroupDiscount((int)$product->getPrice(), $customer->getGroupDiscounts());

            $newPrice = DiscountCalculator::calculateCustomerDiscount
            ($product->getPrice(), $groupDiscount, $customer->getCustomerDiscount());
        }

        require ("view/includes/header.php");
        require("view/priceCalcView.php");

        require ("view/includes/footer.php");
    }

}