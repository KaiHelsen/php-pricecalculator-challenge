<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'vendor/autoload.php';
require 'controllers/controller.php';
require 'controllers/priceCalcController.php';

use controller\priceCalcController;

//navigational CONST values
//these tend to be a better idea than to rely on re-using the same strings
//declare a const once and reuse when needed. this allows for naming uniformity across the model
const PAGE = 'page';
const HOME = 'home';
const CUSTOMER_TAG = 'customerId';
const PRODUCT_TAG = 'productId';

$controller = new priceCalcController();

if (isset($GET[PAGE]))
{
    // switch case in case of multiple pages. This way we can easily expand our website
    switch ($_GET[PAGE])
    {
        //implement other cases here if appropriate
        case(HOME):
        default:
            $controller = new priceCalcController();
            break;
    }
}

$controller->render($_GET, $_POST);

