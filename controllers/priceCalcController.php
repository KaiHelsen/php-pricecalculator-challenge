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
        $quantity = $GET[QUANTITY_TAG] ? (int)$GET[QUANTITY_TAG] : 1;

        DiscountCalculator::calculateBulkDiscount(100,100);

        if (isset($GET[CUSTOMER_TAG], $GET[PRODUCT_TAG])) {
            $customer = CustomerLoader::fetchCustomer((int)$GET[CUSTOMER_TAG], $this->pdo);
            $product = ProductLoader::fetchProduct((int)$GET[PRODUCT_TAG], $this->pdo);

            //calculate bulk price first
            $bulkPrice = DiscountCalculator::calculateBulkDiscount($quantity, $product->getPrice());
            $bulkPriceDsp = $bulkPrice / 100;


//            $groupDiscount = DiscountCalculator::calculateGroupDiscount($product->getPrice(), $customer->getGroupDiscounts());
            $groupDiscount = DiscountCalculator::calculateGroupDiscount($bulkPrice, $customer->getGroupDiscounts());

//            $newPrice = DiscountCalculator::calculateCustomerDiscount($product->getPrice(), $groupDiscount, $customer->getCustomerDiscount());
            $newPrice = DiscountCalculator::calculateCustomerDiscount($bulkPrice, $groupDiscount, $customer->getCustomerDiscount());
        }

        require("view/includes/header.php");
        require("view/priceCalcView.php");
        if (isset($newPrice)) {
            require("view/discountedPriceView.php");
        }
        require("view/includes/footer.php");
    }
}