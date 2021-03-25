<?php
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require 'vendor/autoload.php';
require 'controllers/controller.php';
require 'controllers/priceCalcController.php';

use Models\DiscountCalculator;
use Loaders\DiscountLoader;

//navigational CONST values
//these tend to be a better idea than to rely on re-using the same strings
//declare a const once and reuse when needed. this allows for naming uniformity across the model
const PAGE = 'page';
const HOME = 'home';

$connection = new DbConnect;
$pdo = $connection->connect();

var_dump(DiscountLoader::fetchGroupDiscounts(23, $pdo));

//$calculator = new DiscountCalculator();
//$controller = new priceCalcController();
//
//if (isset($GET[PAGE]))
//{
//    switch ($_GET[PAGE])
//    {
//        //implement other cases here if appropriate
//        case(HOME):
//        default:
//            $controller = new priceCalcController();
//            break;
//    }
//}
//
//
//echo loader::foo();
//$controller->render($_GET, $_POST);

include("view/includes/header.php");

?>

<h1>Test</h1>

<?php
include("view/includes/footer.php");
